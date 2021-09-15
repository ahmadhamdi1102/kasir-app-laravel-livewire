<?php

namespace App\Http\Livewire;

use App\Models\Product as ProductModels;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class Product extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $name, $image, $description, $qty, $price;


    public function render()
    {
        $products = ProductModels::orderBy('created_at', 'DESC')->paginate(5);
        return view('livewire.product',
            [ "products" => $products]
        );
    }

    public function store(){
        $this->validate([
            "name" => "required",
            "image" => "image|max:2048|required",
            "description" => "required",
            "qty" => "required",
            "price" => "required",
        ]);

        $imageName = md5($this->image.microtime().".".$this->image->extension());
        Storage::putFileAs(
            'public/image',
            $this->image,
            $imageName
        );

        ProductModels::create([
            'name' => $this->name,
            'image' => $imageName,
            'description' => $this->description,
            'qty' => $this->qty,
            'price' => $this->price,
        ]);

       session()->flash('info', 'Product Succesfully Created');
       $this->name = '';
       $this->image = '';
       $this->description = '';
       $this->qty = '';
       $this->price = '';

    }

}
