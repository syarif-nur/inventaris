@section('page-title')
    Data Barang
@endsection


<div>
    <button wire:click="create">Create New Barang</button>

    @if ($isOpen)
        @include('livewire.barang.create')
    @endif

    @if ($isOpenEdit)
        @include('livewire.barang.edit')
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $barang)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $barang->id }}</td>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->jumlah }}</td>
                    <td>
                        <button wire:click="edit({{ $barang->id }})">Edit</button>
                        <button wire:click="delete({{ $barang->id }})" wire:confirm="Are you sure you?">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if (session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif

</div>
