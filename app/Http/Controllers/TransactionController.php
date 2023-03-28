<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function create(Request $request, $id) {
        $this->validate($request, [
            'payment' => 'required'
        ]);
        $transaction= Transaction::create($request->all());
        return response()->json($transaction);
    }
}