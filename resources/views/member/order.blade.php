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

                @forelse ($orders as $order)
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
                @empty
                <tr>
                    <td colspan="4" class="txt-c">Tidak ada pesanan</td>
                </tr>
                @endforelse
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
