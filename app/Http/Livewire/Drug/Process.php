<?php

namespace App\Http\Livewire\Drug;

use App\Models\Drug;
use App\Models\Queue;
use App\Models\Transaction;
use Livewire\Component;
use Illuminate\Support\Facades\View;

class Process extends Component
{
    public $queue;
    public $payment;
    public $qty1;
    public $harga1;
    public $qty2;
    public $harga2;
    public $qty3;
    public $harga3;
    public $qty4;
    public $harga4;
    public $qty5;
    public $harga5;
    public $qty6;
    public $harga6;
    public $qty7;
    public $harga7;
    public $qty8;
    public $harga8;
    public $qty9;
    public $harga9;
    public $qty10;
    public $harga10;
    public $qty11;
    public $harga11;
    public $qty12;
    public $harga12;

    protected $rules = [
        'payment' => 'required|numeric',
    ];

    public  function mount(Queue $queue){
        $this->queue = $queue;
    }

    public function save()
    {
        // TODO:: Create invoice print function before update!!
        try {
            // dd($this->queue);
            $this->queue->update([
                "has_drug" => true
                ]);
                foreach ($this->queue->medicalrecord->drugs as $drug) {
                    $drug->decrement('stok',1);
                }
                $this->redirectRoute('queue.drug');
            } catch (\Exception $e) {
                dd($e);
            }
        }


        public function submit()
        {
            $this->validate([
                'qty1' => 'required|numeric',
                'harga1' => 'required|numeric',
                'qty2' => 'required|numeric',
                'harga2' => 'required|numeric',
                'qty3' => 'required|numeric',
                'harga3' => 'required|numeric',
                'qty4' => 'required|numeric',
                'harga4' => 'required|numeric',
                'qty5' => 'required|numeric',
                'harga5' => 'required|numeric',
                'qty6' => 'required|numeric',
                'harga6' => 'required|numeric',
                'qty7' => 'required|numeric',
                'harga7' => 'required|numeric',
                'qty8' => 'required|numeric',
                'harga8' => 'required|numeric',
                'qty9' => 'required|numeric',
                'harga9' => 'required|numeric',
                'qty10' => 'required|numeric',
                'harga10' => 'required|numeric',
                'qty11' => 'required|numeric',
                'harga11' => 'required|numeric',
                'qty12' => 'required|numeric',
                'harga12' => 'required|numeric',
                ]);

                $qty1 = $this->qty1;
                $harga1 = $this->harga1;
                $total1 = $qty1 * $harga1;

                $qty2 = $this->qty2;
                $harga2 = $this->harga2;
                $total2 = $qty2 * $harga2;

                $qty3 = $this->qty3;
                $harga3 = $this->harga3;
                $total3 = $qty3 * $harga3;

                $qty4 = $this->qty4;
                $harga4 = $this->harga4;
                $total4 = $qty4 * $harga4;

                $qty5 = $this->qty5;
                $harga5 = $this->harga5;
                $total5 = $qty5 * $harga5;

                $qty6 = $this->qty6;
                $harga6 = $this->harga6;
                $total6 = $qty6 * $harga6;

                $qty7 = $this->qty7;
                $harga7 = $this->harga7;
                $total7 = $qty7 * $harga7;

                $qty8 = $this->qty8;
                $harga8 = $this->harga8;
                $total8 = $qty8 * $harga8;

                $qty9 = $this->qty9;
                $harga9 = $this->harga9;
                $total9 = $qty9 * $harga9;

                $qty10 = $this->qty10;
                $harga10 = $this->harga10;
                $total10 = $qty10 * $harga10;

                $qty11 = $this->qty11;
                $harga11 = $this->harga11;
                $total11 = $qty11 * $harga11;

                $qty12 = $this->qty12;
                $harga12 = $this->harga12;
                $total12 = $qty12 * $harga12;

                $subtotal = 0;

                // Calculate subtotal
                $subtotal += floatval($this->qty1) * floatval($this->harga1);
                $subtotal += floatval($this->qty2) * floatval($this->harga2);
                $subtotal += floatval($this->qty3) * floatval($this->harga3);
                $subtotal += floatval($this->qty4) * floatval($this->harga4);
                $subtotal += floatval($this->qty5) * floatval($this->harga5);
                $subtotal += floatval($this->qty6) * floatval($this->harga6);
                $subtotal += floatval($this->qty7) * floatval($this->harga7);
                $subtotal += floatval($this->qty8) * floatval($this->harga8);
                $subtotal += floatval($this->qty9) * floatval($this->harga9);
                $subtotal += floatval($this->qty10) * floatval($this->harga10);
                $subtotal += floatval($this->qty11) * floatval($this->harga11);
                $subtotal += floatval($this->qty12) * floatval($this->harga12);
                // Add other subtotal calculations here

                $jumlah = $subtotal;

                Transaction::create([
                    'queue_id' => $this->queue->id,
                    'payment' => $this->payment
                    ]);

                    $this->redirectRoute('queue.drug');

                    return view('livewire.drug.process', [
                        'queue' => $this->queue,
                        'qty' => $qty,
                        'harga' => $harga,
                        'total' => $total

                        ]);
                    }
                    public function render()
                    {
                        $subtotal = 0;

                        // Calculate subtotal
                        $subtotal += floatval($this->qty1) * floatval($this->harga1);
                        $subtotal += floatval($this->qty2) * floatval($this->harga2);
                        $subtotal += floatval($this->qty3) * floatval($this->harga3);
                        $subtotal += floatval($this->qty4) * floatval($this->harga4);
                        $subtotal += floatval($this->qty5) * floatval($this->harga5);
                        $subtotal += floatval($this->qty6) * floatval($this->harga6);
                        $subtotal += floatval($this->qty7) * floatval($this->harga7);
                        $subtotal += floatval($this->qty8) * floatval($this->harga8);
                        $subtotal += floatval($this->qty9) * floatval($this->harga9);
                        $subtotal += floatval($this->qty10) * floatval($this->harga10);
                        $subtotal += floatval($this->qty11) * floatval($this->harga11);
                        $subtotal += floatval($this->qty12) * floatval($this->harga12);
                        // Add other subtotal calculations here

                        $jumlah = $subtotal;

                        return view('livewire.drug.process', [
                            'queue' => $this->queue,
                            'subtotal' => $subtotal,
                            'jumlah' => $jumlah
                            ]);
                        }
                    }
