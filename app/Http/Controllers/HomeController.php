<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Musonza\Groups\Facades\GroupsFacade;

//use App\User;
//use App\Role;
use Auth;
use App\User;
use App\Group;
use App\Message;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(User $user)
    {
        $userId = Auth::user()->id;
        $allUsers = User::all();
        //dd($allUsers);
        $user = User::find($userId);
        $group = $user->groups;
        //dd($user->groups);
        //dd($user);

        $viewData = [
            'user' => $user,
            'allUsers' => $allUsers,
            'groups' => $group
        ];
        return view('home',$viewData);

        //return view('home',compact('user'));
        //return view('user.display', compact('user'));
    }

    public function saveGroup(Request $request){
        $params = $request->all();
        $group = new Group;
        $group->name = $params['group'];
        $group->save();
        
        $user = User::find($params['user']);
        $group->users()->attach($user);

        return redirect(route('home'))->with('success', 'Group created successfully.');
    }

    public function displayMsg($groupId)
    {
        $group = Group::find($groupId);
        //dd($group);
        return view('display_msg', compact('group'));
    }

    public function addMsg(Request $request){
        $params = $request->all();//dd($params);
        $message = new Message;
        $message->message = $params['message'];
        $message->group_id = $params['group_id'];
        $message->save();
        return redirect('group/'.$params['group_id'])->with('success', 'Message send successfully');
    }

    public function deleteUser(Request $request){
        $userId = Auth::user()->id;
        $params = $request->all();
        $group = Group::find($params['group_id']);
        $group->users()->detach($userId);

        $user = User::find($userId);
        $groupList = $user->groups;

        return view('list-groups',compact('groupList'));
    }

    public function createRecored()
    {      
       //create recored in user table
       $user = User::find(2);   
       $roleIds = [1, 2];
       $user->roles()->attach($roleIds);

       $user = User::find(3);   
       $roleIds = [1, 2];
       $user->roles()->sync($roleIds);

       //create recored in role table

       $role = Role::find(1);   
       $userIds = [4, 5];
       $role->users()->attach($userIds);

       $role = Role::find(2);   
       $userIds = [4, 5];
       $role->users()->sync($userIds);
    }

    public function retrieveRecords()
    {   
        //Retrieve recoed in user table
        $user = User::find(1);    
        print_r($user->roles);
        
        //Retrieve recoed in role table
        $role = Role::find(1);  
        print_r($role->users);
    }




}
