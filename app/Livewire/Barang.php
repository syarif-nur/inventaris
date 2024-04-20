<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Barang as BarangModel;

class Barang extends Component
{

    public $barangs, $nama_barang, $jumlah, $id_barang;
    public $isOpen = 0;
    public $isOpenEdit = 0;
    public $counter = 1;

    public function render()
    {
        $this->barangs = BarangModel::where('active', 1)->get();
        return view('livewire.barang')->with('title','Data Barang');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function store()
    {
        $this->validate([
            'nama_barang' => 'required',
            'jumlah' => 'required|numeric',
        ]);

        BarangModel::create([
            'nama_barang' => $this->nama_barang,
            'jumlah' => $this->jumlah,
        ]);

        session()->flash('message', 'Barang Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $barang = BarangModel::findOrFail($id);
        $this->id_barang = $id;
        $this->nama_barang = $barang->nama_barang;
        $this->jumlah = $barang->jumlah;

        $this->openEditModal();
    }

    public function update()
    {
        $this->validate([
            'nama_barang' => 'required',
            'jumlah' => 'required|numeric',
        ]);

        $barang = BarangModel::find($this->id_barang);
        $barang->update([
            'nama_barang' => $this->nama_barang,
            'jumlah' => $this->jumlah,
        ]);

        session()->flash('message', 'Barang Updated Successfully.');

        $this->closeEditModal();
        $this->resetInputFields();
    }

    public function delete($id)
    {
        BarangModel::find($id)->update(['active' => 2]);
        session()->flash('message', 'Barang Deleted Successfully.');
    }

    public function resetInputFields()
    {
        $this->nama_barang = '';
        $this->jumlah = '';
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function openEditModal()
    {
        $this->isOpenEdit = true;
    }

    public function closeEditModal()
    {
        $this->isOpenEdit = false;
    }

}
