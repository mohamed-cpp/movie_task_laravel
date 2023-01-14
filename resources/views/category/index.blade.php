@extends('layouts.app')

@section('content')
<div class="container">

  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      @if(!empty($data) && $data->count())
      @foreach($data as $key => $value)
              <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->title }}</td>
                <td>
                    <a href="{{route('category.edit', $value->id)}}">
                      <button class="btn btn-primary">Edit</button>
                    </a>
                    <form style="display: inline-block;" method="POST" action="{{ route('category.delete', $value->id) }}" > 
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
