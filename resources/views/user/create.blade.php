@extends('layouts.app')

@section('content')
<div class="container">

  @if ($errors->any())
    @foreach ($errors->all() as $error)
      <div>{{$error}}</div>
    @endforeach
  @endif

  @if($user->exists)
    <form method="POST"  action="{{ route('admin.update',$user) }}">
      @method('put')
  @else
    <form method="POST" action="{{ route('admin.store') }}">
  @endif
    @csrf
    <input type="hidden" name="id_user" value="{{$user->id}}">

    <div class="form-group mb-2">
      <label for="inputTitle">Name</label>
      <input type="text" name="name" value="{{ old('name', $user->name) }}"  required class="form-control" id="inputTitle">
      @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

    <div class="form-group mb-2">
      <label for="email">Email</label>
      <input type="email" name="email" value="{{ old('email', $user->email) }}"  required class="form-control" id="email">
      @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

    <div class="form-group mb-2">
      <label for="birthdate">Birthdate</label>
      <input type="date" name="birthdate" value="{{ old('birthdate', $user->birthdate) }}"  required class="form-control" id="birthdate">
      @error('birthdate')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>


    <div class="form-group mb-2">
      <label for="password">Password</label>
      <input type="password" name="password" class="form-control" id="password">
      @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

    <div class="form-group mb-2">
      <label for="password_confirmation">Password Confirmation</label>
      <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
      @error('password_confirmation')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>


    <button type="submit" class="btn btn-primary">Save</button>
  </form>
</div>
@endsection
