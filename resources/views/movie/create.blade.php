@extends('layouts.app')

@section('content')
<div class="container">

  @if ($errors->any())
    @foreach ($errors->all() as $error)
      <div>{{$error}}</div>
    @endforeach
  @endif

  @if($movie->exists)
    <form method="POST"  action="{{ route('movie.update',$movie) }}" enctype="multipart/form-data">
      @method('put')
  @else
    <form method="POST" action="{{ route('movie.store') }}" enctype="multipart/form-data">
  @endif
    @csrf

    <div class="form-group mb-2">
      <label for="title">Title</label>
      <input type="text" name="title" value="{{ old('title', $movie->title) }}"  required class="form-control" id="title">
      @error('title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

    <div class="form-group">
      <label for="category_id">Category</label>
      <select class="form-control" name="category_id" id="category_id">
        <option selected disabled value="">Select</option>
        @foreach (\App\Models\Category::all() as $category)
          <option value="{{$category->id}}" @if(old('category_id', $movie->category_id) == $category->id ) selected @endif>{{ $category->title }}</option>
        @endforeach
      </select>
      @error('category_id')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>


    <div class="form-group mb-2">
      <label for="rate">Rate</label>
      <input type="number" min="0" max="5" name="rate" value="{{ old('rate', $movie->rate) }}"  required class="form-control" id="rate">
      @error('rate')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

    <div class="form-group">
      <label for="description">Description</label>
      <textarea class="form-control" name="description" id="description" rows="3">{{ old('description', $movie->description) }}</textarea>
      @error('description')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

    <div class="form-group mt-3">
      <label for="exampleFormControlFile1">Image</label>
      <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1">
    </div>


    <button type="submit" class="btn btn-primary mt-3">Save</button>
  </form>
</div>
@endsection
