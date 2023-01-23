<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        return view('profile');
    }

    public function index()
    {
        $userClients = User::where('role_id', 2)->get();
        $userAdmins = User::where('role_id', 1)->get();
        return view('users', ['clients' => $userClients, 'admins' => $userAdmins]);
    }

    public function destroy($slug)
    {
        $user = User::where('slug', $slug)->first();
        if ($user->rentLogs()->exists()) {
            return redirect('/users')->with(['failed' => 'Failed to delete user, because the user data is being used in another table.']);
        } else {
            $res = $user->delete();
            if ($res) {
                return redirect('/users')->with(['success' => 'Success Delete User']);
            } else {
                return redirect('/users')->with(['failed' => 'Failed Delete User']);
            }
        }
    }

    public function ban($slug)
    {
        $user = User::where('slug', $slug)->first();
        if ($user->rentLogs()->exists()) {
            return redirect('/users')->with(['failed' => 'Failed to ban user, because the user data is being used in another table.']);
        } else {
            $res = $user->update([
                'status' => 'inactive'
            ]);
            if ($res) {
                return redirect('/users')->with(['success' => 'Success Ban User']);
            } else {
                return redirect('/users')->with(['failed' => 'Failed Ban User']);
            }
        }
    }

    public function approve($slug)
    {
        $user = User::where('slug', $slug)->first();
        $res = $user->update([
            'status' => 'active'
        ]);
        if ($res) {
            return redirect('/users')->with(['success' => 'Success Approve User']);
        } else {
            return redirect('/users')->with(['failed' => 'Failed Approve User']);
        }
    }
}
