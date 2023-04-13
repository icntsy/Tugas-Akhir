<?php

namespace App\Http\Livewire\Jasa;

use App\Imports\DrugImport;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;

class Import extends Component
{
    use WithFileUploads;
    public $file;

    public function saveData(){
        $this->validate();

        Excel::import(new DrugImport, $this->file);
        $this->reset();
        $this->emit('drugImported');
    }
    protected $rules = [
        'file' => 'required'
    ];

    public function render()
    {
        $data["users"] = User::where("role", "dokter")->get();

        return view('livewire.jasa.import', $data);
    }

    // public function drugimportexcel(Request $request){
    //     $file = $request->file('file');
    //     $namaFile = $file->getClientOriginalName();
    //     $file->move('DataDrug', $namaFile);

    //     Excel::import(new DrugImport, public_path('/DataDrug/'.$namaFile));
    //     return view('livewire.drug');
    // }
}
