<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class TrainerController extends Controller
{
    public function index()
    {
        return view('admin.trainers', ['items' => config('catalog.items')]);
    }

    public function create()
    {
          return view('admin.trainers-create');
    }
}