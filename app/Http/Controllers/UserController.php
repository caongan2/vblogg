<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.user.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('crud')){
            abort(403);
        }
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, User $user)
    {
        $path = $request->file('image')->store('images', 'public');
        $user->img = $path;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
        $user->roles()->sync($request->roles);
        return redirect()->route('user.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $allPosts = Post::all()->where('user_id', $id);
        $users = User::all();
        $user = User::findOrFail($id);
        return view('admin.user.profile', compact('user', 'users', 'allPosts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $user = User::findOrFail($id);
        return view('admin.user.update', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        if (!$request->hasFile('image')) {
            $path = $user->img;
        } else {
            $path = $request->file('image')->store('images', 'public');
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'img' => $path
        ];
        DB::table('users')->where('id', $id)->update($data);
        $user->roles()->sync($request->roles);
        return redirect()->route('user.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->roles()->delete();
        $user->products()->delete();
        $user->posts()->delete();
        $user->comments()->delete();
        $user->delete();
        return response()->json(['message' => 'Delete success']);
    }

    public function search(Request $request)
    {
        $text = $request->name;
        $users = User::where('name', 'LIKE' , '%' . $text . '%')->get();
        return view('admin.user.result_search', compact('users'));
    }

    public function myProfile($id)
    {
        $allPosts = Post::all()->where('user_id', $id);
        $users = User::all();
        $user = User::findOrFail($id);
        return view('customer.yourprofile', compact('user', 'users', 'allPosts'));
    }
}
