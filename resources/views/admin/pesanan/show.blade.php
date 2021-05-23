@extends('layouts.admin')

@section('konten')
<div class="card">
    <div class="invoice-head p-3 px-4">
        <h1>{{$order->invoice}}</h1>
        <hr>
    </div>

    {{-- Info detail user invoice --}}
    <div class="row px-3 mb-5">
        <div class="col-4">
            <ol class="list-group list-group-flush">
                <li class="list-group-item border-bottom-0">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">Nama Member</div>
                        {{$order->customer_name}}
                    </div>
                </li>
                <li class="list-group-item border-bottom-0">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">Nomor Hp</div>
                        {{$order->customer_phone}}
                    </div>
                </li>
                <li class="list-group-item border-bottom-0">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">Alamat Member</div>
                        {{$order->customer_address}}
                    </div>
                </li>
            </ol>
        </div>
        <div class="col-4">
            <ol class="list-group list-group-flush">
                <li class="list-group-item">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">Tanggal Pemesanan</div>
                        {{$order->created_at->format('l, j F Y')}}
                    </div>
                </li>
            </ol>
        </div>
        <div class="col-4">
            <ol class="list-group list-group-flush">
                <li class="list-group-item">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">Status</div>
                        @if ($order->status === 1 && $order->payment->status === 1)
                        <h1 class="display-6 text-success fw-bold">Berhasil dibayar</h1>
                        @else
                        <h1 class="display-6 text-danger fw-bold">Belum dibayar</h1>
                        @endif
                    </div>
                </li>
            </ol>
        </div>
    </div>

    {{-- Tabel List invoice --}}
    <div class="table-responsive">
        <table class="table v-middle">
            <thead>
                <tr class="bg-main-color">
                    <th class="border-top-0 text-white">Items</th>
                    <th class="border-top-0 text-end field-20 text-white">Quantity</th>
                    <th class="border-top-0 text-end field-20 text-white">Price</th>
                    <th class="border-top-0 text-end field-20 text-white">Amount</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($order->order_details as $detail)
                <tr class="align-middle">
                    <td class="d-flex align-items-center">
                        <img src="{{asset('storage/assets/images/products/'.$detail->product->images)}}"
                            alt="img-produk" class="me-3" width="60px" height="60px">
                        <div class="info-product">
                            <h6 class="m-0">
                                <a href="{{route('produk.show', $detail->product_id)}}" class="text-dark">
                                    {{$detail->name_product}}
                                </a>
                            </h6>
                            <span>(Size: {{$detail->size_product}})</span>
                        </div>
                    </td>
                    <td class=" text-end">{{$detail->qty}}
                    </td>
                    <td class="text-end">IDR.{{ number_format($detail->price_product)}}</td>
                    <td class="text-end">IDR.{{ number_format($detail->price_product * $detail->qty)}}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada pesanan</td>
                </tr>
                @endforelse
                <tr>
                    <th colspan="3" class="text-end">Total:</th>
                    <th class="text-end">IDR.{{ number_format($order->subtotal)}}</th>
                </tr>
            </tbody>
        </table>
        @if ($order->payment)
        <div class="p-3 pt-0 text-end">
            <a href="{{route('pembayaran.show', $order->payment->id)}}" class="btn btn-primary">Cek Pembayaran</a>
        </div>
        @endif
    </div>
</div>

<style>
    .field-20 {
        width: 200px;
    }

    .bg-main-color {
        background: #4fc3f7;
    }
</style>

@endsection
