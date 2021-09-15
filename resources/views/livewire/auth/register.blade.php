<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center font-weight-bold">Register</div>
                @if(session()->has('error')) <span class="text-danger text-center mt-2">{{session('error')}}</span> @endif
                <div class="card-body">
                    <form wire:submit.prevent="submit">
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Name</label>
                        <div class="col-md-6">
                            <input wire:model="form.name" type="text" class="form-control " placeholder="Input your valid email" autofocus>
                            @error('form.name') <span class="text-danger">{{$message}}</span>@enderror
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                        <div class="col-md-6">
                            <input wire:model="form.email" type="text" class="form-control" placeholder="Input your valid email" autofocus>
                            @error('form.email') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Password</label>
                        <div class="col-md-6">
                            <input wire:model="form.password" type="password" class="form-control" placeholder="Input your valid password" autofocus>
                            @error('form.password') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>

                    <div class="form-group row" >
                        <label for="email" class="col-md-4 col-form-label text-md-right">Password</label>
                        <div class="col-md-6">
                            <input wire:model="form.password_confirmation" type="password" class="form-control" placeholder="Repeat your password" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8 offset-md-2">
                            <button class="btn btn-block btn-primary form-control">Register</button>
                        </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
