<tr>
    <td>{{$recordIndex}}</td>
    <td>{{$record->patient->name}}</td>
    <td>{{$record->patient->nik}}</td>
    <td>{{$record->patient->address}}</td>
    <td>{{$record->patient->gender}}</td>
    <td>{{$record->patient->phone_number}}</td>
    <td>
        <a href="{{ route('history.update', ['history' => $record->id]) }}" class="btn text-warning">
            <i class="fa fa-history" aria-hidden="true"></i>
        </a>
    </td>
</td>
</tr>

