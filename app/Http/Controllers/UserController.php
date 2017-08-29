<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //talk to model
        $users = User::all();
        //pick view to display
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'student_id' => 'required|max:255|unique:users',
            'password' => 'required|min:6'
        ]);


        if(empty($request['admin'])){
            $admin = false;
        }else{
            $admin = true;
        }

        $user = User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'new_password' => 1,
            'admin' => $admin,
            'active' => 1,
            'student_id' => $request['student_id'],
            'phone' => $request['phone']
        ]);
        $user->save();
        return redirect()->action('AppManagementController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //talk to model
        $user = User::find($id);
        //pick view to display
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'student_id' => 'required|max:255|unique:users',
        ]);

        $users = User::find($id);
        if($request['reset_password'] == 1){
            $users->new_password = 1;
            $users->password = Hash::make($request['password']);
        }
        $users->first_name = $request['first_name'];
        $users->last_name = $request['last_name'];
        $users->email = $request['email'];

        $users->student_id = $request['student_id'];
        $users->admin = $request['admin'];
        $users->phone = $request['phone'];
        $users->save();
        return redirect()->action('AppManagementController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user->active){
            $user->active = false;
            $user->remember_token = null;
        }else{
            $user->active = true;
        }
        $user->save();
        return redirect()->action('UserController@index');
    }
}
