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

        @if ($queue->inap)
        <strong>
            <i>
                Sudah Selesai
            </i>
        </strong>
        @else
        <button class="btn btn-sm btn-danger" wire:click="selesai">Selesai</button>
        <button class="btn btn-sm btn-primary" wire:click="processCheckup">Proses</button>
        @endif

        @elserole("bidan")
        <button class="btn btn-sm btn-primary" wire:click="processCheckup">Proses</button>
        @elserole('staff')
        <button class="btn btn-sm btn-primary" wire:click="processCheckup">Proses</button>
        @endrole
    </td>
</tr>
