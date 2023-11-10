<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class kaderController extends Controller
{
    public function index(){
        return view('kader.index');
    }

    public function show(){
        return view('kader.show');
    }

    public function edit(){
        return view('kader.edit');
    }

    public function create(){
        return view('kader.create');
    }
}
