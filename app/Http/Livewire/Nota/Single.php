<?php

namespace App\Http\Livewire\Nota;

use Dompdf\Dompdf;
use App\Models\Queue;
use App\Models\Transaction;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class Single extends Component
{
    public $transaksi;
    public $available;
    public $transaksiIndex;
    public $role;
    public $queue;

    public function mount(Transaction $transaksi, $transaksiIndex){

        $this->transaksi = $transaksi;
        $this->transaksiIndex = $transaksiIndex;
        $this->role = Auth::user()->role; // Inisialisasi $role
        // Mendapatkan $queue dari $transaksi
        $this->queue = $transaksi->queue;
    }

    public function render()
    {

        // Tambahan

        $transaksi = Transaction::find($this->transaksi->id);


        return view('livewire.nota.single', [
            'role' => $this->role // Mengirimkan $role ke tampilan
            ]);
        }

        public function print()
        {
            // Mendapatkan data transaksi untuk dicetak
            $dataTransaksi = $this->transaksi;

            // Membuat objek Dompdf
            $dompdf = new Dompdf();

            // Render tampilan view 'livewire.nota.print' dengan data transaksi
            $pdfContent = view('livewire.nota.print', ['transaksi' => $dataTransaksi])->render();

           

            // Memasukkan konten PDF ke Dompdf
            $dompdf->loadHtml($pdfContent);

            // Mengatur ukuran dan orientasi halaman
            $dompdf->setPaper('A4', 'portrait');

            // Render PDF
            $dompdf->render();

            // Generate nama file PDF yang unik
            $fileName = 'nota_' . time() . '.pdf';

            // Simpan file PDF di direktori penyimpanan yang diinginkan
            $dompdf->stream($fileName, ['Attachment' => false]);
        }

        public function delete(){
            $this->drug->delete();
            $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => __('Obat Terhapus', ['name' => __('Article') ]) ]);
            $this->emit('articleDeleted');
        }
    }
