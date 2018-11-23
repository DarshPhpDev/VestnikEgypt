<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 10;

        if (!empty($keyword)) {
            $users = User::where('name', 'LIKE', "%$keyword%")->orWhere('email', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $users = User::paginate($perPage);
        }

        return view('admin.users.index', compact('users','keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        // $roles = Role::select('id', 'name', 'label')->get();
        // $roles = $roles->pluck('label', 'name');
        $roles = Role::orderBy('id')->pluck('name','id')->toArray();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);



        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => $data['password'],
                    'blocked' => 0,
                    'deleted' => 0,
                    'gender' => $data['gender'],
                ]);
        $user->roles()->attach($data['role']);
        return redirect()->back()->with('message-success', 'User Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {

        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int      $id
     *
     * @return void
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, ['name' => 'required', 'email' => 'required', 'roles' => 'required']);

        $data = $request->except('password');
        if ($request->has('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user = User::findOrFail($id);
        $user->update($data);

        $user->roles()->detach();
        foreach ($request->roles as $role) {
            $user->assignRole($role);
        }

        return redirect('admin/users')->with('flash_message', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('admin/users')->with('message-success', 'User deleted!');
    }

    public function block($id){
        $user = User::find($id);
        if($user->blocked == 0){
            $user->update(['blocked' => 1]);
            return redirect()->back()->with('message-success', 'User Blocked!');
        }else{
            $user->update(['blocked' => 0]);
            return redirect()->back()->with('message-success', 'User UnBlocked!');
        }
    }

    public function role(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 5;
        if (!empty($keyword)) {
            $users = User::where('name', 'LIKE', "%$keyword%")->orWhere('email', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $users = User::where('id','!=',1)->where('id','!=',40)->paginate($perPage);
        }
        $roles = Role::orderBy('id')->pluck('name','id')->toArray();
        return view('admin.users.role',compact('roles','users'));
    }

    public function changerole(Request $request, $userId, $roleId){
        User::find($userId)->roles()->sync($roleId);
        return redirect()->back()->with('message-success', 'User Role Changed!');
    }

}
