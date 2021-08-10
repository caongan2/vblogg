<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        return view('welcome',compact('categories'));
    }


    public function create()
    {
        return view('shop.category');
    }

    public function store(Request $request, Categories $categories)
    {
        $categories->name = $request->name;
        $categories->save();
        return redirect()->route('home');
    }
}
