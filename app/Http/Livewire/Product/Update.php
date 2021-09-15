<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;

class Update extends Component
{

    public function render()
    {
        $data = $this->id;
        return view('livewire.product.update',[
            'id' => $data,
        ]);
    }


}
