<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Klinik Dokterku</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-asli.png') }}" type="image/x-icon">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <!--
  =========================================================
  * ArchitectUI HTML Theme Dashboard - v1.0.0
  =========================================================
  * Product Page: https://dashboardpack.com
  * Copyright 2019 DashboardPack (https://dashboardpack.com)
  * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
  =========================================================
  * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
  -->
    <link href="{{ asset('') }}main.css" rel="stylesheet">
    <link href="{{ asset('') }}main.css" rel="stylesheet">
    <link href="{{ asset('') }}custom.css" rel="stylesheet">
    <style type="text/css" media="print">
        @page {
            size: auto;
            margin: 4;
        }

        table {
            /* margin-left: 12px;
            margin-right: 12px; */
        }

        hr {
            border: none;
            height: 1px;
            /* Set the hr color */
            color: #333;
            /* old IE */
            background-color: #333;
            /* Modern Browsers */
        }
        td:first {
            width: 50px
        }

        body {
            color: #333;
            font-size: 14px;
        }

    </style>
</head>

<body>
    <br>
    {{-- <center> --}}
        <div class="row">
            <div class="col-md-12">
                <table width="100%">
                    <tr>
                        <td style="text-align:center">
                            <img src="{{ asset('assets/images/logo-asli.png') }}" width="100" alt="">
                        </td>
                        <td style="text-align:center">
                            <h3 class="">LABORATORIUM GRAHA</h3>
                            <p>Jl.Panglima Sudirman No.2 Kraksaan, Probolinggi Jawa Timur 67282</p>
                            <p>Telepon (0335) 846500</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <hr>
    <br>

    <div class="row">
        <div class="col-md-12">
            <table style="border-spacing: 25px !important;" width="50%">
                <tr>
                    <td>No. PA</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{ strtoupper($pemeriksaan->no_pa) }}</td>
                </tr>
                <tr>
                    <td>No. RM</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{ strtoupper($pemeriksaan->rumahSakit->no_rm) }}</td>
                </tr>
                <tr>
                    <td>NAMA</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{ strtoupper($pemeriksaan->pasien->nama_pasien) }}</td>
                </tr>
                <tr>
                    <td>UMUR</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{ strtoupper($pemeriksaan->pasien->umur) }} TAHUN</td>
                </tr>
                <tr>
                    <td>ALAMAT</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{ strtoupper($pemeriksaan->pasien->alamat) }}</td>
                </tr>
            </table>
            <table style="border-spacing: 25px !important;" width="50%">
                <tr>
                    <td>Dokter Pengirim</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{ strtoupper($pemeriksaan->dokterPengirim->nama_dokter) }}</td>
                </tr>
                <tr>
                    <td>Dokter Perujuk</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{ strtoupper($pemeriksaan->dokterPerujuk->nama_dokter) }}</td>
                </tr>
                <tr>
                    <td>Tgl Terima</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{ strtoupper($pemeriksaan->tgl_terima) }}</td>
                </tr>
                <tr>
                    <td>Tgl Periksa</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{ strtoupper($pemeriksaan->tgl_pemeriksaan) }}</td>
                </tr>
                <tr>
                    <td>Tgl Hasil</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{ strtoupper($pemeriksaan->tgl_hasil) }}</td>
                </tr>
                <tr>
                    <td>PENGIRIM</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{ strtoupper($pemeriksaan->pengirim) }}</td>
                </tr>
                <tr>
                    <td>NO REGISTER</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{ strtoupper($pemeriksaan->no_reg) }}</td>
                </tr>
            </table>
            <hr>
            <table>
                <tr>
                    <td>Diagnosa Klinik</td>
                    <td>:&nbsp;&nbsp;&nbsp;</td>
                    <td>{{ strtoupper($pemeriksaan->tipeDiagnosa->tipe) }}</td>
                </tr>
            </table>
        </div>
            <br>
            <br>
            <center>
                <table width="100%" border="1" cellpadding="">
                    <thead>
                        <tr style="text-align:center">
                            <th>Nama Penyakit</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($pemeriksaan->details !== null)
                            @foreach ($pemeriksaan->details as $key => $item)
                                <tr style="text-align:center">
                                    <td>{{ $item->tipe->tipe }}</td>
                                    <td>{{ $item->hasil }}</td>
                                    <td>{{ $item->tipe->nilai_normal }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 2rem 0px">Kosong</td>
                            </tr>
                        @endif
                        <tr style="text-align:center;color=white">
                            <td>
                                <font color="#fff">-</font>
                            </td>
                            <td>
                                <font color="#fff">-</font>
                            </td>
                            <td>
                                <font color="#fff">-</font>
                            </td>
                        </tr>
                        <tr style="text-align:center;color=white">
                            <td>
                                <font color="#fff">-</font>
                            </td>
                            <td>
                                <font color="#fff">-</font>
                            </td>
                            <td>
                                <font color="#fff">-</font>
                            </td>
                        </tr>
                        <tr style="text-align:center;color=white">
                            <td>
                                <font color="#fff">-</font>
                            </td>
                            <td>
                                <font color="#fff">-</font>
                            </td>
                            <td>
                                <font color="#fff">-</font>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </center>
            <br>
            {{-- <p class="ml-2">{{ $pemeriksaan->keterangan }}</p> --}}
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <table style="width:100%;margin-left:10px">
                <tr>
                    <td style="text-align:left">
                        {{-- {!! QrCode::size(100)->generate(route('pemeriksaan.hasil',$pemeriksaan->id_pemeriksaan)) !!} --}}
                    </td>
                    <td style="text-align:right">
                        <p class="text-center">Kraksaan, {{ $pemeriksaan->tgl_pemeriksaan }}</p>
                        <p class="text-center">Penanggung Jawab</p>
                        <br>
                        <br>
                        <br>
                        <p class="text-center">{{ $pemeriksaan->dokterPerujuk->nama_dokter }}</p>
                    </td>
                </tr>
            </table>

        </div>
    </div>

    <script>
        window.print()
    </script>
</body>

</html>
