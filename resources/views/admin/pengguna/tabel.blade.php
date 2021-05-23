<div class="card">
    <div class="card-body">
        <!-- title -->
        <div class="d-md-flex">
            <div>
                <h4 class="card-title">List Pengguna</h4>
            </div>
        </div>
        <!-- title -->
    </div>
    <div class="table-responsive">
        <table class="table v-middle">
            <thead>
                <tr class="bg-light">
                    <th class="border-top-0 text-center">Nama</th>
                    <th class="border-top-0 text-center">Email</th>
                    <th class="border-top-0 text-center">Nomor handphone</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($members as $member)
                <tr>
                    <td class="text-center">{{$member->name}}</td>
                    <td class="text-center">{{$member->email}}</td>
                    <td class="text-center">
                        @if ($member->phone_number)
                        {{$member->phone_number}}
                        @else
                        -
                        @endif
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
        {{$members->links()}}
    </div>
</div>
