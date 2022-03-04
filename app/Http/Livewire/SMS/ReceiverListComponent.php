<?php
/*BY MASOUD-CODES LARAVEL DEVELOPER 2022*/
namespace App\Http\Livewire\SMS;

use Livewire\Component;
use App\Models\SMS\ReceiversModel;
use App\Models\SMS\CategoryModel;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ReceiverListComponent extends Component
{

    use LivewireAlert;

    public ReceiversModel $ReceiversModelObject;
    public CategoryModel $categoryObject;

    public $receiversModelData = null;
    public $sms_receiver_id, $phone, $name, $category_id;
    public $catgoriesData, $findReceiverToDelete;

    public function getListeners() // action listerner funcs
    {
        return [
            'confirmedTODelete',
            'cancelledToDelete'
        ];
    }

    public function mount() // the same as constructor
    {
        $this->ReceiversModelObject = $ReceiversModelObject ?? new ReceiversModel();
        $this->categoryObject = $categoryObject ?? new CategoryModel();
        $this->receiversModelData = json_encode($this->ReceiversModelObject->displayReceiver());
        $this->catgoriesData = $this->categoryObject->displayCategories(); // receive categories
    }

    public function editReceiver($sms_receiver_id)
    {
        $getId = $this->ReceiversModelObject->where(['sms_receiver_id' => $sms_receiver_id])->findOrFail($sms_receiver_id)->toArray();
        $this->sms_receiver_id = $sms_receiver_id;
        $this->phone = $getId['phone'];
        $this->category_id = $getId['category_id'];
        $this->name = $getId['name'];
        // here preparation of data to be viewed for edition using bootstrap modal
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:50',
            'category_id' => 'required',
            'phone' => 'required|numeric',
        ]); // inline validation

        if($this->sms_receiver_id)
        {
            // firing action
            $founded = $this->ReceiversModelObject->find($this->sms_receiver_id);
            $updated = $founded->update($this->inputField());
            if($updated)
            {
                sleep(2);
                $this->resetErrorBag();
                $this->resetInput();
                $this->flash('success', 'Successfully Receiver Informations Updated!', [
                    'toast' => false,
                    'position' => 'center',
                    'timerProgressBar' => true,
                ], route('sms.receiver.index'));
            }
        }
    }

    private function resetInput()
    {
        // free input fields
        $this->name = null;
        $this->phone = null;
        $this->category_id = null;
    }

    public function close()
    {
        // fire close button
        $this->resetInput();
        return redirect()->route('sms.receiver.index');
    }

    private function inputField(): array
    {
        // input fields to be saved
        return [
            'phone' => $this->phone,
            'category_id' => $this->category_id,
            'name' => $this->name,
        ];
    }

    public function deletetReceiver($sms_receiver_id)
    {
        $this->findReceiverToDelete = $this->ReceiversModelObject->query()->findOrFail($sms_receiver_id);
        $this->alert('question', '<b style="color:red; text-align:justify;">Are Sure Want To Delete: </b style="color:red;">' . strtoupper($this->findReceiverToDelete->name) . ' ?', [
			'showConfirmButton' => true,
			'confirmButtonText' => 'Confirm',
			'showDenyButton' => true,
			'denyButtonText' => 'Cancel',
			'denyButtonColor' => 'red',
			'onConfirmed' => 'confirmedTODelete',
			'onDenied' => 'cancelledToDelete',
            'allowOutsideClick' => false,
            'timer' => false,
			'toast' => false,
			'position' => 'center',
		]);
    }

    public function confirmedTODelete()
    {
        // fire deletion event
        if(! is_null($this->findReceiverToDelete))
        {
            $this->findReceiverToDelete->delete(); // Delete Receiver
            sleep(2);
            $this->flash('success', 'Receiver Deleted Successfully!', [], route('sms.receiver.index'));
        }
    }


    public function cancelledToDelete()
    {
        // fire cancel button
        $this->resetInput();
        $this->flash('error', 'Cancelled', [], route('sms.receiver.index'));
    }


    public function render()
    {
        return view('livewire.s-m-s.receiver-list-component');
    }
}
