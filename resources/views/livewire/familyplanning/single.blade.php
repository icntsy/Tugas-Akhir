<tr>

    <td>{{$familyplanningIndex}}</td>
    <td>{{$familyplanning->name ?? "-"}}</td>
    <td>{{$familyplanning->age}}</td>
    <td>{{$familyplanning->address}}</td>
    <td>{{$familyplanning->weight}}</td>
    <td>{{$familyplanning->blood_pressure}}</td>
    <td>{{$familyplanning->description}}</td>
    <td>
        <a wire:click="delete" class="btn text-danger">
            <i class="fa fa-trash fa-1x"></i>
        </a>
        <a href="{{route('familyplanning.update', ['familyplanning' => $familyplanning->id])}}" class="btn text-warning">
            <i class="fa fa-edit fa-1x"></i>
        </a>
    </td>
</tr>
