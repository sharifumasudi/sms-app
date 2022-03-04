<?php
namespace App\Http\Livewire\SMS;

use Livewire\Component;
use App\Models\SMS\SentSMSModel;
use Illuminate\Support\Facades\Crypt;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ListOfSentMessageComponent extends Component
{
    use LivewireAlert;
    public SentSMSModel $sentSMSObject;

    public $sms, $sms_id;
    public function getListeners()
    {
        return [
            'confirmedDeletion',
            'cancelledToDelete'
        ];
    }


    public function mount()
    {
        $this->sentSMSObject = $sentSMSObject ?? new SentSMSModel();
        $this->sms = json_encode($this->sentSMSObject->displaySentSMS());
    }


    public function deleteSMS($smsID)
    {
        $this->sms_id = $this->sentSMSObject->query()->findOrFail(Crypt::decrypt($smsID));
        $this->alert('question', 'Are Sure Want To Delete This Message ?', [
			'showConfirmButton' => true,
			'confirmButtonText' => 'Confirm',
			'showDenyButton' => true,
			'denyButtonText' => 'Cancel',
			'denyButtonColor' => 'red',
			'onConfirmed' => 'confirmedDeletion',
			'onDenied' => 'cancelledToDelete',
            'allowOutsideClick' => false,
            'timer' => false,
			'toast' => false,
			'position' => 'center',
		]);
    }


    public function confirmedDeletion()
    {
        $deleted = $this->sms_id->delete();
        if($deleted)
        {
             $this->flash('success', 'SMS Deleted Succesfully', [], route('sent.sms'));
        }
    }


    public function cancelledToDelete()
    {
        $this->flash('error', 'Cancelled', [], route('sent.sms'));
    }

    public function render()
    {
        return view('livewire.s-m-s.list-of-sent-message-component');
    }
}
