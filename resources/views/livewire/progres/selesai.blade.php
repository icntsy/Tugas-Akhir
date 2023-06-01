@section('meta_title', 'MEDICAL RECORD')
@section('page_title', 'PROCESS CHECKUP MEDICAL RECORD SELESAI')
@section('page_title_icon')
<i class="metismenu-icon fa fa-list"></i>
@endsection


<div class="row">
    <div class="card col-md-12">
        @role("dokter")
        <div class="card-header">
            <div class="btn-actions-pane-right text-capitalize">
                {{-- <button  wire:click="update" class="btn-wide btn-outline-2x mr-md-2 btn btn-secondary"><i class="fa
                    fa-edit"></i> Simpan
                </button> --}}
                <button  wire:click="save" class="btn-wide btn-outline-2x mr-md-2 btn btn-primary"><i class="fa
                    fa-check"></i> Selesai
                </button>
            </div>
        </div>
        @endrole

        <div class="card-body row">
            <div class="col-md-12">
                <div class="main-card">
                    <div class="card-header">
                        Data Pasien
                    </div>
                    <div class="card-body row">
                        <div class="col-md-6">
                            <table width="100%">
                                <tbody><tr>
                                    <td style="font-weight: bold;" width="35%">NIK</td>
                                    <td width="1%">:</td>
                                    <td>

                                        {{$queue->patient->nik}}
                                    </td>
                                </tr>

                                {{-- <tr>
                                    <td style="font-weight: bold;" width="35%">No Antrian</td>
                                    <td>:</td>
                                    <td>{{$queue->queue_number}}</td>
                                </tr> --}}
                                <tr>
                                    <td style="font-weight: bold;" width="35%">Nama Lengkap</td>
                                    <td width="1%">:</td>
                                    <td>
                                        {{$queue->patient->name}}
                                    </td>
                                </tr>
                                {{-- <tr>
                                    <td style="font-weight: bold;" width="35%">Tanggal Lahir</td>
                                    <td>:</td>
                                    <td>{{\Carbon\Carbon::parse($queue->patient->birth_date)->isoFormat('D MMMM Y')}}</td>
                                </tr> --}}

                                <tr>
                                    <td style="font-weight: bold;" width="35%">Sex / Umur</td>
                                    <td>:</td>
                                    <td>{{$queue->patient->gender}} / {{\Carbon\Carbon::parse($queue->patient->birth_date)
                                        ->diffInYears
                                        ()}}
                                        Thn</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;" width="35%">Alamat</td>
                                        <td width="1%">:</td>
                                        <td>
                                            {{$queue->patient->address}}
                                        </td>
                                    </tr>
                                </tbody></table>
                            </div>
                            <div class="col-md-6">
                                <table width="100%">
                                    <tbody>
                                    <tr>
                                        <td style="font-weight: bold;" width="35%">Tanggal Masuk / Jam</td>
                                        <td width="1%">:</td>
                                        <td>{{\Carbon\Carbon::parse($queue->created_at)->format('d F Y / H:i')}}</td>
                                    </tr>
                                        {{-- <td>{{\Carbon\Carbon::parse($queue->created_at)->isoFormat('hh:mm, D MMMM Y')}}</td>
                                    </tr>

                                    <tr>
                                        <td style="font-weight: bold;" width="35%">No. Rekam Medis</td>
                                        <td width="1%">:</td>
                                        <td>
                                            001
                                        </td>
                                    </tr>
                                     <tr>
                                        <td style="font-weight: bold;" width="35%">Jenis Pasien</td>
                                        <td>:</td>
                                        <td>Umum </td>
                                    </tr> --}}
                                    <tr>
                                        <td style="font-weight: bold;" width="35%">No. Rekam Medis</td>
                                        <td width="1%">:</td>
                                        <td>
                                            001
                                        </td>
                                    </tr>
                                     {{-- <tr>
                                        <td style="font-weight: bold;" width="35%">
                                           @if ($role === 'dokter')
                                            Dokter Pemeriksa
                                            @elseif ($role === 'bidan')
                                            Bidan Pemeriksa
                                            @endif
                                        </td>
                                        <td>:</td>
                                        <td>
                                            @if ($role === 'dokter')
                                            {{$queue->doctor->name}}
                                            @elseif ($role === 'bidan')
                                            {{$queue->doctor->name}}
                                            @endif
                                        </td>
                                    </tr> --}}

                                     <tr>
                                        <td style="font-weight: bold;" width="35%">Dokter Pemeriksa</td>
                                        <td>:</td>
                                        <td>{{$queue->doctor->name}}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;" width="35%">Layanan </td>
                                        <td>:</td>
                                        <td>{{$queue->service->name}}</td>
                                    </tr>
                                    {{-- <tr>
                                        <td style="font-weight: bold;" width="35%">Jenis Rawat </td>
                                        <td>:</td>
                                        <td>{{$queue->jenis_rawat}}</td>
                                    </tr> --}}


                                    <tr>
                                        <td style="font-weight: bold;" width="35%">Jenis Rawat</td>
                                        <td>:</td>
                                        <td>{{ $queue->jenis_rawat }}</td>
                                    </tr>

                                </tbody></table>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
                @role("dokter")
                <div class="col-md-12">
                    <div class="main-card">
                        <div class="card-header">
                            Data Pulang
                        </div>

                        <div class="card-body row">
                            <div class=" form-group col-md-6">
                                <label for='pemeriksaan_penunjang' class='control-label'> {{ __('Pemeriksaaan Penunjang') }}</label>
                                <textarea  wire:model.lazy='pemeriksaan_penunjang' placeholder="Pemeriksaan Penunjang"
                                class="form-control @error('pemeriksaan_penunjang') is-invalid @enderror"
                                id='pemeriksaan_penunjang'> </textarea>
                                @error('pemeriksaan_penunjang')
                                <div class='invalid-feedback'>{{ $message }}</div> @enderror
                            </div>
                            <div class=" form-group col-md-6">
                                <label for='terapi_pulang' class='control-label'> {{ __('Terapi Pulang') }}</label>
                                <textarea  wire:model.lazy='terapi_pulang' placeholder="Terapi Pulang"
                                class="form-control @error('terapi_pulang') is-invalid @enderror"
                                id='terapi_pulang'> </textarea>
                                @error('terapi_pulang')
                                <div class='invalid-feedback'>{{ $message }}</div> @enderror
                            </div>
                            <div class=" form-group col-md-12">
                                <label for='terapi_tindakan' class='control-label'> {{ __('Terapi dan Tindakan') }}</label>
                                <textarea  wire:model.lazy='terapi_tindakan' placeholder="Terapi dan Tindakan"
                                class="form-control @error('terapi_tindakan') is-invalid @enderror"
                                id='terapi_tindakan'> </textarea>
                                @error('terapi_tindakan')
                                <div class='invalid-feedback'>{{ $message }}</div> @enderror
                            </div>
                            <div class='form-group col-md-6'>
                                <label for='keadaan' class='control-label'> {{ __('Keadaan Pasien Waktu Pulang') }}</label>
                                <select  wire:model.lazy='keadaan' class="form-control @error('keadaan') is-invalid @enderror" id='keadaan'>
                                    <option value="" >--- Silahkan Pilih --</option>
                                    <option value="1">Sembuh</option>
                                    <option value="2">Perbaikan</option>
                                    <option value="3">Tidak Ada Perbaikan</option>
                                </select>
                                @error('keadaan')
                                <div class='invalid-feedback'>{{ $message }}</div>
                                @enderror
                            </div>
                            <div class='form-group col-md-6'>
                                <label for='cara_keluar' class='control-label'> {{ __('Cara Keluar') }}</label>
                                <select  wire:model.lazy='cara_keluar' class="form-control @error('cara_keluar') is-invalid @enderror" id='cara_keluar'>
                                    <option value="" >--- Silahkan Pilih --</option>
                                    <option value="1">Atas Persetujuan</option>
                                    <option value="2">Pulang Paksa</option>
                                    <option value="3">Dirujuk</option>
                                </select>
                                @error('cara_keluar')
                                <div class='invalid-feedback'>{{ $message }}</div>
                                @enderror
                            </div>
                            @endrole

                        </div>
                    </div>
                </div>
                @role("dokter")







</div>



</div>
</div>
@endrole
</div>
</div>
</div>
</div>
</div>
</div>
