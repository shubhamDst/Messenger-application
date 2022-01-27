<?php

namespace App\Http\Controllers;
use App\User;
use App\Group;
use App\Message;

use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function create(Request $request)
    {
        $group = new Group;
        $group->name = 'G1';

        $group->save();

        $user = User::find([1, 2]);
        $group->users()->attach($user);

        return 'Success';
    }

    public function display(User $user)
	{ //die('eee');
		//dd($user->groups);
	   return view('user.display', compact('user'));
	}

	public function add(Request $request)
    {
        $message = new Message;
        $message->message = 'M2';
        $message->group_id = 1;
        $message->save();

        return 'Successfully added message.';
    }

    public function show()
	{
		$group = Group::find(1);
		//dd($group);
	   	return view('user.show', compact('group'));
	}


	// public function create(Request $request)
 //    {
 //        $group = new Group;
 //        $group->name = 'G1';

 //        $group->save();

 //        $user = User::find([1, 2]);
 //        $group->users()->attach($user);

 //        return 'Success';
 //    }


}
