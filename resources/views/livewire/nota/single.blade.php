@php
    use Carbon\Carbon;
    use Illuminate\Support\Facades\DB;
@endphp

@php
    $cek = DB::table("medical_record_drugs")
        ->rightJoin("drugs", "medical_record_drugs.drug_id", "=", "drugs.id")
        ->where("medical_record_id", $transaksi->queue->medicalrecord->id)
        ->select("drugs.nama")
        ->get();
@endphp
<tr>
    <td>{{ $transaksi->id }}</td>
    <td>{{ $transaksi->queue->patient->name }}</td>
    <td>
        {!! Carbon::createFromFormat('Y-m-d H:i:s', $transaksi->queue->medicalrecord->created_at)->isoFormat('D MMMM Y') !!}
    </td>
    <td>{{$transaksi->payment}}</td>
    {{-- <td>{{$transaksi->keterangan }}</td> --}}
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
</tr>
