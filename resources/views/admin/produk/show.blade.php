@extends('layouts.admin')

@section('head')
<title>Show Produk</title>
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
                        <h4 class="card-title">Edit Produk</h4>
                    </div>
                </div>
                <!-- title -->

                {{-- Body Input --}}
                <form action="{{route('produk.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label>Nama sepatu</label>
                        @error('name')
                        <small class="text-danger d-block">{{$message}}</small>
                        @enderror
                        <input type="text" class="form-control" name="name" placeholder="Masukan nama"
                            value="{{$product->name}}" required>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        @error('description')
                        <small class="text-danger d-block">{{$message}}</small>
                        @enderror
                        <textarea class="form-control" name="description" id="editor" cols="30" rows="10"
                            placeholder="Masukan deskripsi" required>{{$product->description}}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Kategori sepatu</label>
                        @error('category_id')
                        <small class="text-danger d-block">{{$message}}</small>
                        @enderror
                        <select name="category_id" class="form-control" required>
                            <option value="">Pilih</option>
                            @forelse ($categories as $category)
                            <option value="{{$category->id}}"
                                {{$category->id == $product->category_id ? 'selected' : ''}}>
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
                            value="{{$product->size}}" required>
                    </div>

                    <div class="form-group">
                        <label>Harga</label>
                        @error('price')
                        <small class="text-danger d-block">{{$message}}</small>
                        @enderror
                        <input type="number" class="form-control" name="price" placeholder="IDR"
                            value="{{$product->price}}" required>
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
                        <img src="{{asset('storage/assets/images/products/'.$product->images)}}"
                            class=" img-fluid image-preview image-thumbnail" alt="no-image" width="100%"
                            style="max-height: 300px">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block w-100">Update Produk</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    {{-- Show Detail --}}
    <div class="col-md-8 mb-3">
        <div class="card">
            <div class="card-body">
                <!-- title -->
                <div class="d-md-flex">
                    <div>
                        <h4 class="card-title">Detail Produk</h4>
                    </div>
                </div>
                <!-- title -->
            </div>
            <div class="detail-container-produk">

                <div class="image-detail-produk text-center">
                    <img src="{{asset('storage/assets/images/products/'.$product->images)}}" alt="{{$product->name}}"
                        height="400px">
                </div>
                <div class="list-detail my-2">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex">
                            <h4 class="m-0 p-0 list-detail-head">Nama</h4>:
                            <h4 class="m-0 px-2"> {{$product->name}}</h4>
                        </li>
                        <li class="list-group-item d-flex">
                            <h4 class="m-0 p-0 list-detail-head">Deskripsi</h4>:
                            <p class="m-0 px-2"> {!!$product->description!!}</p>
                        </li>
                        <li class="list-group-item d-flex">
                            <h4 class="m-0 p-0 list-detail-head">Kategori </h4>:
                            <p class="m-0 px-2"> {{$product->category->name}}</p>
                        </li>
                        <li class="list-group-item d-flex">
                            <h4 class="m-0 p-0 list-detail-head">Ukuran </h4>:
                            <p class="m-0 px-2"> {{$product->size}}</p>
                        </li>
                        <li class="list-group-item d-flex">
                            <h4 class="m-0 p-0 list-detail-head">Harga </h4>:
                            <p class="m-0 px-2 text-danger"><b>IDR.{{number_format($product->price)}}</b></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .list-detail-head {
        width: 150px;
        min-width: 150px;
    }
</style>

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
</script>
@endsection
