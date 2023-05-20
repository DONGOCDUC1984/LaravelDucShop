<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    // Get all users
    public function index()
    {
        $users = User::paginate(5);
        return view('users.index', compact("users"));
    }

    // Delete user
    public function destroy($id)
    {

        $user = User::find($id);
        $user->delete();

        return redirect('/manageusers')
            ->with('status', 'User was deleted successfully');
    }
}
