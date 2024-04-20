<?php

namespace App\Livewire;

use App\Models\Barang as BarangModel;
use App\Models\MutasiMasuk;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class MutasiMasukCrud extends Component
{

    public $mutasiMasuk, $id_barang, $tanggal_masuk, $jumlah_masuk;
    public $isOpen = 0;
    public $isOpenEdit = 0;
    public $counter = 1;

    public function render()
    {
        $this->mutasiMasuk = MutasiMasuk::where('active', 1)->with('barang')->get();
        $barang = BarangModel::where('active', 1)->pluck('nama_barang', 'id');
        return view('livewire.mutasi-masuk-crud', compact('barang'));
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function store()
    {
        DB::beginTransaction();

        try {
            $this->validate([
                'id_barang' => 'required',
                'jumlah_masuk' => 'required|numeric',
            ]);

            MutasiMasuk::create([
                'id_barang' => $this->id_barang,
                'jumlah_masuk' => $this->jumlah_masuk,
                'tanggal_masuk' => now()->toDateString()
            ]);

            $addBarang = $this->addBarang($this->id_barang, $this->jumlah_masuk);
            if (!$addBarang) {
                DB::rollBack();
                session()->flash('error', 'Failed to create Mutasi Barang.');
            }

            DB::commit();

            session()->flash('message', 'Mutasi Barang Created Successfully.');

            $this->closeModal();
            $this->resetInputFields();
        } catch (\Exception $e) {
            DB::rollback();

            session()->flash('error', 'Failed to create Mutasi Barang.');
            \Log::error('Failed to create Mutasi Barang: ' . $e->getMessage());
        }
    }
    public function addBarang($id_barang, $jumlah_masuk)
    {
        try {
            $findBarang = BarangModel::find($id_barang);
            $findBarang->update(['jumlah' => $findBarang->jumlah + $jumlah_masuk]);
            return true;
        } catch (\Exception $e) {
            return false;
        }

    }

    public function deleteBarang($id_barang, $jumlah_masuk)
    {
        try {
            $findBarang = BarangModel::find($id_barang);
            $findBarang->update(['jumlah' => $findBarang->jumlah - $jumlah_masuk]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }


    public function delete($id)
    {
        DB::beginTransaction();

        try {
            $findData = MutasiMasuk::find($id);
            $deleteBarang = $this->deleteBarang($findData->id_barang, $findData->jumlah_masuk);
            if (!$deleteBarang) {
                DB::rollBack();
                session()->flash('error', 'Failed to delete Mutasi Barang.');
            }
            $findData->update(['active' => 2]);

            DB::commit();
            session()->flash('message', 'Barang Deleted Successfully.');

        } catch (\Exception $e) {
            DB::rollback();

            session()->flash('error', 'Failed to delete Mutasi Barang.');
            \Log::error('Failed to delete Mutasi Barang: ' . $e->getMessage());
        }

    }

    public function resetInputFields()
    {
        $this->id_barang = '';
        $this->jumlah_masuk = '';
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
