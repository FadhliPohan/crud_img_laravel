    @extends('penggunas.layout')

    @section('content')
        <div class="container">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Tambah Pengguna</h2>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('penggunas.index') }}"></a>
                    </div>
                </div>
            </div>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <strong> Whoops!</strong> Ada yang saalah dengan inputan yang anda masukkan. <br><br>
            <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>     
            @endforeach
            </ul>
        </div>
            
        @endif

        <form action="{{ route('penggunas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <strong>Nama :</strong>
                <input type="text" name="nama" class="form-control" placeholder="Nama">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <strong>alamat :</strong>
                <textarea style="height: 150px" name="alamat" class="form-control" placeholder="alamat"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <strong>NIK :</strong>
                <input type="text" name="NIK" class="form-control" placeholder="NIK">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <strong>foto :</strong>
                <input type="file" name="foto" class="form-control" placeholder="foto">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-primary"> Submit</button>
            </div>
        </div>
        </form>
    @endsection