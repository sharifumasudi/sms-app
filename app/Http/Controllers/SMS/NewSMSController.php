<?php

namespace App\Http\Controllers\SMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewSMSController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function newSmsFun()
    {
        return view('SMS.SMS_records.create_sms');
    }
}
