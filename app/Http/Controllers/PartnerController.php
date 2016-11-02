<?php

namespace App\Http\Controllers;

use App\Cases;
use App\Documents;
use App\Permissions;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use phpDocumentor\Reflection\Types\Null_;
use Validator;
use Auth;

class PartnerController extends Controller
{
    //

    public function addCase(){

        $users = User::all();
        return view('features/AddCase')->with('users', $users);
    }

    public function storeCase(Request $request){

        $validation = Validator::make($request->all(), [
            'broj_na_predmet' => 'required | unique:cases,broj_na_predmet',
            'tuzitel' => 'required | string',
            'tuzen' => 'required | string',
            'osnov' => 'required | string',
            'vrednost' => 'numeric',
            'sudija' => 'string',
            'protivnik' => 'string'
        ]);


        // Check if it fails //
        if( $validation->fails() ){
            return redirect()->back()->withInput()
                ->with('errors', $validation->errors());
        }

        $case = new Cases();

        $case->broj_na_predmet = $request->get('broj_na_predmet');
        $case->tuzitel = $request->get('tuzitel');
        $case->tuzen = $request->get('tuzen');
        $case->osnov = $request->get('osnov');
        $case->vrednost = $request->get('vrednost');
        $case->sudija = $request->get('sudija');
        $case->advokat_dr_strana = $request->get('protivnik');

        $permisions = $request->get('permissions');
        if($request->get('permissions') != Null){
            foreach ($permisions as $perm){
                $permision = new Permissions();
                $permision->broj_na_predmet = $request->get('broj_na_predmet');
                $u = User::where('name', $perm)->first();
                $permision->user_id = $u->id;
                $permision->save();
            }
        }

        $permision2 = new Permissions();
        $permision2->broj_na_predmet = $request->get('broj_na_predmet');
        $permision2->user_id = Auth::user()->id;
        $permision2->save();

        $case->save();

        return redirect()->back()->with('message', 'Додаден е предмет');
    }

    public function get_cases(){

        $cases = Cases::all();
        $permissions = Permissions::all();
        $users = User::all();

        return view('user/predmeti')->with('cases', $cases)->with('permissions', $permissions)->with('users', $users);
    }

    public function one_case(Request $request){

        if(Auth::user()->role == 'admin' || Auth::user()->is_lawyer()) {

            $pred = Cases::where('broj_na_predmet', $request->get('mySelect'))->first();
            if ($pred != NULL) {

                $docs = Documents::where('case_id', $pred->id)->get();

                return redirect()->back()->with('pred', $pred)->with('docs', $docs);
            } else {
                return redirect()->back()->with('message', 'Немате одберено бр. на предмет! Изберете број на предмет од листата!');
            }
        }else{
            return redirect('/home');
        }
    }

    public function select_lawyer(Request $request){

        if(Auth::user()->role == 'admin' || Auth::user()->role == 'paralegal') {
            $user = User::where('name', $request->get('selectLawyer'))->first();
            if ($user != NULL) {

                $permiss = Permissions::where('user_id', $user->id)->get();
                $allCases = Cases::all();

                return redirect()->back()->with('permiss', $permiss)->with('allCases', $allCases)->with('lawyer', $request->get('selectLawyer'));
            } else {
                return redirect()->back()->with('message', 'Немате одберено адвокат! Морате да имате изберено адвокат од листата!');
            }
        }else{
            return redirect('/home');
        }
    }

    public function show_case($id){

        if(Auth::user()->role == 'admin' || Auth::user()->role == 'paralegal') {
            $case = Cases::where('id', $id)->first();
            $docs = Documents::where('case_id', $id)->get();
            $permiss = Permissions::where('broj_na_predmet', $case->broj_na_predmet)->where('user_id', Auth::user()->id)->first();


            return view('user/showCase')->with('case', $case)->with('permiss', $permiss)->with('docs', $docs);
        }else{
            return redirect('/home');
        }
    }

    public function upload_file(Request $request){

        $validation = Validator::make($request->all(), [
            'fileToUpload' => 'required'
        ]);

        // Check if it fails //
        if( $validation->fails() ){
            return redirect()->back()->withInput()
                ->with('errors', $validation->errors());
        }

        $doc = new Documents();
        $doc->case_id = $request->get('case_id');

        $file = $request->file('fileToUpload');
        $filename = $file->getClientOriginalName();
        $path = 'image/';
        $file->move($path, $filename);
        $doc->file = 'image/'.$filename;

        $doc->user_id = Auth::user()->id;

        $doc->save();

        $case = Cases::find($request->get('case_id'));
        return redirect()->back()->with('message', 'Додадовте документ во предметот '.$case->broj_na_predmet);
    }

    public function delete_document($id){

        $doc = Documents::find($id);
        $doc->delete();
        return redirect()->back()->with('message', 'Го избришавте документот '.ltrim($doc->file, 'image/'));
    }

    public function edit_case($id){

        $case = Cases::where('id', $id)->first();
        $users = User::all();
        $permiss = Permissions::where('broj_na_predmet', $case->broj_na_predmet)->get();
        return view('user/edit_case')->with('case', $case)->with('users', $users)->with('permiss', $permiss);
    }



    public function delete_case($id){

        $case = Cases::find($id);
        $permiss = Permissions::where('broj_na_predmet', $case->broj_na_predmet);
        $permiss->delete();

        $case->delete();

        return redirect()->back()->with('message', 'Избришан е предметот '.$case->broj_na_predmet.' со сите негови документи и рочишта');
    }

    public function update_case(Request $request, $id){

        $validation = Validator::make($request->all(), [
            'br_predmet' => 'required | unique:cases,broj_na_predmet,'.$id,
            'tuzitel' => 'required | string',
            'tuzen' => 'required | string',
            'osnov' => 'required | string',
            'vrednost' => 'numeric',
            'sudija' => 'string',
            'protivnik' => 'string'
        ]);


        // Check if it fails //
        if( $validation->fails() ){
            return redirect()->back()->withInput()
                ->with('errors', $validation->errors());
        }

        $case = Cases::find($id);

        $case->broj_na_predmet = $request->get('br_predmet');
        $case->tuzitel = $request->get('tuzitel');
        $case->tuzen = $request->get('tuzen');
        $case->osnov = $request->get('osnov');
        $case->vrednost = $request->get('vrednost');
        $case->sudija = $request->get('sudija');
        $case->advokat_dr_strana = $request->get('protivnik');

        $permis = Permissions::where('broj_na_predmet', $case->broj_na_predmet);
        $permis->delete();

        $permisions = $request->get('permissions');
        if($request->get('permissions') != Null){
            foreach ($permisions as $perm){
                $permision = new Permissions();
                $permision->broj_na_predmet = $request->get('br_predmet');
                $u = User::where('name', $perm)->first();
                $permision->user_id = $u->id;
                $permision->save();
            }
        }


        $case->save();

        return redirect()->back()->with('message', 'Промените се зачувани');
    }

}
