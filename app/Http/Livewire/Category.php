<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category as Categories;
use Illuminate\Support\Facades\Log;

class Category extends Component {
    public $categories, $name, $description, $category_id;
    public $updateCategory = false;
    protected $rules = ['name' => 'required', 'description' => 'required'];
    protected $listeners = [
        'deleteCategory' => 'destroy'
    ];

    public function render() {
        $this->categories = Categories::select('id', 'name', 'description')->get();
        return view('livewire.category.category');
    }

    public function resetFields() {
        $this->name = '';
        $this->description = '';
    }
    public function cancel() {
        $this->updateCategory = false;
        $this->resetFields();
    }
    public function store() {
        $this->validate();
        try {
            Categories::create(['name' => $this->name, 'description' => $this->description]);
            session()->flash('success', 'Categoria criada com sucesso!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'Erro ao criar categoria.');
        }
        $this->resetFields();
    }

    public function edit($id) {
        try {
            $category = Categories::findOrFail($id);
            $this->name = $category->name;
            $this->description = $category->description;
            $this->category_id = $category->id;
            $this->updateCategory = true;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            session()->flash('error', 'Categoria não encontrada.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'Erro ao editar categoria.');
        }
    }
    public function update() {
        $this->validate();
        try {
            Categories::find($this->category_id)->fill([
                'name' => $this->name,
                'description' => $this->description
            ])->save();
            session()->flash('success', 'Categoria atualizada com sucesso!');

            $this->cancel();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'Erro ao atualizar categoria.');
            $this->cancel();
        }
    }
    public function destroy($id) {
        try {
            Categories::find($id)->delete();
            $this->cancel();
            session()->flash('success', "Categoria deletada com sucesso!");
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', "Erro ao deletar categoria.");
        }
    }
}
