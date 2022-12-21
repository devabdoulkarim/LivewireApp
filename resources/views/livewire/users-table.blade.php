<div x-data="{selection: @entangle('selection').defer }">
    {{-- @dump($selection) --}}
    {{-- <span x-html="JSON.stringify(selection)"></span> --}}


    <div class="container mt-4">
        <div>
            <label for="exampleDataList" class="form-label">Rechercher</label>
            <input class="form-control" placeholder="Type to search..." wire:model.debounce.500ms='search'>
        </div>

        @if (session()->has('success'))
        <div class="alert alert-success mt-4" role="alert">
           <strong class="text-center">{{session('success')}}</strong>
        </div>
        @endif

        <button class="btn btn-danger mt-2" x-show="selection.length > 0" x-on:click="$wire.deleteUsers(selection)">Supprimer</button>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th></th>
                    <x-table-header :direction="$orderDirection" name='name' :field="$orderField">
                       <span style="cursor: pointer">Name</span>
                    </x-table-header >
                    <x-table-header :direction="$orderDirection" name='title' :field="$orderField">Title</x-table-header >
                    <x-table-header :direction="$orderDirection" name='status' :field="$orderField">Status</x-table-header >
                    <th scope="col">Role</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @forelse ($users as $item)
                    <tr>
                        <td>
                            <input type="checkbox" x-model:model="selection" value="{{$item->id}}">
                        </td>
                        <td scope="row">
                            <img style="border-radius: 100%" src="https://ui-avatars.com/api/?name={{$item->name}}&background=random" alt="">
                        </td>
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
                        <td>
                            <button class="btn btn-info btn-sm btn-circle" wire:click="startEdit({{$item->id}})"><i class="fas fa-pen"></i></button>
                        </td>
                    </tr>
                    @if ($editId == $item->id)
                        <tr>
                           <livewire:user-form :user="$item" :key='$item->id'>
                        </tr>
                    @endif
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
