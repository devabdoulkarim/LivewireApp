<div>
    <div class="container mt-4">
        <label for="exampleDataList" class="form-label">Rechercher</label>
            <input class="form-control" placeholder="Type to search..." wire:model.debounce.500ms='search'>


        <table class="table mt-4">
            <thead>
                <tr>

                    <th></th>
                    <x-table-header :direction="$orderDirection" name='name' :field="$orderField">Name</x-table-header >
                    <x-table-header :direction="$orderDirection" name='title' :field="$orderField">Title</x-table-header >
                    <x-table-header :direction="$orderDirection" name='status' :field="$orderField">Status</x-table-header >
                    <th scope="col">Role</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $item)
                    <tr>
                        <th scope="row">
                            <img style="border-radius: 100%" src="https://ui-avatars.com/api/?name={{$item->name}}&background=random" alt="">
                        </th>
                        <td>
                            {{ $item->name }} <br>
                            <small>{{ $item->email }}</small>
                        </td>
                        <td>
                            {{ $item->title }}
                        </td>
                        @if ($item->status == '1')
                            <td class="badge bg-success mt-2">
                                Actif
                            </td>
                        @else
                            <td class="badge bg-danger mt-2">
                                Inactif
                            </td>
                        @endif
                        <td>
                            {{ implode(',',$item->roles()->get()->pluck('name')->toArray()) }}
                        </td>
                        <td><a href=""><button class="btn btn-info btn-sm btn-circle"><i
                                        class="fas fa-pen"></i></button></a></td>

                    </tr>
                @empty
                    <tr>
                        <td>No Petitions</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{$users->links()}}
    </div>
</div>
