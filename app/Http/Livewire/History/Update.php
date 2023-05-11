<?php

namespace App\Http\Livewire\History;

use App\Models\Gravida;
use App\Models\Pregnantmom;
use Livewire\Component;

class Update extends Component
{

    public $record;

    protected $rules = [
        'nama' => 'required',
        'stok' => 'required',
        'harga' => 'required',
        'min_stok' => 'required|lte:stok'
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => 'Data Obat Berhasil Diupdate' ]);

        $this->drug->update([
            'nama' => $this->nama,
            'dosis' => $this->dosis,
            'stok' => $this->stok,
            'min_stok' => $this->min_stok,
            'harga' => $this->harga,
        ]);

        return redirect("/obat");
    }

    public function mount(Gravida $history){
        $this->history = $history;
        // $this->nama = $drug->nama;
        // $this->dosis = $drug->dosis;
        // $this->stok = $drug->stok;
        // $this->harga = $drug->harga;
        // $this->min_stok = $drug->min_stok;

    }
    public function render()
    {
        $data = Pregnantmom::where("gravida_id", $this->history->id)->get();

        return view('livewire.history.detail', compact("data"));
    }
}
