<?php

namespace App\Http\Controllers;
use App\User;
use App\Role;
use App\Photo;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;
use Illuminate\Support\Facades\Validator;
class AdminUsersController extends Controller
{

    private $listUsersPath = "/admin/users";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $input = $request->all();
        if($request->hasFile('photo_id'))
        {
            $file = $request->file('photo_id');
            $name = time().$file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=> $name]);
            $input['photo_id'] = $photo->id;
        }
        $input['password'] = bcrypt($request->password);
        User::create($input);
        return redirect($this->listUsersPath);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact(['user', 'roles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, User $user)
    {
        //$user = User::findOrFail($id);
        $input = $request->all();
        if(trim($request->password) == '')
        {
            $input['password'] = $user->password;
        }
        else
        {
            $input['password'] = bcrypt($request->password);
        }
        if($request->hasFile('photo_id'))
        {
            $file = $request->file('photo_id');
            $name = time().$file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=> $name]);
            $input['photo_id'] = $photo->id;
        }
        $user->update($input);
        return redirect($this->listUsersPath);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        unlink(public_path().$user->photo->file);
        $user->delete();
        Session::flash('status', 'User has been deleted');
        return redirect($this->listUsersPath);
    }
}
