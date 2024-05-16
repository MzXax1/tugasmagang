<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function home()
    {
        // Fetch any data you need to pass to the view
        // For example, fetching authenticated user's details or other resources

        return view('home'); // Return the 'home' view
    }
}
