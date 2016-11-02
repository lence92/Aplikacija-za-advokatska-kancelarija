<?php

namespace App\Http\Controllers;

use App\AktivnostiCase;
use App\Cases;
use App\Documents;
use App\Hearings;
use App\Http\Requests;
use App\Permissions;
use App\ToDoLista;
use App\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;
use Validator;
use Auth;
use Hash;
use Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($date = null)
    {

        $tri_doc = Documents::join('users', 'users.id', '=', 'documents.user_id')->select('documents.*', 'users.name')->orderBy('created_at', 'desc')->take(3)->get();

        $rocista_denes = Hearings::where('datum', date('Y-m-d'))->join('cases', 'hearings.case_id', '=','cases.id')->select('hearings.*', 'cases.broj_na_predmet')->get();
        $permiss = Permissions::where('user_id', Auth::user()->id)->get();

        if(!empty($date)){
            $denAktivnosti = AktivnostiCase::where('den', $date)->where('user_id', Auth::user()->id)->get();
            $cases = Cases::all();
            return view('home')->with('tri_doc', $tri_doc)->with('rocista_denes', $rocista_denes)->with('permiss', $permiss)->with('aktivnosti', $denAktivnosti)->with('cases', $cases);
        }else{
            return view('home')->with('tri_doc', $tri_doc)->with('rocista_denes', $rocista_denes)->with('permiss', $permiss);
        }
    }

    public function shtikliraj($id){
        $aktiv = AktivnostiCase::where('id', $id)->first();
        if($aktiv->shtiklirano == 1){
            $aktiv->shtiklirano = 0;
        }else{
            $aktiv->shtiklirano = 1;
        }
        $aktiv->save();
        return redirect()->back();
    }


    public function delete_shtiklirno($id){

        $aktiv = AktivnostiCase::find($id);
        $aktiv->delete();
        return redirect()->back();
    }

    public function add_task(){

        $cases = Cases::all();
        $permiss = Permissions::where('user_id', Auth::user()->id)->get();
        return view('features/addTask')->with('cases', $cases)->with('permiss', $permiss);
    }

    public function store_task(Request $request){

        $validation = Validator::make($request->all(), [
            'br_predmet' => 'required',
            'den' => 'required | date | after:yesterday',
            'kade' => 'string',
            'sto' => 'required | string',
        ]);


        // Check if it fails //
        if( $validation->fails() ){
            return redirect()->back()->withInput()
                ->with('errors', $validation->errors());
        }

        $task = new AktivnostiCase();

        $case = Cases::where('broj_na_predmet', $request->get('br_predmet'))->first();
        $task->case_id = $case->id;
        $task->user_id = Auth::user()->id;
        $task->den = $request->get('den');
        $task->kade = $request->get('kade');
        $task->sto = $request->get('sto');
        $task->shtiklirano = 0;

        $task->save();
        return redirect('/home/'.$task->den);
    }

    public function profile($id){

        $user = User::where('id', $id)->first();
        return view('user/profile')->with('user', $user);

    }

    public function editProfile(Request $request){

        $user = User::where('id', $request->user()->id)->first();
        return view('user/edit_profile')->with('user', $user);

    }

    public function storeProfile(Request $request){

        if ($request->user()->is_admin()){
            $validation = Validator::make($request->all(), [
                'name' => 'required | string',
                'email' => 'required | email | unique:users,email,'.$request->user()->id,
                'employee_id' => 'required | numeric | unique:users,employee_id,'.$request->user()->id,
                'office' => 'required | string',
                'hire_date' => 'date',
                'phone_number' => 'numeric',
                'birth_date' => 'date',
                'adress', 'string'
            ]);
        }else{
            $validation = Validator::make($request->all(), [
                'name' => 'required | string',
                'email' => 'required | email | unique:users,email,'.$request->user()->id,
                'phone_number' => 'numeric',
                'birth_date' => 'date',
                'adress', 'string'
            ]);
        }


        // Check if it fails //
        if( $validation->fails() ){
            return redirect()->back()->withInput()
                ->with('errors', $validation->errors());
        }

        $user = User::where('id', $request->user()->id)->first();

        if($request->file('profile-image-upload') != NULL){
            $file = $request->file('profile-image-upload');
            $filename = $file->getClientOriginalName();
            $path = 'image/';
            $file->move($path, $filename);
            $user->image = 'image/'.$filename;
        }
        if($request->user()->is_admin()){
            $user->employee_id = $request->get('employee_id');
            $user->office = $request->get('office');
            $user->hire_date = $request->get('hire_date');
        }
        $user->email = $request->get('email');
        $user->name = $request->get('name');
        $user->phone_number = $request->get('phone_number');
        $user->adress = $request->get('adress');
        $user->birth_date = $request->get('birth_date');
        $user->save();
        //return view('user/profile')->with('user', $user);
        return redirect('/profile/'.$request->user()->id)->with('message', 'Вашиот профил е ажуриран.');
    }

    public function editPassword(){
        return view('user/edit_password');
    }

    public function setPassword(Request $request){
        $validation = Validator::make($request->all(), [
            'password' => 'required',
            'new_password' => 'required | min:6',
            'confirm_password' => 'required | same:new_password'
        ]);

        // Check if it fails //
        if( $validation->fails() ){
            return redirect()->back()->withInput()
                ->with('errors', $validation->errors());
        }

        $user = User::where('id', $request->user()->id)->first();


        if(!Hash::check( $request->get('password'), $user->password )){
            return redirect()->back()->with('greshka', 'Полето стара лозинка мора да одговара со твојата сегашна лозинка');
        }

        $user->password = bcrypt($request->get('new_password'));
        $user->save();

        return redirect('/editProfile')->with('message', 'Лозинката е ажурирана.');
    }



    public function search(Request $request){

        $validation = Validator::make($request->all(), [
            'search' => 'required'
        ]);

        // Check if it fails //
        if( $validation->fails() ){
            return redirect()->back()->withInput()
                ->with('errors', $validation->errors() );
        }


    }

    public function siteMoiDokumenti(){

        $docs = Documents::where('user_id', Auth::user()->id)->get();
        $allCases = Cases::all();
        $users = User::whereNotIn('id', [Auth::user()->id])->get();

        return view('user/moi_dokumenti')->with('docs', $docs)->with('cases', $allCases)->with('users', $users);
    }


    public function dodadi_dokument(){
        if(Auth::user()->role == 'paralegal')
        {
            $cases = Cases::all();
        }else{
            $cases = Cases::join('permissions', 'cases.broj_na_predmet', '=','permissions.broj_na_predmet')->get();
        }
        return view('features/dodadiDok')->with('cases', $cases);
    }

    public function zacuvajDokument(Request $request){

        $validation = Validator::make($request->all(), [
            'fileToUpload' => 'required',
            'predmet' => 'required'
        ]);

        // Check if it fails //
        if( $validation->fails() ){
            return redirect()->back()->withInput()
                ->with('errors', $validation->errors());
        }

        $case = Cases::where('broj_na_predmet', $request->get('predmet'))->first();
        if($case == NULL){
            return redirect()->back()->with('porakaPredmet', 'Морате да изберете предмет за кој се однесува документот');
        }

        $doc = new Documents();
        $doc->case_id = $case->id;

        $file = $request->file('fileToUpload');
        $filename = $file->getClientOriginalName();
        $path = 'image/';
        $file->move($path, $filename);
        $doc->file = 'image/'.$filename;

        $doc->user_id = Auth::user()->id;

        $doc->save();

        return redirect('/moiDok')->with('message', 'Додадовте нов документ во предметот '.$request->get('predmet'));
    }
}
