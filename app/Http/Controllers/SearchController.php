<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Discussion;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function index(Request $request)
    {
        $discussions = Discussion::with('channel')
            ->where('title', 'like', "%$request->search%")
            ->orWhere('description', 'like', "%$request->search%")
            ->latest()
            ->take(6)
            ->get();

        $users = User::where('username', 'like', "%$request->search%")
            ->orWhere('first_name', 'like', "%$request->search%")
            ->orWhere('last_name', 'like', "%$request->search%")
            ->latest()
            ->take(10)
            ->get();

        return response()->json([
            'discussions' => $discussions,
            'users'       => $users,
        ]);
    }
}
