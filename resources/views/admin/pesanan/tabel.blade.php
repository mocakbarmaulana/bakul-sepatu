<div class="card">
    <div class="card-body">
        <!-- title -->
        <div class="d-md-flex">
            <div>
                <h4 class="card-title">List Pesanan</h4>
            </div>
        </div>
        <!-- title -->
    </div>
    <div class="table-responsive">
        <table class="table v-middle">
            <thead>
                <tr class="bg-light">
                    <th class="border-top-0" style="width: 200px">Invoice</th>
                    <th class="border-top-0">Nama Member</th>
                    <th class="border-top-0 text-center">subtotal</th>
                    <th class="border-top-0 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                <tr>
                    <td>{{$order->invoice}}</td>
                    <td>{{$order->customer_name}}</td>
                    <td class="text-center">IDR.{{number_format($order->subtotal)}}</td>
                    <td class="text-center">
                        <a href="{{route('pesanan.show', $order->id)}}" class="btn btn-sm btn-primary rounded">
                            Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada pesanan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class=" px-3">
        {{$orders->links()}}
    </div>
</div>
