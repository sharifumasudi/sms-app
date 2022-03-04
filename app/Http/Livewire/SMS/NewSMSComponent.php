<?php

namespace App\Http\Livewire\SMS;

use Livewire\Component;
use App\Models\SMS\CategoryModel;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Models\SMS\ReceiversModel;
use App\Models\SMS\SentSMSModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class NewSMSComponent extends Component
{
    use LivewireAlert;

    public $errorException;
    public CategoryModel $CategoryModelObject;
    public ReceiversModel $ReceiversModelObject;
    public SentSMSModel $sentSMSObject;
    public $data;

    public $category_id, $message;
    protected $rules = [
        'category_id' => 'required',
        'message' => 'required|max:180|min:2',
    ];

    protected $messages = [
        'category_id.required' => 'Receiver Category Must be Selected',
        'message.required' => 'Message Cant Blank!',
        'message.max' => 'Maximum Message Length Cant Exceed 180 characters!',
        'message.min' => 'Minimum Message Length Cant be below 2 characters!',
    ];
    public function mount()
    {
        $this->CategoryModelObject = $CategoryModelObject ?? new CategoryModel();
        $this->ReceiversModelObject = $ReceiversModelObject ?? new ReceiversModel();
        $this->data = $this->CategoryModelObject->displayCategories();
        $this->sentSMSObject = $sentSMSObject ?? new SentSMSModel();
    }

    public function updated($field)
    {
        return $this->validateOnly($field);
    }
    private function resetInputFields()
    {
        $this->message = null;
        $this->category_id = null;
    }
    public function smsSender()
    {
        //sending sms starts here
        try{
            $validated = $this->validate();
            if($validated)
            {
                if($this->category_id == 'all')
                {
                    $query = DB::select('SELECT phone, sms_receiver_id FROM sms_receiver');
                    foreach($query as $phone)
                    {
                        $this->sendMessage($phone->phone); // Sending SMS
                    }

                    foreach($query as $savingSentSMS)
                    {
                        $this->saveSentSMS($savingSentSMS->sms_receiver_id);// Save SMS
                    }
                    $this->resetInputFields();
                    sleep(3);
                    session()->flash('message', 'SMS Sent Successfully');
                    return redirect()->route('sent.sms');
                }
                else
                {
                    $decryptedID = Crypt::decrypt($this->category_id); //decrypt category ID
                    $query2 = DB::select("SELECT phone, sms_receiver_id FROM sms_receiver WHERE category_id = '$decryptedID'");
                    if(!is_null($query2))
                    {
                        foreach($query2 as $phonenumber)
                        {
                            $this->sendMessage($phonenumber->phone); // Send SMS
                        }

                        foreach($query2 as $smsSavier)
                        {
                            $this->saveSentSMS($smsSavier->sms_receiver_id); //Save SMS
                        }
                        sleep(1);
                        session()->flash('message', 'SMS Sent Successfully');
                        return redirect()->route('sent.sms');
                    }
                }
            }
        }catch (\Throwable $e) {
            $this->errorException = 'Something Went Wrong ';
        }
    }
    private function saveSentSMS($receiver_id)
    {
            $data = [
                'sender_id' => Auth::user()->id,
                'receiver_id' => $receiver_id,
                'sms_description' => $this->message,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            $this->sentSMSObject->insert($data);
    }
    public function sendMessage($receiver)
    {
        $api_key='aa1fe8a01b0ca8d6';
        $secret_key = 'YzZiYzk3NWFjYjFmMWQxYzY1ZmNmOTlkNGNlYTUxYTAyODhjOTUzZDhmYjY5NzFhMjYxYmYwOTQxY2NkZmI0NQ==';
        $postData = array(
            'source_addr' => 'Edupack',
            'encoding'=>0,
            'schedule_time' => '',
            // 'message' => $sms,
            'recipients' =>[array('recipient_id' => '1','dest_addr'=>'+255'.$receiver)],
            'message' => $this->message,
        );
        $Url ='https://apisms.beem.africa/v1/send';
        // Setup cURL
        $ch = curl_init($Url);
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($ch, array(
        CURLOPT_POST => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_HTTPHEADER => array(
            'Authorization:Basic ' . base64_encode("$api_key:$secret_key"),
            'Content-Type: application/json'
        ),
        CURLOPT_POSTFIELDS => json_encode($postData)
        ));
        // Send the request
        $response = curl_exec($ch);
        $code = json_decode($response)->code;
        //echo json_decode($response)->code;
        // Check for errors
        if($code == 100)
        {
            return 1;
            die(curl_error($ch));
        }
        else
        {
            return 0;
            die(curl_error($ch));
        }
    }
    public function render()
    {
        return view('livewire.s-m-s.new-s-m-s-component');
    }
}
