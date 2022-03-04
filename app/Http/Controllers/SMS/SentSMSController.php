<?php

namespace App\Http\Controllers\SMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SMS\SentSMSModel;

class SentSMSController extends Controller
{
    public SentSMSModel $sentSMSModelObject;
    public function __construct()
    {
        $this->middleware('auth');
        $this->sentSMSModelObject = $sentSMSModelObject ?? new SentSMSModel();
    }

    public function index()
    {
        return view('SMS.SMS_records.index')->with(['sms' => $this->sentSMSModelObject->displaySentSMS()]);
    }
}
