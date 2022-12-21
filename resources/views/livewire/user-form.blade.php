<td colspan="6">
   <form action="" wire:submit.prevent="save">
    <div wire:loading class="text-warning text-weight-bold">Chargement...</div>
    <div class="row">
        <div class="col-md-4">
            <label for="" class="label">Name</label>
            <input type="text" wire:model.defer="user.name" class="form-control">
            @error('user.name')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-md-4">
            <label for="" class="label">Title</label>
            <input type="text" wire:model.defer="user.title" class="form-control">
            @error('user.title')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="buttons">
        <button type="submit" class="btn btn-primary mt-2" wire:loading.attr="disabled">Sauvegarder</button>
    </div>
   </form>
</td>

