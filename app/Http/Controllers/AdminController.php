<?php

namespace App\Http\Controllers;

use App\Cases;
use App\Hearings;
use App\Permissions;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\ToDoLista;
use App\User;
use Validator;
use Auth;
use Hash;


class AdminController extends Controller
{
    //

    public function add_user(Request $request){
        if($request->user()->is_admin()){
            return view('auth/register');
        }
        else{
            return redirect('/')->withErrors('Немате соодветни дозволи за да напишете пост');
        }
    }

    public function create_user(Request $request){

        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required | email | unique:users,email',
            'role' => 'required',
            'employee_id' => 'required | numeric | unique:users,employee_id',
            'office' => 'required',
            'hire_date' => 'date',
            'password' => 'required | required_with:password_confirmation | confirmed | min:6'
        ]);

        // Check if it fails //
        if( $validation->fails() ){
            return redirect()->back()->withInput()
                ->with('errors', $validation->errors() );
        }

        $user = new User();

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->role = $request->get('role');
        $user->employee_id = $request->get('employee_id');
        $user->office = $request->get('office');
        $user->hire_date = $request->get('hire_date');
        $user->password = bcrypt($request->get('password'));
        $user->image = $request->get('image');

        $user->save();

        return redirect()->back()->with('message', 'Корисникот е регистриран.');

    }

    public function allEmployee(){

        $all = User::all();
        return view('features/employee')->with('all', $all);
    }

    public function editEmployee($id){

        $user = User::where('id', $id)->first();
        return view('features/editEmployee')->with('user', $user);
    }

    public function setEmployee($id, Request $request){

        $validation = Validator::make($request->all(), [
            'role' => 'required',
            'employee_id' => 'required | numeric | unique:users,employee_id,'.$id,
            'office' => 'string',
            'hire_date' => 'date',
            'email' => 'required | email | unique:users,email,'.$id,
        ]);

        // Check if it fails //
        if( $validation->fails() ){
            return redirect()->back()->withInput()
                ->with('errors', $validation->errors() );
        }

        $user = User::where('id', $id)->first();

        $user->email = $request->get('email');
        $user->role = $request->get('role');
        $user->employee_id = $request->get('employee_id');
        $user->office = $request->get('office');
        $user->hire_date = $request->get('hire_date');

        $user->save();

        return redirect('/allemployee')->with('message', 'Профилот на вработениот е ажуриран.');
    }

    public function deleteEmployee($id){

        $user = User::find($id);

        $user->delete();
        return redirect()->back()->with('message', 'Профилот на вработениот е избришан.');
    }

    public function hearings(){
        $hearings = Hearings::join('cases', 'hearings.case_id', '=','cases.id')->select('hearings.*', 'cases.broj_na_predmet')->get();

        $br_predmeti = Cases::all();
        $permiss = Permissions::where('user_id', Auth::user()->id)->get();
        return view('features/otvoriRochishta')->with('br_predmeti', $br_predmeti)->with('permiss', $permiss)->with('hearings', $hearings);
    }

    public function saveHearing(Request $request){

        $this->validate($request, [
            'broj_na_predmet' => 'required',
            'od' => 'required',
            'do' => 'required',
            'sudnica' => 'required'
        ]);

        $hearing = new Hearings();

        $case = Cases::where('broj_na_predmet', $request->get('broj_na_predmet'))->first();

        $hearing->case_id = $case->id;
        $hearing->user_id = Auth::user()->id;
        $hearing->datum = $request->get('datum');
        $hearing->od = $request->get('od');
        $hearing->do = $request->get('do');
        $hearing->sudnica = $request->get('sudnica');

        $hearing->save();
        return redirect()->back();

    }

    public function deleteHearing($id){

        $hearing = Hearings::find($id);

        $hearing->delete();
        return redirect()->back()->with('message', 'Избришавте рочиште');
    }
}
