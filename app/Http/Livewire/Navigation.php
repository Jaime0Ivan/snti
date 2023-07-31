<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;


class Navigation extends Component
{
    public function render()
    {
        /* se envian los datos de todas las categorias en el encabezado  */
        $categories = Category::all();
        return view('livewire.navigation', compact('categories'));
    }
}
