<div class="card">
    <div class="card-body">
        <!-- title -->
        <div class="d-md-flex">
            <div>
                <h4 class="card-title">List Kategori</h4>
            </div>
        </div>
        <!-- title -->
    </div>
    <div class="table-responsive">
        <table class="table v-middle">
            <thead>
                <tr class="bg-light">
                    <th class="border-top-0">Name</th>
                    <th class="border-top-0">Created At</th>
                    <th class="border-top-0 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                <tr>
                    <td>{{$category->name}}</td>
                    <td>{{date('d-m-Y', strtotime($category->created_at))}}</td>
                    <td class="text-center">
                        <form action="{{route('kategori.destroy', $category->id)}}" method="POST">
                            @csrf
                            @method('delete')
                            <a href="{{route('kategori.edit', $category->id)}}"
                                class="btn btn-sm btn-primary rounded">Edit</a>

                            <button type="submit" class="btn btn-sm btn-danger text-white rounded"
                                id="btnDeleteKategori">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td>Kosong</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-3">
        {{$categories->links()}}
    </div>
</div>
