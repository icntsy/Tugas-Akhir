<tr>

    <td>{{$familyplanningIndex}}.</td>
    <td>{{$familyplanning->name ?? "-"}}</td>
    <td>{{$this->getAge()}} Thn</td>
    <td>{{$familyplanning->husbands_name}}</td>
    <td>{{$familyplanning->address}}</td>
    <td>{{$familyplanning->entry_date}}</td>
    <td>
        <button class="btn btn-sm btn-warning"  onclick="location.href='{{ route('familyplanning.update', ['familyplanning' => $familyplanning->id]) }}'">
            Edit Data KB
        </button>
        <button class="btn btn-sm btn-primary"  onclick="location.href='{{ route('familyplanning.buat', ['familyPlanning' => $familyplanning->id]) }}'">
            Tambah Pemeriksaan
        </button>
    </td>
</tr>

@push("js")
<script>
    var years = moment().diff('{{ $familyplanning->age }}', 'years');
    console.log(years);
</script>
@endpush


