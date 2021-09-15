<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12 ">
                        <input wire:model="search" class="form-control text-center" type="text" placeholder="Cari barang... " autofocus>
                    </div>
                </div>
                <div class="col-md-8"></div>
            </div>
            <div class="card-body">
               <div class="row">
                   @foreach ($products as $p)
                   <div class="col-md-4 mb-3 " :key={{$p->id}}>
                       <div class="card" >
                           {{-- <img class="card-img-top" src="{{ asset('storage/image/'.$p->image) }}" alt="Card image cap"> --}}
                            <img style="object-fit: contain; width: 100%; height:125px" src="{{ asset('storage/image/'.$p->image) }}" alt="Gambar Product">

                            <h6 class="text-center font-weight-bold mt-2" >{{ $p->name }}</h6>
                            <h6 class="text-center font-weight-bold" style="color:grey"> Rp. {{ number_format($p->price,0,',','.') }}</h6>

                            <button wire:click="addItem({{$p->id}})" class="btn btn-primary btn-md" style="position: absolute; top: 0px; right: 0px"><span class="fas fa-cart-plus fa-lg"></span></button>
                       </div>
                   </div>
                   @endforeach
                </div>
                <div class="mt-2" style="display:flex; justify-content: center;">
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </div>
{{-- Batas Product --}}

    <div class="col-md-4" >
        <div class="card" >
            <div class="card-header font-weight-bold text-center bg-primary text-white">
              <span class="fas fa-cart-plus fa-lg mr-2 "></span> Keranjang Belanja
            </div>
            <div class="card-body">
                @if (session()->has('error'))
                <p class="alert alert-warning text-danger font-weight-bold text-center">                    <span class="fas fa-info-circle mr-2"></span>
                        {{session('error')}}
                </p>
                @endif
                <table class="table table-light table-hover table-bordered table-sm" >
                    <thead class="text-center">
                        <tr>
                            <th style="padding-left:15px">No</th>
                            <th>Nama barang</th>
                            <th style="padding-left: 7px">Jumlah</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($carts as $index=>$cart)
                         <tr class="align-middle">
                            <td style="padding: 15px">
                                {{$index+1}} <br>
                                <span wire:click="removeItem('{{$cart['rowId']}}')" class="fas fa-trash" style="cursor: pointer; color:red"></span></td>
                            <td class="align-middle">
                              <strong>{{$cart['name']}}</strong>
                              <br>
                              Rp. {{number_format($cart['pricesingle'],0,',','.')}}
                            </td>
                            <td class="align-middle" style="padding: 7px">
                                <span wire:click="increaseItem('{{$cart['rowId']}}')" class="fas fa-plus-square" style="cursor: pointer;padding-left:4px;color: rgba(13, 115, 248, 0.801)"></span>
                                <strong> {{$cart['qty']}} </strong>
                                <span wire:click="decreaseItem('{{$cart['rowId']}}')" class="fas fa-minus-square" style="cursor: pointer; color:rgba(13, 115, 248, 0.801)"></span>
                            </td>
                            <td class="align-middle text-right"
                            style="padding-left: 0px">Rp. {{number_format($cart['price'],0,',','.')}}</td>
                        </tr>
                            @empty
                            <td colspan="4" class="text-center font-weight-bold " id="kosong">Cart is Empty</td>
                            @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="font-size: 18px" colspan="4" class="text-center font-weight-bold bg-light">Total : Rp. {{ number_format($summary['total'],0,',','.')}}</td>
                        </tr>
                    </tfoot>
                </table>

                {{-- <form wire:submit.prevent="handleSubmit" > --}}
                    <div class="form-group row font-weight-bold text-center" style="padding-left: 10px; padding-right:10px;">
                        <div class="col-md-6">
                            Bayar : <div id="paymentText" wire:ignore>Rp. 0</div>
                         </div>
                         <div class="col-md-6">
                             Kembalian :<div id="kembalianText" wire:ignore>Rp. 0</div>
                         </div>

                     </div>
            </div>
                     <div class="card-footer card-rounded bg-primary">
                        <input type="number" wire:model="payment" class="form-control text-center" id="payment" placeholder="Masukkan Jumlah Bayar.." autofocus>
                        <input type="hidden" id="total" value="{{$summary['total']}}">
                     </div>
                      {{-- <div class="mt-2">
                          <button wire:ignore type="submit" id="saveButton" disabled class="btn btn-success btn-block" id="saveButton"><i class="fas fa-save fa-lg"></i> Save Transaction</button>
                      </div>
                </form> --}}




        </div>

        {{-- <div class="card">
            <div class="card-body row">
            <table class="table table-sm">
                <tr>
                    <td class="text-right">Sub Total :</td>
                    <td class="text-left">Rp.{{ number_format($summary['sub_total'],0,',','.')}}</td>
                </tr>
                <tr>
                    <td class="text-right">Tax :</td>
                    <td>Rp.{{ number_format($summary['pajak'],0,',','.')}}</td>
                </tr>
                <tr>
                    <td class="text-right">Total :</td>
                    <td>Rp.{{ number_format($summary['total'],0,',','.')}}</td>
                </tr>
            </table>
            <div class="col-md-6">
                <button wire:click="enableTax" class="btn btn-info btn-block btn-sm">Add Tax</button>
            </div>
            <div class="col-md-6">
                <button wire:click="disableTax" class="btn btn-danger btn-block btn-sm">Remove Tax</button>
            </div>

            </div>
        </div> --}}
    </div>

</div>

@push('script-custom')
    <script>


        payment.oninput = () => {
            const paymentAmount = document.getElementById("payment").value
            const totalAmount = document.getElementById("total").value

            const kembalian = paymentAmount - totalAmount

            document.getElementById("kembalianText").innerHTML = `Rp. ${rupiah(kembalian)}`
            document.getElementById("paymentText").innerHTML = `Rp. ${rupiah(paymentAmount)}`

            const saveButton =  document.getElementById("saveButton")

            if(kembalian < 0){
                saveButton.disabled = true
            }else{
                saveButton.disabled = false
           }
        }

        const rupiah = (angka) => {
            const numberString = angka.toString()
            const split = numberString.split(',')
            const sisa = split[0].length % 3
            let rupiah = split[0].substr(0, sisa)
            const ribuan = split[0].substr(sisa).match(/\d{1,3}/gi)

            if(ribuan){
                const separator = sisa ? '.' : ''
                rupiah += separator + ribuan.join('.')
            }

            return split[1] != undefined ? rupiah + ',' + split[1] : rupiah
        }


    </script>
@endpush

