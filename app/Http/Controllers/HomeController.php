<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SMS\ReceiversModel;
use Illuminate\Support\Facades\Validator;
use App\Models\SMS\CategoryModel;

class HomeController extends Controller
{
    public ReceiversModel $receiver;
    public CategoryModel $CategoryModel;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->receiver = $receiver ?? new ReceiversModel();
        $this->CategoryModel = $CategoryModel ?? new CategoryModel();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home')->with(['category' => $this->receiver->displayReceiver()]);
    }
    public function profile()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        try {
                $validateInfo = Validator::make(
                $request->all(),
                [
                    'user_name' => 'required|string|max:255',
                    'email' => 'required|max:255',
                ]
            );

            if($validateInfo->fails()) {
              return redirect()->back()->withErrors($validateInfo);
            }

            if($validateInfo->passes())
            {
                $user = auth()->user();

              if (auth()->check()) {
                $user->user_name = $request->user_name;
                $user->email = $request->email;
                $user->save();

                if ($user) {
                    session()->flash('success', 'Updated');
                  return redirect()->back();
                }
              }
            }
        }
        catch (\Exception $th)
        {
          return $th->getMessage();
        }
    }

    public function changePassword()
    {
        return view('changePassword');
    }
}
