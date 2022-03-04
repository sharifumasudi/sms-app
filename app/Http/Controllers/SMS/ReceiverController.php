<?php

namespace App\Http\Controllers\SMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SMSReceiverPhonenumbers;

class ReceiverController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(request()->routeIs('sms.receiver.index'))
        {
            return view('SMS.Receiver.index');
        }
        abort(401);
    }

    public function create()
    {
        if(request()->routeIs('sms.receiver.create'))
        {
            return view('SMS.Receiver.create');
        }
    }
    public function exportPhoneNumbers()
    {
        return Excel::download(new SMSReceiverPhonenumbers, 'receivers.xlsx');
    }
}
