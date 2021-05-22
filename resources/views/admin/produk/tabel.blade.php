<div class="card">
    <div class="card-body">
        <!-- title -->
        <div class="d-md-flex">
            <div>
                <h4 class="card-title">List Produk</h4>
            </div>
        </div>
        <!-- title -->
    </div>
    <div class="table-responsive">
        <table class="table v-middle">
            <thead>
                <tr class="bg-light">
                    <th class="border-top-0">Nama</th>
                    <th class="border-top-0">Harga</th>
                    <th class="border-top-0">Ukuran</th>
                    <th class="border-top-0 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                <tr>
                    <td>{{$product->name}}</td>
                    <td>IDR.{{ number_format($product->price)}}</td>
                    <td>{{$product->size}}</td>
                    <td class="text-center">
                        <a href="{{route('produk.show', $product->id)}}" class="btn btn-sm btn-primary rounded">
                            Detail
                        </a>

                        <button type="button" class="btn btn-sm btn-danger text-white rounded btnHapusProduk"
                            data-idproduk="{{$product->id}}" data-toggle="modal" data-target="#modalHapusProduk">
                            Delete
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada produk</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class=" px-3">
        {{$products->links()}}
    </div>
</div>

{{-- Modal Hapus Produk --}}
<div class="modal fade" id="modalHapusProduk" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center mt-4">
                <div>
                    <i class="far fa-times-circle fa-4x text-danger mb-3"></i>
                    <p><strong>Apakah anda yakin ingin menghapus item ini?</strong></p>
                </div>
                <div class="mt-5">
                    <form action="" class="formHapusProduk" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-outline-secondary mx-3" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger text-white mx-3">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
