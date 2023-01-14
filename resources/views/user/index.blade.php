@extends('layouts.app')

@section('content')
<div class="container">

  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">birthdate</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      @if(!empty($data) && $data->count())
      @foreach($data as $key => $value)
              <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->email }}</td>
                <td>{{ $value->birthdate }}</td>
                <td>
                    <a href="{{route('admin.edit', $value->id)}}">
                      <button class="btn btn-primary">Edit</button>
                    </a>
                    <form style="display: inline-block;" method="POST" action="{{ route('admin.delete', $value->id) }}" > 
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
