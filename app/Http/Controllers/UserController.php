<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UsersImport;
use App\Exports\UsersExport;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index()
    {
        $users = Product::get();
  
        return view('index', compact('index'));
    }
        
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request) 
    {
        // use Excel facade to import data, by passing in the UserImport class and the uploaded file request as arguments
        Excel::import(new UsersImport, $request->file('file')->store('temp'));
        return back();
    }
    
    public function export() 
    {
        // use Excel facade to export data, by passing in the UserExport class and the desired file name as arguments
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
