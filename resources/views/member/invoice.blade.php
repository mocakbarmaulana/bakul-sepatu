@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{asset('asset/css/invoice.css')}}">
<title>{{$order->invoice}}</title>
@endsection

@section('main-content')
<section class="detail-invoice">

    @include('utils.flash-msg')
    @if ($order->payment && $order->payment->status == 0)
    <div class="alert alert-warning">
        Pembayaran sedang dilakukan pengecekan oleh admin
    </div>
    @endif

    <h1 class="mb-2">BakulSepatu</h1>
    <hr class="mb-2">
    {{-- Infoice info --}}
    <div class="invoice-info">
        <div class="row">
            <div class="col">
                {{-- <h6>Informasi Pemesan</h6> --}}
                <ul class="list-inline">
                    <li>Nama Lengkap</li>
                    <li>
                        <h5>{{$order->customer_name}}</h5>
                    </li>
                    <li>No.Telephone</li>
                    <li>
                        <h5>{{$order->customer_phone}}</h5>
                    </li>
                    <li>Alamat</li>
                    <li>
                        <h5>{{$order->customer_address}}</h5>
                    </li>
                </ul>
            </div>
            <div class="col">
                {{-- <h6>Informasi Pesanan</h6> --}}
                <ul class="list-inline">
                    <li>Invoice</li>
                    <li>
                        <h5>{{$order->invoice}}</h5>
                    </li>
                    <li>Tanggal</li>
                    <li>
                        <h5>{{$order->created_at->format('d-m-Y')}}</h5>
                    </li>
                </ul>
            </div>
            <div class="col status">
                <h6>Status</h6>
                @if ($order->status == 0)
                <h1 class="text-danger">Belum dibayar</h1>
                @else
                <h1 class="text-success">Dibayar</h1>
                @endif
            </div>
        </div>
    </div>
    <hr class="mb-2">

    {{-- List items --}}
    <div class="list-items">
        <table class="table" style="width: 100%">
            <thead>
                <tr class="mb-2" style="height: 50px;">
                    <th scope="col" class="txt-l">Items</th>
                    <th scope="col" class="txt-r">Quantity</th>
                    <th scope="col" class="txt-r">Price</th>
                    <th scope="col" class="txt-r">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->order_details as $detail)
                <tr>
                    <td>{{$detail->name_product}}</td>
                    <td class="txt-r">{{$detail->qty}}</td>
                    <td class="txt-r">IDR.{{number_format($detail->price_product)}}</td>
                    <td class="txt-r">IDR.{{number_format( $detail->qty * $detail->price_product )}}</td>
                </tr>
                @endforeach
                <tr class="txt-r">
                    <td colspan="3"><b>Total</b></td>
                    <td><b>IDR.{{ number_format($order->subtotal)}}</b></td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Button container --}}
    <div class="button-box">
        <a href="{{route('member.order')}}" class="link-a"><i class="fas fa-arrow-left"></i> Kembali</a>
        @if ($order->status == 0)
        <button class="button btn-confirm">
            Confirm payment
        </button>
        @endif
    </div>

    <div class="container-payment" style="display: none">
        <div class="container">
            <form action="{{route('member.setpayment')}}" class="form-payment" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="order_id" value="{{$order->id}}">
                <div class="row">
                    <div class="col">
                        <div class="image-preview text-center">
                            <img src="{{asset('asset/img/404image.jpg')}}" height="280px" width="100%"
                                class="image-preview" alt="img-preview" style="object-fit: contain">
                        </div>
                        <div class="form-group">
                            @error('image')
                            <small class="text-danger d-block">*{{$message}}</small>
                            @enderror
                            <input type="file" name="image" id="uploadImage" class="form-control">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mb-3">
                            <label>Nama pengirim</label>
                            @error('name')
                            <small class="text-danger d-block">*{{$message}}</small>
                            @enderror
                            <input type="text" name="name" class="form-control" value="{{old('name')}}"
                                placeholder="Bambang">
                        </div>
                        <div class="form-group mb-3">
                            <label>Nama Bank</label>
                            @error('name_bank')
                            <small class="text-danger d-block">*{{$message}}</small>
                            @enderror
                            <input type="text" name="name_bank" class="form-control" value="{{old('name_bank')}}"
                                placeholder="BCA">
                        </div>
                        <div class="form-group mb-3">
                            <label>No. Rekening Bank</label>
                            @error('number_bank')
                            <small class="text-danger d-block">*{{$message}}</small>
                            @enderror
                            <input type="text" name="number_bank" class="form-control" value="{{old('number_bank')}}"
                                placeholder="3331112498">
                        </div>
                        <div class="form-group mb-3">
                            <label>Tanggal Transfer</label>
                            @error('date_transfer')
                            <small class="text-danger d-block">*{{$message}}</small>
                            @enderror
                            <input type="date" name="date_transfer" class="form-control"
                                value="{{old('date_transfer')}}" placeholder="19-08-2021">
                        </div>
                        <div class="form-group mb-3">
                            <label>Nominal Transfer</label>
                            @error('total')
                            <small class="text-danger d-block">*{{$message}}</small>
                            @enderror
                            <input type="text" name="total" class="form-control" value="{{old('total')}}"
                                placeholder="IDR.1200000">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="button btn-upload">Upload Payment</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@section('js')
<script>
    $(".btn-confirm").on("click", () => {
        $(".container-payment").toggle();
    })

    const submitConfirmPayment = () => {
        document.querySelector(".form-payment").submit();
    }

    $("#uploadImage").change(function(){
        const name = $(this.files[0])[0].name;
        readUrlImage($(this));
    });

    // Function menampilkan preview upload image
    const readUrlImage = (input) => {
        let reader = new FileReader();
        reader.onload = function(e){
        $(".image-preview").attr('src', e.target.result);
        }
        reader.readAsDataURL(input[0].files[0]);
    }
</script>
@endsection
