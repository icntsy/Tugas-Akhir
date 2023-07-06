@php
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF NOTA</title>
    <style>
        body {
            margin: 0px;
            padding: 0px;
        }

        .deskripsi_apotek {
            text-align: center;
            width: 500px;        }

        .nama_apotek {
            font-size: 25px;
            color:green;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .bold_text_sub {
            font-weight: bold;
        }

        .border {
            border: 1px solid black;
        }

        .content {
            margin-left: 30px;
            margin-right: 30px;
        }

        .thead {
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .tbody {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: center;
        }

        .note {
            margin-top: 50px;
            padding-left: 70px;
        }
    </style>
</head>
<body>

    <table style="width: 100%" cellpadding="10" cellspacing="0">
        <tr>
            <td style="width: 100px">
                <center>
                    <img src="{{ public_path('images/logo-inversesss.png') }}" style="width: 70px; height: 70px">
                </center>
            </td>
            <td class="deskripsi_apotek">
                <p>
                    <div class="nama_apotek">
                        KLINIK PRATAMA LAA - TACHZAN
                    </div>
                    Jl. Bypass Kliwed lama Kec. Kertasemaya Kab. Indramayu
                    <br>
                    Provinsi Jawa Barat 45274
                    <br>
                    Telp (0234) 7141496 Email:
                    <a href="kliniklaatachzan@gmail.com">
                        kliniklaatachzan@gmail.com
                    </a>
                    <br>
                    <small>
                        Klinik Laa-Tachzan dalam naungan PT. RAPRI FAMILI PUTRA
                    </small>
                </p>
            </td>
            <td>
                <table style="width: 100%">
                    <tr>
                        <td>Date</td>
                        <td>:</td>
                        <td>

                            {{ Carbon::parse($transaksi->created_at)->isoFormat('dddd, D MMMM YYYY H:mm:ss') }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">To</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="border"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="bold_text_sub">Nama</td>
                        <td>:</td>
                        <td>
                            {{ $transaksi->queue->patient->name }}
                        </td>
                    </tr>
                    <tr>
                        <td class="bold_text_sub">Umur</td>
                        <td>:</td>
                        <td>
                            {{ Carbon::parse($transaksi->queue->patient->birth_date)->diffInYears(Carbon::now()) }} Tahun
                        </td>
                    </tr>
                    <tr>
                        <td class="bold_text_sub">Alamat</td>
                        <td>:</td>
                        <td>
                            {{ $transaksi->queue->patient->address }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <div class="border"></div>

    <div class="content">
        <p style="font-weight: bold;">
            <u>
                Nota Pembayaran
            </u>
        </p>

        <br>
        <table style="width: 100%" border="1" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th class="thead">NO</th>
                    <th class="thead">QUANTITY</th>
                    <th class="thead">DESCRIPTION</th>
                    <th class="thead">PRICE</th>
                    <th class="thead">AMOUNT</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="tbody">1.</td>
                    <td class="tbody">
                        @php
                            echo $ruangan["qty"];
                        @endphp
                    </td>
                    <td class="tbody">Ruangan</td>
                    <td class="tbody">
                        @php
                            echo "Rp." . number_format($ruangan["harga"]);
                        @endphp
                    </td>
                    <td class="tbody">
                        @php
                            echo "Rp." . number_format($ruangan["amount"]);
                        @endphp
                    </td>
                </tr>
                <tr>
                    <td class="tbody">2.</td>
                    <td class="tbody">
                        @php
                            echo $assesment["qty"];
                        @endphp
                    </td>
                    <td class="tbody">Assesment</td>
                    <td class="tbody">
                        @php
                        echo "Rp." . number_format($assesment["harga"]);

                        @endphp
                    </td>
                    <td class="tbody">
                        @php
                         echo "Rp." . number_format($assesment["amount"]);
                        @endphp
                    </td>
                </tr>
                <tr>
                    <td class="tbody">3.</td>
                    <td class="tbody">
                        @php
                            echo $pendaftaran["qty"];
                        @endphp
                    </td>
                    <td class="tbody">Pendaftaran</td>
                    <td class="tbody">
                        @php
                            echo "Rp." . number_format($pendaftaran["harga"]);
                        @endphp
                    </td>
                    <td class="tbody">
                        @php
                            echo "Rp." . number_format($pendaftaran["amount"]);
                        @endphp
                    </td>
                </tr>
                <tr>
                    <td class="tbody">4.</td>
                    <td class="tbody">
                        @php
                            echo $infus["qty"];
                        @endphp
                    </td>
                    <td class="tbody">Infus</td>
                    <td class="tbody">
                        @php
                           echo "Rp." . number_format($infus["harga"]);
                        @endphp
                    </td>
                    <td class="tbody">
                        @php
                           echo "Rp." . number_format($infus["amount"]);
                        @endphp
                    </td>
                </tr>
                <tr>
                    <td class="tbody">5.</td>
                    <td class="tbody">
                        @php
                            echo $tindakan["qty"];
                        @endphp
                    </td>
                    <td class="tbody">Tindakan</td>
                    <td class="tbody">
                        @php
                             echo "Rp." . number_format($tindakan["harga"]);
                        @endphp
                    </td>
                    <td class="tbody">
                        @php
                           echo "Rp." . number_format($tindakan["amount"]);
                        @endphp
                    </td>
                </tr>
                <tr>
                    <td class="tbody">6.</td>
                    <td class="tbody">
                        @php
                            echo $obat["qty"];
                        @endphp
                    </td>
                    <td class="tbody">Obat</td>
                    <td class="tbody">
                        @php
                          echo "Rp." . number_format($obat["harga"]);
                        @endphp
                    </td>
                    <td class="tbody">
                        @php
                             echo "Rp." . number_format($obat["amount"]);
                        @endphp
                    </td>
                </tr>
                <tr>
                    <td class="tbody">7.</td>
                    <td class="tbody">
                        @php
                            echo $visite["qty"];
                        @endphp
                    </td>
                    <td class="tbody">Visite</td>
                    <td class="tbody">
                        @php
                          echo "Rp." . number_format($visite["harga"]);
                        @endphp
                    </td>
                    <td class="tbody">
                        @php
                        echo "Rp." . number_format($visite["amount"]);
                        @endphp
                    </td>
                </tr>
                <tr>
                    <td class="tbody">8.</td>
                    <td class="tbody">
                        @php
                            echo $pulang["qty"];
                        @endphp
                    </td>
                    <td class="tbody">Pulang</td>
                    <td class="tbody">
                        @php
                           echo "Rp." . number_format($pulang["harga"]);
                        @endphp
                    </td>
                    <td class="tbody">
                        @php
                             echo "Rp." . number_format($pulang["amount"]);
                        @endphp
                    </td>
                </tr>
                <tr>
                    <td class="tbody">9.</td>
                    <td class="tbody">
                        @php
                            echo $ekg["qty"];
                        @endphp
                    </td>
                    <td class="tbody">Ekg</td>
                    <td class="tbody">
                        @php
                            echo "Rp." . number_format($ekg["harga"]);
                        @endphp
                    </td>
                    <td class="tbody">
                        @php
                          echo "Rp." . number_format($ekg["amount"]);
                        @endphp
                    </td>
                </tr>
                <tr>
                    <td class="tbody">10.</td>
                    <td class="tbody">
                        @php
                            echo $darah["qty"];
                        @endphp
                    </td>
                    <td class="tbody">Darah</td>
                    <td class="tbody">
                        @php
                            echo "Rp." . number_format($darah["harga"]);
                        @endphp
                    </td>
                    <td class="tbody">
                        @php
                           echo "Rp." . number_format($darah["amount"]);
                        @endphp
                    </td>
                </tr>
                <tr>
                    <td class="tbody">11.</td>
                    <td class="tbody">
                        @php
                            echo $fisioterapi["qty"];
                        @endphp
                    </td>
                    <td class="tbody">Fisioterapi</td>
                    <td class="tbody">
                        @php
                           echo "Rp." . number_format($fisioterapi["harga"]);
                        @endphp
                    </td>
                    <td class="tbody">
                        @php
                           echo "Rp." . number_format($fisioterapi["amount"]);
                        @endphp
                    </td>
                </tr>
                <tr>
                    <td class="tbody">12.</td>
                    <td class="tbody">
                        @php
                            echo $tambahan["qty"];
                        @endphp
                    </td>
                    <td class="tbody">Tambahan</td>
                    <td class="tbody">
                        @php
                             echo "Rp." . number_format($tambahan["harga"]);
                        @endphp
                    </td>
                    <td class="tbody">
                        @php
                            echo "Rp." . number_format($tambahan["amount"]);
                        @endphp
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align: right; padding-top: 30px; padding-bottom: 30px; font-size: 16px; font-weight: bold; padding-right: 30px;">
                        Total Payment
                    </td>
                    <td class="tbody">
                        Rp. {{ number_format($transaksi->payment) }}
                    </td>
                </tr>
            </tfoot>
        </table>

        <br>

        <table style="margin-left: 50px;">
            <tr>
                <td>
                    <p>
                        <div class="nama_ttd" style="text-align: center; margin-bottom: 70px">
                            Penerima
                        </div>
                        <div class="nama" style="text-align: center">
                            <strong>
                                {{ $transaksi->queue->patient->name }}
                            </strong>
                        </div>
                    </p>
                </td>
                <td colspan="3" style="padding-left: 150px;">
                    <i style="font-size: 25px;">
                        ___ TERIMAKASIH ___
                    </i>
                </td>
            </tr>
        </table>

        <div class="note">
            <p>
                * Invoice ini merupakan tanda terima pembayaran resmi setelah di stempel oleh kasir
            </p>
            <p>
                * Terimakasih atas kepercayaan melakukan pemeriksaan di KlinikLaaTachzan
            </p>
        </div>
    </div>

<script>
    var years = moment().diff($transaksi->queue->patients->birth_date, 'years');
    console.log(years)
</script>


</body>
</html>
