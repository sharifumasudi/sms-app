<?php

namespace App\Http\Controllers\SMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(request()->routeIs('sms.category.index'))
        {
            return view('SMS.Category.index');
        }
        abort(401);
    }
    public function create()
    {
        if(request()->routeIs('sms.category.create'))
        {
            return view('SMS.Category.create');
        }
        abort(401);
    }
}
