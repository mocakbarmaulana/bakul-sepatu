<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    {{-- Icon bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <title>Invoice</title>
</head>

<body>

    <a href="{{url()->previous()}}" class="btn btn-info">&#8592; Kembali</a>

    <h1>Ini Invoice</h1>

    @if ($errors->any())
    <div class="container">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Terdapat error dalam memasukan field konfirmasi pembayaran
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    @if ($order->payment)
    <div class="container">
        <div class="alert alert-warning" role="alert">
            <i class="bi bi-info-circle"></i> Pembyaran sedang diproses oleh admin, silakan tunggu beberapa saat
        </div>
    </div>
    @endif

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
                <button class="btn btn-primary" data-bs-target="#modalFormPayment" data-bs-toggle="modal">Confirm
                    payment</button>
                <button class="btn btn-success">Pesanan diterima</button>
            </div>
        </div>

        {{-- Confirm Payment --}}
        @include('member.confirm-payment')
    </div>

    {{-- <div class="invoice-payment-order">
        @if ($order->payment)
        <p>Kampret</p>
        @endif
    </div> --}}

    {{-- Modal Confirm Payment --}}

    <!-- Modal -->
    <div class="modal fade" id="modalFormPayment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Konfrimasi Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('member.setpayment')}}" class="form-payment" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="order_id" value="{{$order->id}}">
                        <div class="row">
                            <div class="col d-flex flex-column">
                                <div class="image-preview text-center">
                                    <img src="{{asset('asset/img/404image.jpg')}}" height="280px" width="100%"
                                        class="image-preview" alt="img-preview" style="object-fit: contain">
                                </div>
                                <div class="form-group mt-auto mb-3">
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
                                    <input type="text" name="name_bank" class="form-control"
                                        value="{{old('name_bank')}}" placeholder="BCA">
                                </div>
                                <div class="form-group mb-3">
                                    <label>No. Rekening Bank</label>
                                    @error('number_bank')
                                    <small class="text-danger d-block">*{{$message}}</small>
                                    @enderror
                                    <input type="text" name="number_bank" class="form-control"
                                        value="{{old('number_bank')}}" placeholder="3331112498">
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
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitConfirmPayment()">Konfimasi Bukti
                        Pembayaran</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    {{-- Jqyer --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer">
    </script>

    <script>
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

</body>

</html>
