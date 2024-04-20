<div>
    <form wire:submit.prevent="update">
        <div>
            <label for="edit_nama_barang">Nama Barang:</label>
            <input type="text" id="edit_nama_barang" wire:model="nama_barang">
            @error('nama_barang')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="edit_jumlah">Jumlah:</label>
            <input type="number" id="edit_jumlah" wire:model="jumlah">
            @error('jumlah')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <button type="submit">Update</button>
    </form>
</div>
