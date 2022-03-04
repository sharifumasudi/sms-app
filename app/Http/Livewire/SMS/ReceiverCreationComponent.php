<?php

namespace App\Http\Livewire\SMS;

use Livewire\Component;
use App\Models\SMS\CategoryModel;
use Exception;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Crypt;
use App\Models\SMS\ReceiversModel;
use Carbon\Carbon;

class ReceiverCreationComponent extends Component
{
    use LivewireAlert;
    public CategoryModel $CategoryModelInstance;
    public ReceiversModel $ReceiversModelObject;

    public $category_id, $phone, $name;
    public $errorException = '';
    public $catgoriesData = null;

    protected $rules = [
        'category_id' => 'required',
        'phone' => 'required|max:10|min:10',
        'name' => 'required|String|max:200',
    ];

    protected $messages = [
        'category_id.required' => 'Category name Must be Selected!',
        'phone.required' => 'Phone Number is Required',
        'phone.max' => 'Incorrect Phone Number',
        'phone.min' => 'Incorrect Phone Number',
        'name.required' => 'Receiver First Name is Required',
        'name.String' => 'Receiver First Name Must Be String',
        'name.max' => 'Receiver First Name Must is Too Long',
    ];

    public function mount()
    {

        $this->CategoryModelInstance = $CategoryModelInstance ?? new CategoryModel();
        $this->ReceiversModelObject = $ReceiversModelObject ?? new ReceiversModel();
        $this->catgoriesData = json_encode($this->CategoryModelInstance->displayCategories());
    }

    public function updated($field)
    {

        return $this->validateOnly($field);

    }

    public function resetInput()
    {
        $this->name = null;
        $this->phone = null;
        $this->category_id = null;
    }

    public function receiverCreation()
    {

        try
        {
            $validated = $this->validate();
            if($validated)
            {
                $this->resetErrorBag();
                $saved = $this->ReceiversModelObject->createReceiver($this->fieldInputs());
                if($saved)
                {
                    sleep(3);
                    $this->resetInput();
                    $this->flash('success', 'Succeeded New Information Added!', [], route('sms.receiver.index'));
                }
            }
        }
        catch(Exception $e)
        {
            $this->errorException = 'Something Went Wrong, Please Contect ICT OFFICER '.$e->getMessage();
        }
    }


    private function fieldInputs(): array
    {

        return [
            'name' => htmlspecialchars_decode(trim(ucwords($this->name))),
            'phone' => htmlspecialchars_decode(trim($this->phone)),
            'category_id' => htmlspecialchars_decode(trim((int)Crypt::decrypt($this->category_id))),
            'created_at' => Carbon::now(),
        ];
    }


    public function render()
    {

        return view('livewire.s-m-s.receiver-creation-component');
    }
}
