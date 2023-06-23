@php
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\MedicalRecordDrugs;
@endphp

@php
$cek = DB::table("medical_record_drugs")
->rightJoin("drugs", "medical_record_drugs.drug_id", "=", "drugs.id")
->where("medical_record_id", $transaksi->queue?->medicalrecord?->id)
->select("drugs.nama")
->get();
@endphp
<tr>
    <td>{{$transaksiIndex}}.</td>
    <td>{{ $transaksi->queue->patient->name }}</td>
    <td>
        {!! Carbon::createFromFormat('Y-m-d H:i:s', $transaksi->created_at)->isoFormat('D MMMM Y') !!}
    </td>
    <td>Rp. {{ number_format(floatval($transaksi->payment)) }}</td>
    <td>
        @foreach (json_decode($cek) as $item)
        <ul>
            @foreach ($item as $i => $key)
            <li>
                {{ $key }}
            </li>
            @endforeach
        </ul>
        @endforeach
    </td>
    <td>
        {{ $transaksi->queue->doctor->name }}
    </td>
    <td>{{ $transaksi->queue->service->name }}</td>
    <td>
        @if ($queue->jenis_rawat == NULL)
        -
        @else
        {{$queue->jenis_rawat}}
        @endif
    </td>
    @if($transaksi->queue->doctor->role == 'dokter')
    <td>
        <button class="btn btn-sm btn-primary" onclick="location.href='{{ route('nota.print', ['transaksi' => $transaksi, 'transaksiIndex' => $transaksiIndex]) }}'">
            Print
        </button>
        {{-- <button class="btn btn-sm btn-primary" wire:click="nota_inap">
            Print
        </button> --}}
    </td>
@endif
    {{-- <td>
        <button class="btn btn-sm btn-primary" onclick="location.href='{{ route('nota.print', ['transaksi' => $transaksi, 'transaksiIndex' => $transaksiIndex]) }}'">
            Print
        </button>
    </td> --}}

</tr>
