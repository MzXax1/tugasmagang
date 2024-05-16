@extends('master')

@section('konten')
<div class="col">
    <!-- Page pre-title -->
    <div class="page-pretitle">
      Overview
    </div>
    <h2 class="page-title">
      Data User
    </h2>
  </div>
<div class="table-responsive">
    <div class="col-auto ms-auto d-print-none">
    <div class="card-body">
        <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" class="form-control">
            <br>
            <button class="btn btn-success">Import User Data</button>
        </form>
    </div>
    </div>
    <table class="table card-table table-vcenter text-nowrap datatable">
      <thead>
        <tr>
            <th colspan="3">
                List Of Users
                <a class="btn btn-warning float-end" href="{{ route('users.export') }}">Export User Data</a>
            </th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
        </tr>
        @endforeach
    </table>
  </div>
</div>
@endsection  