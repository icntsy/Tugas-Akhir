@section('meta_title', 'MEDICAL RECORD')
@section('page_title', 'PEMERIKSAAN ACN')
@section('page_title_icon')
<i class="metismenu-icon fa fa-list"></i>
@endsection

<div class="row">
    <div class="card col-md-12">

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
                                    <td style="font-weight: bold;" width="35%">Nama Lengkap</td>
                                    <td width="1%">:</td>
                                    <td>
                                        {{$history->patient->name}}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="font-weight: bold;" width="35%">NIK</td>
                                    <td>:</td>
                                    <td>{{$history->patient->nik}}</td>
                                </tr>

                                <tr>
                                    <td style="font-weight: bold;" width="35%">Jenis Kelamin</td>
                                    <td>:</td>
                                    <td>{{$history->patient->gender}}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;" width="35%">Gol. Darah</td>
                                    <td>:</td>
                                    <td>{{$history->patient->blood_type}}</td>
                                </tr>


                                </tbody></table>
                            </div>
                            <div class="col-md-6">
                                <table width="100%">
                                    <tbody><tr>
                                        <td style="font-weight: bold;" width="35%">Alamat</td>
                                        <td width="1%">:</td>
                                        <td>
                                            {{$history->patient->address}}
                                        </td>
                                        {{-- <td>{{\Carbon\Carbon::parse($queue->created_at)->isoFormat('hh:mm, D MMMM Y')}}</td> --}}
                                    </tr>


                                    <tr>
                                        <td style="font-weight: bold;" width="35%">No. Telepon</td>
                                        <td>:</td>
                                        <td>{{$history->patient->phone_number}} </td>
                                    </tr>

                                    <tr>
                                        <td style="font-weight: bold;" width="35%">Umur</td>
                                        <td>:</td>
                                        <td> {{\Carbon\Carbon::parse($history->patient->birth_date)
                                            ->diffInYears
                                            ()}}
                                            Thn</td>
                                    </tr>

                                </tbody></table>

                            </div>

                            <hr>

                        </div>


                    </div>
                    <div class="card-body row">
                        <div class="card-header">
                            Data Pemeriksaan
                        </div>
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>Tgl. Pemeriksaan</th>
                                    <th>Hamil Anak Ke</th>
                                    <th>HPHT</th>
                                    <th>Usia Kehamilan</th>
                                    <th>Lingkar Lengan Atas</th>
                                    <th>Berat Badan</th>
                                    <th>Tekanan Darah</th>
                                    <th>Tinggi Fudus Uteri</th>
                                    <th>Denyut Jantung Janin</th>
                                    <th>Imunisasi TT</th>
                                    <th>Keterangan Obat</th>
                                    <th>Keluhan</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $history)
                                    <tr>
                                        <td>{{\Carbon\Carbon::parse($history->created_at)->format('H:i, d F Y')}}</td>
                                        <td>{{ $history->anak_ke }}</td>
                                        <td>{{ $history->hpht }}</td>
                                        <td>{{ $history->pregnant_age }}</td>
                                        <td>{{ $history->lila }}</td>
                                        <td>{{ $history->weight }}</td>
                                        <td>{{ $history->blood_pressure }}</td>
                                        <td>{{ $history->tfu }}</td>
                                        <td>{{ $history->djj }}</td>
                                        <td>{{ $history->immunization_tt }}</td>
                                        <td>{{ $history->description }}</td>
                                        <td>{{ $history->complaint }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- <form class="form-horizontal" method="POST" action="{{ url('/antrian/process/'.$queue->id) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="patient_id" value="{{ $queue->patient->id }}">
                    <input type="hidden" name="doctor_id" value="{{ $queue->doctor->id }}">
                    <div class="card-header">
                        Data Pemeriksaaan
                    </div>
                    <div class="card-body row">
                        <div class='form-group col-md-6'>
                            <label for='anak_ke' class='control-label'> {{ __('Hamil Anak ke') }}</label>
                            <input type='text' name='anak_ke'
                                   class="form-control @error('anak_ke') is-invalid @enderror" id='anak_ke' autofocus placeholder="Hamil Anak ke">
                            @error('anak_ke')
                            <div class='invalid-feedback'>{{ $message }}</div> @enderror
                        </div>

                        <div class='form-group col-md-6'>
                            <label for='hpht' class='control-label'> {{ __('HPHT') }}</label>
                            <input type='text' name='hpht'
                                   class="form-control @error('hpht') is-invalid @enderror" id='hpht' autofocus placeholder="HPHT">
                            @error('hpht')
                            <div class='invalid-feedback'>{{ $message }}</div> @enderror
                        </div>


                        <div class='form-group col-md-6'>
                            <label for='pregnant_age' class='control-label'> {{ __('Usia Kehamilan') }}</label>
                            <input type='text' name='pregnant_age'
                                   class="form-control @error('pregnant_age') is-invalid @enderror" id='pregnant_age' autofocus placeholder="Usia Kehamilan">
                            @error('pregnant_age')
                            <div class='invalid-feedback'>{{ $message }}</div> @enderror
                        </div>

                        <div class='form-group col-md-6'>
                            <label for='lila' class='control-label'> {{ __('Lingkar Lengan Atas') }}</label>
                            <input type='text' name='lila'
                                   class="form-control @error('lila') is-invalid @enderror" id='lila' autofocus placeholder="LILA">
                            @error('lila')
                            <div class='invalid-feedback'>{{ $message }}</div> @enderror
                        </div>

                        <div class='form-group col-md-6'>
                            <label for='weight' class='control-label'> {{ __('Berat Badan') }}</label>
                            <input type='text' name='weight'
                                   class="form-control @error('weight') is-invalid @enderror" id='weight' autofocus placeholder="Berat Badan">
                            @error('weight')
                            <div class='invalid-feedback'>{{ $message }}</div> @enderror
                        </div>

                        <div class='form-group col-md-6'>
                            <label for='blood_pressure' class='control-label'> {{ __('Tekanan Darah') }}</label>
                            <input type='text' name='blood_pressure'
                                   class="form-control @error('blood_pressure') is-invalid @enderror" id='blood_pressure' autofocus placeholder="Tekanan Darah">
                            @error('blood_pressure')
                            <div class='invalid-feedback'>{{ $message }}</div> @enderror
                        </div>

                        <div class='form-group col-md-6'>
                            <label for='tfu' class='control-label'> {{ __('Tinggi Fudus Uteri') }}</label>
                            <input type='text' name='tfu'
                                   class="form-control @error('tfu') is-invalid @enderror" id='tfu' autofocus placeholder="TFU">
                            @error('tfu')
                            <div class='invalid-feedback'>{{ $message }}</div> @enderror
                        </div>

                        <div class='form-group col-md-6'>
                            <label for='djj' class='control-label'> {{ __('Denyut Jantung Janin') }}</label>
                            <input type='text' name='djj'
                                   class="form-control @error('djj') is-invalid @enderror" id='djj' autofocus placeholder="DJJ">
                            @error('djj')
                            <div class='invalid-feedback'>{{ $message }}</div> @enderror
                        </div>

                        <div class='form-group col-md-6'>
                            <label for='immunization_tt' class='control-label'> {{ __('Imunisasi TT') }}</label>
                            <input type='text' name='immunization_tt'
                                   class="form-control @error('immunization_tt') is-invalid @enderror" id='immunization_tt' autofocus placeholder="Imunisasi TT">
                            @error('immunization_tt')
                            <div class='invalid-feedback'>{{ $message }}</div> @enderror
                        </div>

                        <div class='form-group col-md-6'>
                            <label for='description' class='control-label'> {{ __('Keterangan Obat') }}</label>
                            <input type='text' name='description'
                                   class="form-control @error('description') is-invalid @enderror" id='description' autofocus placeholder="Keterangan Obat">
                            @error('description')
                            <div class='invalid-feedback'>{{ $message }}</div> @enderror
                        </div>

                        <div class='form-group col-md-12'>
                            <label for='complaint' class='control-label'> {{ __('Keluhan') }}</label>
                            <input type='text' name='complaint'
                                   class="form-control @error('complaint') is-invalid @enderror" id='complaint' autofocus placeholder="Keluhan">
                            @error('complaint')
                            <div class='invalid-feedback'>{{ $message }}</div> @enderror
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                            Simpan
                        </button>
                    </div>
                </form> --}}

            </div>
        </div>
    </div>


</div>
</div>
</div>
</div>
</div>
</div>
