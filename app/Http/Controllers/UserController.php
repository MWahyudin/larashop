<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
      $users = User::latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    public function userSearch(Request $request)
    {
        $filters = [
            'keyword' => $request->get('keyword'),
            'active' => $request->get('active'),
            'inactive' => $request->get('inactive')
        ];
       
       if($request->keyword === null && $request->inactive){
        // $users = User::latest()->paginate(10);
        $users = User::where('status', $request->inactive)->paginate(10);
    }
    elseif($request->keyword === null && $request->active){
        // $users = User::latest()->paginate(10);
        $users = User::where('status', $request->active)->paginate(10);
    }elseif($request->keyword === null){
        $users = User::latest()->paginate(10);
        
    }
        // dd($request->keyword, $request->inactive);

       else{
       
        $users = User::where(function ($query) use ($filters) {
            if ($filters['keyword']) {
                if($filters['active']){
                $query->where('name', 'LIKE', '%'.$filters['keyword'].'%')->orwhere('email', 'LIKE', '%'.$filters['keyword'].'%')->orwhere('phone', 'LIKE', '%'.$filters['keyword'].'%')->where('status', '=', $filters['active']);;

                }elseif($filters['inactive']){
                $query->where('name', 'LIKE', '%'.$filters['keyword'].'%')->where('email', 'LIKE', '%'.$filters['keyword'].'%')->where('phone', 'LIKE', '%'.$filters['keyword'].'%')->where('status',$filters['inactive']);;
            }else{
                $query->where('name', 'LIKE', '%'.$filters['keyword'].'%')->orwhere('email', 'LIKE', '%'.$filters['keyword'].'%')->orwhere('phone', 'LIKE', '%'.$filters['keyword'].'%');
            }
        }
             else if ($filters['active']) {
                $query->where('status', '=', $filters['active']);
            }
            $query->where('status', '=', $filters['inactive']);
        })->paginate(10);
    }
     
            return view('users.index', compact('users'));
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $new_user = new User();
        $new_user->name = $request->get('name');
        $new_user->username = $request->get('username');
        $new_user->roles = json_encode($request->get('roles'));
        $new_user->name = $request->get('name');
        $new_user->address = $request->get('address');
        $new_user->phone = $request->get('phone');
        $new_user->email = $request->get('email');
        $new_user->password = Hash::make($request->get('password'));

        if ($request->file('avatar')) {
            $file = $request->file('avatar')->store('avatars', 'public');
            $new_user->avatar = $file;
        }

        $new_user->save();
        return redirect()->route('user.index')->with('status', 'User succesfuly added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::findOrFail($id);
        return view('users.detail', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
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
        $user = User::findOrFail($id);
        $user->name = $request->get('name');
        $user->roles = json_encode($request->get('roles'));
        $user->address = $request->get('address');
        $user->phone = $request->get('phone');
        if ($request->hasFile('avatar')) {
            Storage::delete('public/' . $user->avatar);
            $file = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $file;
        }
        // dd($user);
        $user->save();
        return redirect()->route('user.edit', [$id])->with('status', 'User succesfully update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \App\User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('status', 'User successfully delete');

    }
}
