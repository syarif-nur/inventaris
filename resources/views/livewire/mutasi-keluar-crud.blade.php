@section('page-title')
    Data Mutasi Keluar
@endsection


<div>
    <button wire:click="create">Create New Mutasi Barang keluar</button>

    @if ($isOpen)
        @include('livewire.mutasi_keluar.create')
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Tanggal Keluar</th>
                <th>Jumlah keluar</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mutasiKeluar as $single)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $single->id }}</td>
                    <td>{{ $single->barang->nama_barang }}</td>
                    <td>{{ $single->tanggal_keluar }}</td>
                    <td>{{ $single->jumlah_keluar }}</td>
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
