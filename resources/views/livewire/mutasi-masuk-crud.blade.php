@section('page-title')
    Data Mutasi Masuk
@endsection


<div>
    <button wire:click="create">Create New Mutasi Barang Masuk</button>

    @if ($isOpen)
        @include('livewire.mutasi_masuk.create')
    @endif

    @if ($isOpenEdit)
        @include('livewire.mutasi_masuk.edit')
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Tanggal Masuk</th>
                <th>Jumlah Masuk</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mutasiMasuk as $single)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $single->id }}</td>
                    <td>{{ $single->barang->nama_barang }}</td>
                    <td>{{ $single->tanggal_masuk }}</td>
                    <td>{{ $single->jumlah_masuk }}</td>
                    <td>
                        <button wire:click="delete({{ $single->id }})" wire:confirm="Are you sure you?">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if (session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif

</div>
