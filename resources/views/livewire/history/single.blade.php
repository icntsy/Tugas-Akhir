<tr>
    <td>{{$record->id}}</td>
    <td>{{$record->patient->name}}</td>
    <td>{{$record->patient->name}}</td>
    <td>{{$record->patient->gender}}</td>
    <td>{{$record->patient->phone_number}}</td>
    <td>
        {{-- <a class="btn btn-sm btn-primary" href="{{ url('/history/'.$record->id.'/detail') }}" >Detail</a> --}}

        <a href="{{ route('history.update', ['history' => $record->id]) }}" class="btn text-warning">
            <i class="fa fa-info-circle" aria-hidden="true"></i>
            {{-- <i class="fa fa-edit fa-1x"></i> --}}
        </a>
    </td>
    </td>
</tr>
