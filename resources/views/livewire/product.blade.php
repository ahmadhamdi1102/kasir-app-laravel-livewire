<div>
  <div class="row">
      <div class="col-md-8">
        <div class="card">
            <div class="card-header text-center">
                Product
            </div>
            <div class="card-body">
               <table class="table table-hover table-striped table-bordered">
                   <thead class="thead-light">
                       <tr>
                           <th>#</th>
                           <th>Name</th>
                           <th width="20%">Image</th>
                           <th>Description</th>
                           <th>Qty</th>
                           <th>Price</th>
                           <th>Action</th>
                       </tr>
                   </thead>
                   <tbody>
                       @foreach ($products as $index=>$p)
                        <tr >
                           <td class="align-middle"> {{ $index + 1}} </td>
                           <td class="align-middle"> {{ $p->name }} </td>
                           <td class="align-middle"> <img class="img-fluid" src="{{ asset('storage/image/'.$p->image) }}" alt=""> </td>
                           <td class="align-middle"> {{ $p->description }} </td>
                           <td class="align-middle"> {{ $p->qty }} </td>
                           <td class="align-middle">Rp. {{ number_format($p->price,0,',','.') }} </td>
                           <td class="align-middle">
                               <a href="{{route('product-update'), $p->id}}" class="btn btn-primary btn-sm"><span class="fas fa-edit"></span></a>

                                <button class="btn btn-danger btn-sm"><span class="fas fa-trash"></span></button>
                            </td>
                        </tr>
                        @endforeach
                   </tbody>
               </table>
               <div class="mt-2" style="display:flex; justify-content: center;">
                {{$products->links()}}
            </div>
            </div>
        </div>
      </div>
      {{-- Batas tabel Product --}}
      <div class="col-md-4">
        <div class="card">
            <div class="card-header text-center">
                Create Product
            </div>
            <div class="card-body">
                <form wire:submit.prevent="store">
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input wire:model="name" type="text" class="form-control">
                        @error('name')
                            <small class="text-danger"> {{$message}} </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Image</label>
                        <div class="custom-file">
                            <input wire:model="image" type="file" class="custom-file-input" id="customFile">
                            <label for="customFile" class="custom-file-label">Choose Image</label>
                            @error('image')
                                <small class="text-danger"> {{$message}} </small>
                            @enderror
                        </div>
                        @if($image)
                            <label class="mt-2">Preview Image</label>
                            <img src="{{$image->temporaryUrl()}}" class="img-fluid" alt="Preview Image">
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea wire:model="description" class="form-control"> </textarea>
                        @error('description')
                            <small class="text-danger"> {{$message}} </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Qty</label>
                        <input wire:model="qty" type="number" class="form-control">
                        @error('qty')
                            <small class="text-danger"> {{$message}} </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Price</label>
                        <input wire:model="price" type="number" class="form-control">
                        @error('price')
                            <small class="text-danger"> {{$message}} </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">Submit Product</button>
                    </div>
                    </form>
                </div>
        </div>
      </div>
  </div>


</div>
