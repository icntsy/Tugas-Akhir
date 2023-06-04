@section('meta_title', 'MEDICAL RECORD')
@section('page_title', 'PROCESS  PENYIAPAN OBAT')
@section('page_title_icon')
<i class="metismenu-icon fa fa-list"></i>
@endsection

<div class="row">
    <form action="{{ url('/antri/obat/process/'.$queue->id) }}" method="POST">
        @csrf
        <div class="card col-md-12">
            <div class="card-header">
                <div class="btn-actions-pane-right text-capitalize">
                    <button  class="btn-wide btn-outline-2x mr-md-2 btn btn-primary"><i class="fa
                        fa-check"></i> Selesai
                    </button>
                </div>
            </div>
            <div class="card-body row">
                <div class="col-md-12">
                    <div class="main-card">
                        <div class="card-header">
                            Data Pasien
                        </div>
                        <div class="card-body row">
                            <div class="col-md-6">
                                <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td style="font-weight: bold;" width="35%">NIK</td>
                                            <td width="1%">:</td>
                                            <td>
                                                {{$queue->patient->nik}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold;" width="35%">Nama Lengkap</td>
                                            <td width="1%">:</td>
                                            <td>
                                                {{$queue->patient->name}}
                                            </td>
                                        </tr>

                                        {{-- <tr>
                                            <td style="font-weight: bold;" width="35%">No Antrian</td>
                                            <td>:</td>
                                            <td>{{$queue->queue_number}}</td>
                                        </tr> --}}

                                        {{-- <tr>
                                            <td style="font-weight: bold;" width="35%">TTL</td>
                                            <td>:</td>
                                            <td>{{$queue->patient->birth_date}}</td>
                                        </tr> --}}

                                        <tr>
                                            <td style="font-weight: bold;" width="35%">Sex / Umur</td>
                                            <td>:</td>
                                            <td>
                                                {{$queue->patient->gender}} / {{\Carbon\Carbon::parse($queue->patient->birth_date)->diffInYears()}} Thn
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold;" width="35%">Alamat</td>
                                            <td width="1%">:</td>
                                            <td>
                                                {{$queue->patient->address}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td style="font-weight: bold;" width="35%">Tanggal Masuk / Jam</td>
                                            <td width="1%">:</td>
                                            <td>{{\Carbon\Carbon::parse($queue->created_at)->format('d F Y / H:i')}}</td>
                                            {{-- <td>{{$queue->created_at}}</td> --}}
                                        </tr>
                                        <tr>
                                            <td style="font-weight: bold;" width="35%">No. Rekam Medis</td>
                                            <td width="1%">:</td>
                                            <td>
                                                001
                                            </td>
                                        </tr>

                                        {{-- <tr>
                                            <td style="font-weight: bold;" width="35%">Jenis Pasien</td>
                                            <td>:</td>
                                            <td>Umum </td>
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
                                        <tr>
                                            <td style="font-weight: bold;" width="35%">Jenis Rawat </td>
                                            <td>:</td>
                                            <td>{{$queue->jenis_rawat}}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            @if ($queue->jenis_rawat !== 'Inap')
                                            <th>No</th>
                                            <th>Nama Obat</th>
                                            <!-- {{-- <th>Harga Satuan</th> --}} -->
                                            <th>Qty</th>
                                            <th>Aturan Pakai</th>
                                            <th>Total</th>
                                            @endif
                                            @if ($queue->jenis_rawat === 'Inap')
                                            <th>No</th>

                                            <th>Description</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Total</th>

                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $subtotal = 0;
                                        @endphp
                                        @foreach($queue->medicalrecord->drugs as $drug)
                                        @php
                                        $subtotal += $drug->harga * $drug->pivot->quantity;
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            @if ($queue->jenis_rawat !== 'Inap')
                                            {{-- <td>{{$drug->id}}</td> --}}
                                            <td>{{$drug->nama}}</td>
                                            <td>{{$drug->pivot->quantity}}</td>
                                            <td>{{$drug->pivot->instruction}}</td>
                                            <td>Rp. {{ number_format($drug->harga * $drug->pivot->quantity) }}</td>
                                            @endif
                                            @if ($queue->jenis_rawat === 'Inap')
                                            <td>Ruangan</td>
                                            <td><input type="text" name="qty" value="" class="form-control" /></td>

                                            <td><input type="text" name="harga" value="" class="form-control" /></td>
                                            <td><input type="text" name="total" value="" class="form-control" /></td>

                                            @endif
                                        </tr>
                                        <tr>
                                            @if ($queue->jenis_rawat === 'Inap')
                                            <td>{{ $loop->index + 2 }}</td>
                                            <td>Assesment Awal</td>
                                            <td><input type="text" name="qty" value="" class="form-control" /></td>

                                            <td><input type="text" name="harga" value="" class="form-control" /></td>
                                            <td><input type="text" name="total" value="" class="form-control" /></td>

                                            @endif
                                        </tr>
                                        <tr>
                                            @if ($queue->jenis_rawat === 'Inap')
                                            <td>{{ $loop->index + 3 }}</td>
                                            <td>Pendaftaran</td>
                                            <td><input type="text" name="qty" value="" class="form-control" /></td>

                                            <td><input type="text" name="harga" value="" class="form-control" /></td>
                                            <td><input type="text" name="total" value="" class="form-control" /></td>

                                            @endif
                                        </tr>
                                        <tr>
                                            @if ($queue->jenis_rawat === 'Inap')
                                            <td>{{ $loop->index + 4 }}</td>
                                            <td>Infus Set DEWASA+ Tindakan</td>
                                            <td><input type="text" name="qty" value="" class="form-control" /></td>

                                            <td><input type="text" name="harga" value="" class="form-control" /></td>
                                            <td><input type="text" name="total" value="" class="form-control" /></td>

                                            @endif
                                        </tr>

                                        <tr>
                                            @if ($queue->jenis_rawat === 'Inap')
                                            <td>{{ $loop->index + 5 }}</td>
                                            <td>Tindakan Perawat</td>
                                            <td><input type="text" name="qty" value="" class="form-control" /></td>

                                            <td><input type="text" name="harga" value="" class="form-control" /></td>
                                            <td><input type="text" name="total" value="" class="form-control" /></td>

                                            @endif
                                        </tr>
                                        <tr>
                                            @if ($queue->jenis_rawat === 'Inap')
                                            <td>{{ $loop->index + 6 }}</td>
                                            <td>Paket Obat DAN INFUS /hari</td>
                                            <td><input type="text" name="qty" value="" class="form-control" /></td>

                                            <td><input type="text" name="harga" value="" class="form-control" /></td>
                                            <td><input type="text" name="total" value="" class="form-control" /></td>

                                            @endif
                                        </tr>
                                        <tr>
                                            @if ($queue->jenis_rawat === 'Inap')
                                            <td>{{ $loop->index + 7 }}</td>
                                            <td>Assesment dan Visite Dokter</td>
                                            <td><input type="text" name="qty" value="" class="form-control" /></td>

                                            <td><input type="text" name="harga" value="" class="form-control" /></td>
                                            <td><input type="text" name="total" value="" class="form-control" /></td>

                                            @endif
                                        </tr>
                                        <tr>
                                            @if ($queue->jenis_rawat === 'Inap')
                                            <td>{{ $loop->index + 8 }}</td>
                                            <td>Obat Pulang</td>
                                            <td><input type="text" name="qty" value="" class="form-control" /></td>

                                            <td><input type="text" name="harga" value="" class="form-control" /></td>
                                            <td><input type="text" name="total" value="" class="form-control" /></td>

                                            @endif
                                        </tr>
                                        <tr>
                                            @if ($queue->jenis_rawat === 'Inap')
                                            <td>{{ $loop->index + 9 }}</td>
                                            <td>EKG</td>
                                            <td><input type="text" name="qty" value="" class="form-control" /></td>

                                            <td><input type="text" name="harga" value="" class="form-control" /></td>
                                            <td><input type="text" name="total" value="" class="form-control" /></td>

                                            @endif
                                        </tr>
                                        <tr>
                                            @if ($queue->jenis_rawat === 'Inap')
                                            <td>{{ $loop->index + 10 }}</td>
                                            <td>Cek Darah Lengkap</td>
                                            <td><input type="text" name="qty" value="" class="form-control" /></td>

                                            <td><input type="text" name="harga" value="" class="form-control" /></td>
                                            <td><input type="text" name="total" value="" class="form-control" /></td>

                                            @endif
                                        </tr>
                                        <tr>
                                            @if ($queue->jenis_rawat === 'Inap')
                                            <td>{{ $loop->index + 11 }}</td>
                                            <td>Fisioterapi</td>
                                            <td><input type="text" name="qty" value="" class="form-control" /></td>

                                            <td><input type="text" name="harga" value="" class="form-control" /></td>
                                            <td><input type="text" name="total" value="" class="form-control" /></td>

                                            @endif
                                        </tr>
                                        <tr>
                                            @if ($queue->jenis_rawat === 'Inap')
                                            <td>{{ $loop->index + 12 }}</td>
                                            <td>Tindakan Tambahan</td>
                                            <td><input type="text" name="qty" value="" class="form-control" /></td>

                                            <td><input type="text" name="harga" value="" class="form-control" /></td>
                                            <td><input type="text" name="total" value="" class="form-control" /></td>

                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ($queue->jenis_rawat !== 'Inap')
                                {{-- Subtotal : <input type="text" name="payment" placeholder="payment" class="form-control"  id='payment' style="width: 50%" value="{{ number_format($subtotal + $queue->doctor->harga_jasa) }}" readonly> --}}
                                Subtotal : <input type="text" name="payment" placeholder="payment" class="form-control"  id='payment' style="width: 50%" value="{{ $subtotal + $queue->doctor->harga_jasa }}" readonly>
                                @endif
                                @if ($queue->jenis_rawat == 'Inap')
                                {{-- Subtotal : <input type="text" name="payment" placeholder="payment" class="form-control"  id='payment' style="width: 50%" value="{{ number_format($subtotal + $queue->doctor->harga_jasa) }}" readonly> --}}
                                Subtotal : <input type="text" name="payment" placeholder="payment" class="form-control"  id='payment' style="width: 50%" value="{{ $subtotal + $queue->doctor->harga_jasa }}" readonly>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
