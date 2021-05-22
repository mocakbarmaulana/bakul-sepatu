@extends('layouts.admin')

@section('head')
<title>Edit Kategori</title>
@endsection

@section('konten')
@include('utils.flash-message')
<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <!-- title -->
                <div class="d-md-flex">
                    <div>
                        <h4 class="card-title">Edit Kategori</h4>
                    </div>
                </div>
                <!-- title -->

                {{-- Body Input --}}
                <form action="{{route('kategori.update', $category->id)}}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        @error('name')
                        <br>
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <input type="text" class="form-control" name="name" value="{{$category->name}}"
                            placeholder="Sepatu boots" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block w-100">Update</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div class="col-md-8 mb-3">
        @include('admin.kategori.tabel')
    </div>
</div>


@endsection
