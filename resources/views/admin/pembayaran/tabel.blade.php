<div class="card">
    <div class="card-body">
        <!-- title -->
        <div class="d-md-flex">
            <div>
                <h4 class="card-title">List Pembayaran</h4>
            </div>
        </div>
        <!-- title -->
    </div>
    <div class="table-responsive">
        <table class="table v-middle">
            <thead>
                <tr class="bg-light">
                    <th class="border-top-0" style="width: 200px">Nama transfer</th>
                    <th class="border-top-0 text-center field-20">Total</th>
                    <th class="border-top-0 text-center field-20">Tanggal Transfer</th>
                    <th class="border-top-0 text-center field-20">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $payment)
                <tr>
                    <td>{{$payment->name_transfer}}</td>
                    <td>IDR.{{number_format($payment->total)}}</td>
                    <td class="text-center">{{date('l, j F Y', strtotime($payment->date_transfer))}}</td>
                    <td class="text-center">
                        <a href="{{route('pembayaran.show', $payment->id)}}" class="btn btn-sm btn-primary rounded">
                            Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada pembayaran</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class=" px-3">
        {{$payments->links()}}
    </div>
</div>

<style>
    .field-20 {
        width: 100px;
    }
</style>
