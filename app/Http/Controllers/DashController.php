<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()->orderBy('id','desc');

        if($request->filled('search')){
            $query->where('name','like','%' . $request->search . '%')
                ->orWhere('email','like','%' . $request->search . '%');
        }

        $lists = $query->paginate(10);

        return view('dashboard', compact('lists'));
    }
}
