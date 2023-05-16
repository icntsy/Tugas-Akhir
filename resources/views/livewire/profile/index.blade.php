@section('meta_title', 'PROFILE')
@section('page_title', 'DATA PROFILE')
@section('page_title_icon')
    <i class="metismenu-icon fa fa-users"></i>
@endsection

<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        padding: 20px;
        margin-top: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-control {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 10px;
        width: 100%;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
    }

    .btn-primary:hover {
        background-color: #0069d9;
        border-color: #0062cc;
        color: #fff;
    }
</style>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card mt-2">
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" value="{{ $user->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" value="{{ $user->password }}" readonly>
                    </div>
                    <a href="{{ route('profile.update', ['profile' => $user->id]) }}" class="btn btn-success">Edit Profile</a>
                </form>
            </div>
        </div>
    </div>
</div>



{{-- <div class="form-group">
              <label for="avatar">Avatar</label>
              <img src="avatar.jpg" alt="Avatar" class="img-fluid">
            </div> --}}
            {{-- <a href="{{ route('user.update', ['user' => $user->id]) }}" class="btn text-warning">
                <i class="fa fa-edit fa-1x"></i>Edit Profile
            </a> --}}

{{-- <div class="row">
    <div class="col-md-8 offset-md-2">
      <div class="card mt-2">
        <div class="card-body">
          <form>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" value="{{ $user->name ?? '' }}" readonly>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" value="{{ $user->email ?? '' }}" readonly>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" value="{{ $user->password ?? '' }}" readonly>
            </div> --}}
            {{-- <div class="form-group">
              <label for="avatar">Avatar</label>
              <img src="avatar.jpg" alt="Avatar" class="img-fluid">
            </div> --}}
            {{-- <a href="#" class="btn btn-primary">Edit Profile</a> --}}

            {{-- @foreach ($users as $user)
              @if ($user->id == auth()->user()->id) --}}
                <!-- Your additional code here -->
              {{-- @endif
            @endforeach --}}

          {{-- </form>
        </div>
      </div>
    </div>
  </div> --}}
