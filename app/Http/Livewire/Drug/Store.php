<?php

namespace App\Http\Livewire\Drug;

use App\Models\Drug;
use App\Models\Queue;
use App\Models\Transaction;
use App\Models\DrugBidan;
use Livewire\Component;
use Illuminate\Http\Request;

class Store extends Component
{

    public function store(Request $req, $queue)
    {
        // Untuk mengurangi obat
        $queue = Queue::findOrFail($queue);

        if ($queue->jenis_rawat == NULL) {
            $antrian = $queue->pregnantmom;

            $drug_bidan = DrugBidan::where("pregnantmom_id", $antrian->id)->get();

            foreach ($drug_bidan as $item) {
                Drug::where("id", $item["drug_id"])->update([
                    "stok" => $item["drug"]["stok"] - $item["quantity"]
                ]);
            }

        } else {
            foreach ($queue->medicalrecord->drugs as $drug) {
                Drug::where('id', $drug->pivot->drug_id)->update([
                    'stok' => $drug->stok - $drug->pivot->quantity
                ]);
            }
        }

        Transaction::create([
            'queue_id' => $queue->id,
            'payment' => $req->payment
        ]);

        return redirect("/antri/obat");
    }
}
