@extends('layouts.admin')

@section('head')
<title>Produk</title>
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
                        <h4 class="card-title">Tambah Produk</h4>
                    </div>
                </div>
                <!-- title -->

                {{-- Body Input --}}
                <form action="{{route('produk.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Nama sepatu</label>
                        @error('name')
                        <small class="text-danger d-block">{{$message}}</small>
                        @enderror
                        <input type="text" class="form-control" name="name" placeholder="Masukan nama"
                            value="{{old('name')}}" required>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        @error('description')
                        <small class="text-danger d-block">{{$message}}</small>
                        @enderror
                        <textarea class="form-control" name="description" id="editor" cols="30" rows="10"
                            placeholder="Masukan deskripsi" required>{{old('description')}}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Kategori sepatu</label>
                        @error('category_id')
                        <small class="text-danger d-block">{{$message}}</small>
                        @enderror
                        <select name="category_id" class="form-control" required>
                            <option value="">Pilih</option>
                            @forelse ($categories as $category)
                            <option value="{{$category->id}}" {{$category->id == old('category_id') ? 'selected' : ''}}>
                                {{$category->name}}</option>
                            @empty
                            <option></option>
                            @endforelse
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Ukuran</label>
                        @error('size')
                        <small class="text-danger d-block">{{$message}}</small>
                        @enderror
                        <input type="text" class="form-control" name="size" placeholder="Ex. 27, 29, 30"
                            value="{{old('size')}}" required>
                    </div>

                    <div class="form-group">
                        <label>Harga</label>
                        @error('price')
                        <small class="text-danger d-block">{{$message}}</small>
                        @enderror
                        <input type="number" class="form-control" name="price" placeholder="IDR"
                            value="{{old('price')}}" required>
                    </div>

                    <div class="form-group">
                        <label>Upload image</label>
                        @error('image')
                        <small class="text-danger d-block">{{$message}}</small>
                        @enderror
                        <input type="file" class="form-control" id="uploadImage" name="image">
                    </div>

                    {{-- Preview uplaod images --}}
                    <div class="image-preview-box text-center mb-5">
                        <img src="" class=" img-fluid image-preview image-thumbnail" alt="no-image" width="100%"
                            style="max-height: 300px">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block w-100">Tambah</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div class="col-md-8 mb-3">
        @include('admin.produk.tabel')
    </div>
</div>


@endsection

@section('js')
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace('editor');

    // Event listener apakah ada perubahan pada input uploa dimage
    $("#uploadImage").change(function(){
        const name = $(this.files[0])[0].name;
        console.log(name)
        readUrlImage($(this));
    });

    // Function menampilkan preview upload image
    const readUrlImage = (input) => {
        let reader = new FileReader();
        console.log(reader);
        reader.onload = function(e){
        $(".image-preview").attr('src', e.target.result);
        }
        reader.readAsDataURL(input[0].files[0]);
    }

    // Event Listener button hapus produk
    $(".btnHapusProduk").on("click", function(){
        const id = $(this)[0].dataset.idproduk;
        $(".formHapusProduk").attr('action', `/administrator/produk/${id}`)
    });
</script>
@endsection
