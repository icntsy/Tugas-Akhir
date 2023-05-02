@php
use App\Models\MedicalRecordDrugs;
$stok = MedicalRecordDrugs::where("drug_id", $drug["id"])->sum("quantity");
    $kurang = $drug["stok"] - $stok;
@endphp

<tr>
    <td>{{$drug->nama}}</td>
    {{-- <td>{{$drug->keterangan }}</td> --}}
    <td>@rupiah($drug->harga)</td>
    <td>
        <span class="badge @if($available) badge-primary @else badge-danger @endif">
            {{{$kurang}}} {{$available ? "Tersedia" : "Hampir Habis"}}
        </span>
    </td>
    <td>
        <a wire:click="delete" class="btn text-danger">
            <i class="fa fa-trash fa-1x"></i>
        </a>
        <a href="{{route('drug.update', ['drug' => $drug->id])}}" class="btn text-warning">
            <i class="fa fa-edit fa-1x"></i>
        </a>
    </td>
</tr>
