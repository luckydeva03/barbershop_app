<?php

namespace App\Http\Controllers\Route;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserPageController extends Controller
{
    public function index()
    {
        return view('pages.home.index');
    }
}
