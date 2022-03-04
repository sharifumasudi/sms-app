<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use App\Models\SMS\CategoryModel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;

class CategoryComponentLivewire extends Component
{
    use LivewireAlert;
    public CategoryModel $categryObject;
    public $cates = null;
    public $category_id, $cate_name, $cate_description, $findCategoryToDelete;
    public function getListeners()
    {
        return [
            'confirmedTODelete',
            'cancelledToDelete'
        ];
    }
    public function mount()
    {
        $this->categryObject = $categryObject ?? new CategoryModel();
        $this->cates = json_encode($this->categryObject->displayCategories());
    }

    public function editCategory($category_id)
    {
        $categoryDetails = $this->categryObject->query()->findOrFail($category_id);
        $this->category_id = $category_id;
        $this->cate_name = $categoryDetails['cate_name'];
        $this->cate_description = $categoryDetails['cate_description'];
    }
    public function categoryUpdate()
    {
        $this->validate(
            [
                'cate_name' => 'required|max:20',
                'cate_description' => 'required|max:200'
            ]
        );
        if($this->category_id)
        {
            $foundCategory = $this->categryObject->findOrFail($this->category_id);
            $updated = $foundCategory->update($this->inputFields());
            if($updated)
            {
                sleep(2);
                $this->resetInput();
                $this->flash('success', 'Successfully Category Changed',[
                    'toast' => true,
                    'timerProgressBar' => true,
                ], route('sms.category.index'));
            }
        }
    }
    public function resetInput()
    {
        $this->cate_name = null;
        $this->cate_description = null;
    }
    private function inputFields(): array
    {
        return [
            'cate_name' => $this->cate_name,
            'cate_description' => $this->cate_description
        ];
    }
    public function deleteCategory($category_id)
    {
        $this->findCategoryToDelete = $this->categryObject->query()->findOrFail($category_id);
        $this->alert('question', 'Are You Sure Want To delete this Category?',
        [
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
        DB::commit();
        $deleted = $this->findCategoryToDelete->delete();
        if($deleted)
        {
            sleep(2);
            $this->flash('success', 'Category Deleted Successfully!', [], route('sms.category.index'));
        }
    }
    public function cancelledToDelete()
    {
        $this->flash('error', 'Cancelled TO Delete', [], route('sms.category.index'));
    }
    public function close()
    {
        $this->flash('error','Closed!', [], route('sms.category.index'));
    }
    public function render()
    {
        return view('livewire.category.category-component-livewire');
    }
}
// ===================================Masoud-codes Laravel Developer 2022========================================================
