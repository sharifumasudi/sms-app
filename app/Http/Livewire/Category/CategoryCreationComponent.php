<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use App\Models\SMS\CategoryModel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Exception;

class CategoryCreationComponent extends Component
{

    use LivewireAlert;
    public CategoryModel $CategoryModelObject;
    public $cate_name, $cate_description;
    public $errorException = '';
    protected $rules = [
        'cate_name' => 'required|max:50|unique:categories',
        'cate_description' => 'required|max:200',
    ];
    protected $messages = [
        'cate_name.required' => 'Category Name is Rquired',
        'cate_name.max' => 'Too long Text',
        'cate_description.required' => 'Description Required',
        'cate_description.max' => 'Too Long Text',
    ];
    public function mount()
    {
        $this->CategoryModelObject = $CategoryModelObject ?? new CategoryModel();
    }
    public function updated($field)
    {
        return $this->validateOnly($field);
    }

    public function resetInput()
    {
        $this->cate_name = null;
        $this->cate_description = null;
    }
    public function categoryCreation()
    {
        try{
            $validated = $this->validate();
            if($validated)
            {
                $saved = $this->CategoryModelObject->createCategory($this->inputFields());
                if($saved)
                {
                    sleep(3);
                    $this->resetInput();
                    $this->flash('success', 'Successfully Category Added!!', [], route('sms.category.index'));
                }
            }
        }catch(Exception $e)
        {
            $this->addError('error', 'Something Went Wrong');
            $this->errorException = 'Something Went Wrong'.$e->getMessage();
        }
    }
    private function inputFields(): array
    {
        return [
            'cate_name' => $this->cate_name,
            'cate_description' => $this->cate_description,
        ];
    }
    public function render()
    {
        return view('livewire.category.category-creation-component');
    }
}
