@extends('penggunas.layout')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Daftar Nama Pengguna</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('penggunas.create') }}"> Create New pengguna</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>foto</th>
        <th>nama</th>
        <th>alamat</th>
        <th>NIK</th>
        <th width="280px">Action</th>
    </tr>


@foreach ($penggunas as $pengguna)
<tr>
    <td>{{ ++$i }}</td>
    <td><img src='{{ asset("foto/$pengguna->foto") }}' width="100px"></td>
    {{-- <td><img src="/image/{{ $pengguna->image }}" width="100px"></td> --}}
    <td>{{ $pengguna->foto }}</td>
    <td>{{ $pengguna->nama }}</td>
    <td>{{ $pengguna->alamat }}</td>
    <td>{{ $pengguna->NIK }}</td>
    <td>
        <form action="{{ route('penggunas.destroy',$pengguna->id) }}" method="POST">

            <a class="btn btn-info" href="{{ route('penggunas.show',$pengguna->id) }}">Show</a>

            <a class="btn btn-primary" href="{{ route('penggunas.edit',$pengguna->id) }}">Edit</a>

            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </td>
</tr>
@endforeach

{!! $penggunas->links() !!}

@endsection