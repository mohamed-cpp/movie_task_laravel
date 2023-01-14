@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <h2> Filters </h2>
    <form> 
      <div class="col">
        <label for="title">Title</label>
        <input  class="form-control" name="title" value="{{request()->get('title')}}" id="title" type="text" />
      </div>
      <div class="col">
        <label for="category_id">Category</label>
        <select class="form-control" name="category_id" id="category_id">
          <option selected value="">No Filter</option>
          @foreach (\App\Models\Category::all() as $category)
            <option value="{{$category->id}}" @if(request()->get('category_id') == $category->id ) selected @endif>{{ $category->title }}</option>
          @endforeach
        </select>
      </div>
      <div class="col">
        <label for="rate">Rate</label>
        <select class="form-control" name="rate" id="rate">
          <option selected value="null">No Filter</option>
          @for ($i = 0; $i <= 5; $i++)
            <option @if(request()->get('rate') == $i ) selected @endif value="{{ $i }}">{{ $i }}</option>
          @endfor
        </select>
      </div>
      <div class="col mt-2"> <button type="submit" class="btn btn-primary">Search</button></div>
    </form>
  </div>
  <br>
  <h2> Movies </h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Image</th>
        <th scope="col">Title</th>
        <th scope="col">Category</th>
        <th scope="col">Rate</th>
        <th scope="col">Description</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      @if(!empty($data) && $data->count())
      @foreach($data as $key => $value)
              <tr>
                <td>{{ $value->id }}</td>
                <td><img src="{{$value->photoUrl()}}" width="80" height="80" class="img-thumbnail"></td>
                <td>{{ $value->title }}</td>
                <td>@if($value->category) {{$value->category->title}} @endif</td>
                <td>{{ $value->rate }} / 5</td>
                <td>{{ $value->description }}</td>
                <td>
                    <a href="{{route('movie.edit', $value->id)}}">
                      <button class="btn btn-primary">Edit</button>
                    </a>
                    <form style="display: inline-block;" method="POST" action="{{ route('movie.delete', $value->id) }}" > 
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
              </tr>
          @endforeach
      @else
          <tr>
              <td colspan="10">There are no data.</td>
          </tr>
      @endif
    </tbody>
  </table>
  {!! $data->links() !!}
</div>
@endsection
