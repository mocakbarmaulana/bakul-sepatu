@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{asset('asset/css/order.css')}}">
<title>Pesanan</title>
@endsection

@section('main-content')
{{-- Order Page --}}
<div class="order-page">
    <h1>List Pesanan</h1>

    <div class="list-order">
        <table class="table" style="width: 100%">
            <thead>
                <tr class="mb-2" style="height: 50px;">
                    <th scope="col" class="txt-l">Invoice</th>
                    <th scope="col" class="txt-c">Subtotal</th>
                    <th scope="col" class="txt-c">Status</th>
                    <th scope="col" class="txt-c">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{$order->invoice}}</td>
                    <td class="txt-c">IDR.{{number_format($order->subtotal)}}</td>
                    <td class="txt-c">
                        @if ($order->status == 0)
                        <span class="text-danger">Belum dibayar</span>
                        @else
                        <span class="text-success">Sudah dibayar</span>
                        @endif
                    </td>
                    <td class="txt-c">
                        <a href="{{route('member.invoice', $order->invoice)}}" class="button btn-detail">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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

{{--

     @forelse ($orders as $order)
        <div class="card mb-3">
            <div class="card-header">
                {{$order->invoice}}
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table v-middle">
            <thead>
            </thead>
            <tbody>
                @forelse ($order->order_details as $detail)
                <tr class="align-middle">
                    <td class="d-flex align-items-center">
                        <img src="{{asset('storage/assets/images/products/'.$detail->product->images)}}"
                            alt="img-produk" class="me-3" width="60px" height="60px">
                        <div class="info-product">
                            <h6 class="m-0">{{$detail->name_product}}</h6>
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
            </tbody>
            <tfoot>
                <tr class="bg-light">
                    <th colspan="3" class="text-end">Total:</th>
                    <th class="text-end">IDR.{{ number_format($order->subtotal)}}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<div class="card-footer fw-bold text-end">
    <a href="{{route('member.invoice', $order->invoice)}}" class="btn btn-info text-white">
        Detail Pesanan
    </a>
</div>
</div>
@empty
<div class="text-center">
    <p>Tidak ada pesanan</p>
</div>
@endforelse

--}}
