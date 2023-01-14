@extends('layouts.app')

@section('content')
<div class="container">

  @if ($errors->any())
    @foreach ($errors->all() as $error)
      <div>{{$error}}</div>
    @endforeach
  @endif

  @if($category->exists)
    <form method="POST"  action="{{ route('category.update',$category) }}">
      @method('put')
  @else
    <form method="POST" action="{{ route('category.store') }}">
  @endif
    @csrf
    <div class="form-group mb-2">
      <label for="inputTitle">Title</label>
      <input type="text" name="title" value="{{ old('title', $category->title) }}"  required class="form-control" id="inputTitle">
      @error('title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
</div>
@endsection
