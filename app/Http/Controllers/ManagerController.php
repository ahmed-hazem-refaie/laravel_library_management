<?php

namespace App\Http\Controllers;
use App\Role;
use App\User;
use Gate;
use Illuminate\Http\Request;

class ManagerController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

   
    public function updateStatus(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->isActive = $request->isActive;
        $user->save();
        // $user->save();

        // return response()->json(['message' => 'User status updated successfully.']);
            // dd($_GET);
            if ($user->save()){
                // return response('done') ;
        return response()->json(['message' => 'User status updated successfully.']);

            }else{
                return response()->json(['message' => 'User status update faill.']);
            }
            return $request->id;

    }

    



    public function index(){
        $users=User::with('roles')->get();
        // dd($users);
        return view('manager.user.index')->with('users',$users);
    }



    public function edit(User $user){
        if(Gate::denies('edit-users')){
            return redirect()->route('manager.user.index');
        }

       $roles = Role::all();
       return view('manager.user.edit')->with([
            'user' => $user ,
            'roles' => $roles
       ]);
    }

    public function update(Request $request , User $user){
        // dd(User::with('roles'));
        // dd($request->roles[0] , $user);

        $user->roles()->syncWithoutDetaching($request->roles[0] );

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->route('manager.user.index');

    }

    public function destroy(User $user){
        if(Gate::denies('delete-users')){
            return redirect()->route('manager.user.index');
        }
        // dd($user);
        $user->roles()->detach();
        $user->delete();
        return redirect()->route('manager.user.index');
    }
}
