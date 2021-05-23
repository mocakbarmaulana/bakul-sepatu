<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Invoice</title>
</head>

<body>
    <h1>Ini Invoice</h1>


    <div class="invoice-container">
        <div class="invoice-info">
            <div class="container">
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
        </div>
        {{-- List items --}}
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Items</th>
                        <th scope="col" class="text-end">Quantity</th>
                        <th scope="col" class="text-end">Price</th>
                        <th scope="col" class="text-end">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->order_details as $detail)
                    <tr>
                        <td>{{$detail->name_product}}</td>
                        <td class="text-end">{{$detail->qty}}</td>
                        <td class="text-end">IDR.{{number_format($detail->price_product)}}</td>
                        <td class="text-end">IDR.{{number_format( $detail->qty * $detail->price_product )}}</td>
                    </tr>
                    @endforeach
                    <tr class="text-end">
                        <td colspan="3"><b>Total</b></td>
                        <td><b>IDR.{{ number_format($order->subtotal)}}</b></td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Button container --}}
        <div class="button-box">
            <div class="container">
                <button class="btn btn-primary">Confirm payment</button>
                <button class="btn btn-success">Pesanan diterima</button>
            </div>
        </div>

        {{-- Confirm Payment --}}
        @include('member.confirm-payment')
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

</body>

</html>
