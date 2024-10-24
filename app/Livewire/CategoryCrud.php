<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryCrud extends Component
{
    public $categories;
    public $name;
    public $categoryId;
    public $isEditing = false;

    protected $rules = [
        'name' => 'required|string|max:255|unique:categories,name',
    ];

    public function mount()
    {
        $this->categories = auth()->user()->categories;
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->categoryId = null;
        $this->isEditing = false;
    }

    public function createCategory()
    {
        $this->validate();

        auth()->user()->categories()->create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
        ]);

        $this->resetInputFields();
        $this->categories = auth()->user()->categories;
        session()->flash('message', 'Category created successfully.');
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->isEditing = true;
    }

    public function updateCategory()
    {
        $this->validate();

        $category = Category::findOrFail($this->categoryId);
        $category->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
        ]);

        $this->resetInputFields();
        $this->categories = auth()->user()->categories;
        session()->flash('message', 'Category updated successfully.');
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        $this->categories = auth()->user()->categories;
        session()->flash('message', 'Category deleted successfully.');
    }


    public function render()
    {
        return view('livewire.category-crud')->layout('layouts.app');
    }
}
