<div>
    <form wire:submit.prevent="store">
        <div>
            <label for="nama_barang">Nama Barang:</label>
            <input type="text" id="nama_barang" wire:model="nama_barang">
            @error('nama_barang')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="jumlah">Jumlah:</label>
            <input type="number" id="jumlah" wire:model="jumlah">
            @error('jumlah')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <button type="submit">Create</button>
    </form>
</div>
