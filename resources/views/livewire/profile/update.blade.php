@section('meta_title', 'USER')
@section('page_title', 'EDIT DATA PROFILE')
@section('page_title_icon')
    <i class="metismenu-icon fa fa-users"></i>
@endsection
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <form class="form-horizontal" wire:submit.prevent="update" enctype="multipart/form-data">
                <div class="card-body row">
                    <div class='form-group col-md-12'>
                        <label for='name' class='control-label'> {{ __('Nama Lengkap') }}</label>
                        <input type='text' autofocus placeholder="Nama Lengkap" wire:model.lazy="name"
                            class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                        @error('name')
                        <div class='invalid-feedback'>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='email' class='control-label'> {{ __('Email') }}</label>
                        <input type='email' placeholder="Email" wire:model.lazy="email"
                            class="form-control @error('email') is-invalid @enderror" id='email' name="email">
                        @error('email')
                        <div class='invalid-feedback'>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='password' class='control-label'> {{ __('Password') }}</label>
                        <input type='password' placeholder="Masukkan password"
                            class="form-control @error('password') is-invalid @enderror" id='password' name="password" value="{{ Auth::user()->password }}">
                        @error('password')
                        <div class='invalid-feedback'>{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class='form-group col-md-6'>
                        <label for='password' class='control-label'> {{ __('Password') }}</label>
                        <input type='password' placeholder="Masukkan password" wire:model.lazy="password"
                            class="form-control @error('password') is-invalid @enderror" id='password' name="password">
                        @error('password')
                        <div class='invalid-feedback'>{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class='form-group col-md-6'>
                        <label for='password_confirmation' class='control-label'> {{ __('Password Confirmation') }}</label>
                        <input type='password'  wire:model.lazy='password_confirmation' placeholder="Ulangi Password"
                               class="form-control @error('password_confirmation') is-invalid @enderror" id='password_confirmation'>
                        @error('password_confirmation')
                        <div class='invalid-feedback'>{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">{{ __('Simpan Data') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
