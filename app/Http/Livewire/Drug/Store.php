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
        Transaction::create([
            'queue_id' => $queue,
            'payment' => $req->payment
        ]);

        return redirect("/antri/obat");
    }
}
