<?php

namespace App\Http\Livewire\Drug;

use App\Models\Drug;
use App\Models\Queue;
use App\Models\Transaction;
use Livewire\Component;
use Illuminate\Http\Request;

class Store extends Component
{

    public function store(Request $req, $queue)
    {
        // Untuk mengurangi obat
        $queue = Queue::findOrFail($queue);
        $drug = Drug::findOrFail($queue->medicalrecord->medicalRecordDrugs->drug_id);
        $drug->update([
            'stok' => $drug->stok - $queue->medicalrecord->medicalRecordDrugs->quantity
        ]);

        Transaction::create([
            'queue_id' => $queue->id,
            'payment' => $req->payment
        ]);

        return redirect("/antri/obat");
    }
}
