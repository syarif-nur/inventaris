<div>
    <form wire:submit.prevent="store">
        <div>
            <label for="id_barang">Pilih Barang:</label>
            <select id="id_barang" wire:model="id_barang">
                <option value="">-- Pilih Barang --</option>
                @foreach ($barang as $id => $nama_barang)
                    <option value="{{ $id }}">{{ $nama_barang }}</option>
                @endforeach
            </select>
            @error('barang_id')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="jumlah_masuk">Jumlah:</label>
            <input type="number" id="jumlah_masuk" wire:model="jumlah_masuk">
            @error('jumlah_masuk')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <button type="submit">Create</button>
    </form>
</div>
