<?php

namespace App\Livewire;

use App\Models\MutasiKeluar;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Barang as BarangModel;


class MutasiKeluarCrud extends Component
{

    public $mutasiKeluar, $id_barang, $tanggal_keluar, $jumlah_keluar;
    public $isOpen = 0;
    public $counter = 1;

    public function render()
    {
        $this->mutasiKeluar = MutasiKeluar::where('active', 1)->with('barang')->get();
        $barang = BarangModel::where('active', 1)->pluck('nama_barang', 'id');
        return view('livewire.mutasi-keluar-crud', compact('barang'));
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
                'jumlah_keluar' => 'required|numeric',
            ]);

            MutasiKeluar::create([
                'id_barang' => $this->id_barang,
                'jumlah_keluar' => $this->jumlah_keluar,
                'tanggal_keluar' => now()->toDateString()
            ]);

            $addBarang = $this->deleteBarang($this->id_barang, $this->jumlah_keluar);
            if (!$addBarang) {
                throw new \Exception('Failed to add barang during MutasiKeluar creation.');
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
    public function addBarang($id_barang, $jumlah_keluar)
    {
        try {
            $findBarang = BarangModel::find($id_barang);
            $findBarang->update(['jumlah' => $findBarang->jumlah + $jumlah_keluar]);
            return true;
        } catch (\Exception $e) {
            return false;
        }

    }

    public function deleteBarang($id_barang, $jumlah_keluar)
    {
        try {
            $findBarang = BarangModel::find($id_barang);
            if ($findBarang->jumlah < $jumlah_keluar) {
                return false;
            }
            $findBarang->update(['jumlah' => $findBarang->jumlah - $jumlah_keluar]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }


    public function resetInputFields()
    {
        $this->id_barang = '';
        $this->jumlah_keluar = '';
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }
}
