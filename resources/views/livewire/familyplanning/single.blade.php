<tr>

    <td>{{$familyplanningIndex}}.</td>
    <td>{{$familyplanning->name ?? "-"}}</td>
    <td>{{$this->getAge()}}</td>
    {{-- <td>{{$familyplanning->age}}</td> --}}
    <td>{{$familyplanning->husbands_name}}</td>
    <td>{{$familyplanning->address}}</td>
    <td>{{$familyplanning->entry_date}}</td>
    <td>
        <a wire:click="delete" class="btn text-danger">
            <i class="fa fa-trash fa-1x"></i>
        </a>
        <a href="{{route('familyplanning.update', ['familyplanning' => $familyplanning->id])}}" class="btn text-warning">
            <i class="fa fa-edit fa-1x"></i>
        </a>
    </td>
</tr>

@push("js")
<script>
    var years = moment().diff('{{ $familyplanning->age }}', 'years');
    console.log(years);
</script>
@endpush


