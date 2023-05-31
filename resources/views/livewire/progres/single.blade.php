<tr>
    <td>{{$queue->patient->name}}</td>
    <td>{{$queue->service->name}}</td>
    <td>{{$queue->jenis_rawat}}</td>
    <td>
        @role('admin')
        <a wire:click="delete" class="btn text-danger">
            <i class="fa fa-trash fa-1x"></i>
        </a>
        @elserole('dokter')
        <button class="btn btn-sm btn-primary" wire:click="processCheckup">Proses</button>
        @if ($queue->jenis_rawat === 'Inap')
        <button class="btn btn-sm btn-danger" wire:click="">Selesai</button>
        @endif
        @elserole("bidan")
        <button class="btn btn-sm btn-primary" wire:click="processCheckup">Proses</button>
        @elserole('staff')
        <button class="btn btn-sm btn-primary" wire:click="processCheckup">Proses</button>
        @endrole
    </td>
</tr>
