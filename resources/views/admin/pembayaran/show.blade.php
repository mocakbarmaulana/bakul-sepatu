@extends('layouts.admin')

@section('konten')
@include('utils.flash-message')
<div class="row">
    <div class="col-md-4 mb-3 m-auto">
        <div class="card">
            <div class="card-body">
                <!-- title -->
                <div class="d-md-flex">
                    <div>
                        <h4 class="card-title">Detail Pembayaran</h4>
                    </div>
                </div>
                <!-- title -->

                {{-- List Info pembayaran --}}
                <div class="list-info-payment">
                    <div class="image-proof text-center">
                        <img src="{{asset('storage/assets/images/payment/'.$payment->image_transfer)}}" height="280px"
                            width="100%" alt="img-proof-payment" style="object-fit: contain">
                    </div>
                    <ol class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Nama Transfer</div>
                                {{($payment->name_transfer)}}
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Nama bank</div>
                                {{$payment->name_bank}}
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Nomor kekening bank</div>
                                {{$payment->number_bank}}
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Tanggal Transfer</div>
                                {{ date('l, j F Y', strtotime($payment->date_transfer))}}
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Total Transfer</div>
                                IDR.{{number_format($payment->total)}}
                            </div>
                        </li>
                    </ol>
                    @if ($payment->status === 0)
                    <form action="{{route('pembayaran.update', $payment->id)}}" method="POST">
                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-success w-100 text-white">Konfirmasi pembayaran</button>
                    </form>
                    @endif
                    <a href="{{route('pesanan.show', $payment->order->id)}}"
                        class="btn btn-primary w-100 text-white my-2">Lihat pesanan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
