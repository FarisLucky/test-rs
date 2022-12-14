@extends('template')

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="metismenu-icon fa fa-{{ $pageIcon }} icon-gradient bg-arielle-smile">
                        </i>
                    </div>
                    <div>
                        {{ $pageTitle }}
                    </div>
                </div>
            </div>
        </div>
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <i class="fa fa-check-circle"></i> {{session('status')}}
            </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <i class="fa fa-times-circle"></i> {{session('error')}}
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <a href="{{$btnRight['link']}}"><button class="btn btn-lg btn-primary"> <i class="fa fa-arrow-left mr-2"></i>{{$btnRight['text']}}</button></a>
                    </div>
                </div>
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Data pemeriksaan</h5>
                        <form action="{{ route('pemeriksaan.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="position-relative form-group col-md-4">
                                    <label for="no_pa" class="">No PA</label>
                                    <input name="no_pa" id="no_pa" placeholder="No Registrasi" type="text" class="form-control @error('no_pa') is-invalid @enderror" value="{{ ($dataPemeriksaan != null) ? $dataPemeriksaan['no_pa'] : '' }}">
                                    @error('no_pa')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-4">
                                    <label for="rumah_sakit" class="">Rumah Sakit</label>
                                    <select name="rumah_sakit" id="rumah_sakit" class="form-control @error('rumah_sakit') is-invalid @enderror">
                                        <option value="">-- Pilih rumah_sakit --</option>
                                        @foreach ($findAllRm as $item)
                                            <option value="{{ $item->id_rm }}" {{ ($dataPemeriksaan != null && $dataPemeriksaan['rumah_sakit'] == $item->id_rm) ? 'selected' : '' }} > {{$item->nama_rm}} </option>
                                        @endforeach
                                    </select>
                                    @error('dokter_pengirim')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-4">
                                    <label for="dokter_pengirim" class="">Dokter Pengirim</label>
                                    <select name="dokter_pengirim" id="dokter_pengirim" class="form-control @error('dokter_pengirim') is-invalid @enderror">
                                        <option value="">-- Pilih Dokter --</option>
                                        @foreach ($findAllDokter as $item)
                                            <option value="{{ $item->id_dokter }}" {{ ($dataPemeriksaan != null && $dataPemeriksaan['dokter'] == $item->id_dokter) ? 'selected' : '' }} > {{$item->nama_dokter}} </option>
                                        @endforeach
                                    </select>
                                    @error('dokter_pengirim')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-4">
                                    <label for="dokter_perujuk" class="">Dokter Perujuk</label>
                                    <select name="dokter_perujuk" id="dokter_perujuk" class="form-control @error('dokter_perujuk') is-invalid @enderror">
                                        <option value="">-- Pilih Dokter --</option>
                                        @foreach ($findAllDokter as $item)
                                            <option value="{{ $item->id_dokter }}" {{ ($dataPemeriksaan != null && $dataPemeriksaan['dokter'] == $item->id_dokter) ? 'selected' : '' }} > {{$item->nama_dokter}} </option>
                                        @endforeach
                                    </select>
                                    @error('dokter_perujuk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="position-relative form-group col-md-4">
                                    <label for="nik" class="">NIK</label>
                                    <input name="nik" id="nik" placeholder="NIK" type="text" class="form-control @error('nik') is-invalid @enderror" value="{{ ($dataPemeriksaan != null) ? $dataPemeriksaan['nik'] : '' }}">
                                    @error('nik')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-4">
                                    <label for="name" class="">Nama Lengkap</label>
                                    <input name="name" id="name" placeholder="Nama Lengkap" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ ($dataPemeriksaan != null) ? $dataPemeriksaan['name'] : '' }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-4">
                                    <label for="umur" class="">Umur</label>
                                    <input name="umur" id="umur" placeholder="Umur" type="number" class="form-control @error('umur') is-invalid @enderror" value="{{ ($dataPemeriksaan != null) ? $dataPemeriksaan['umur'] : '' }}">
                                    @error('umur')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-4">
                                    <label for="alamat" class="">Alamat</label>
                                    <textarea name="alamat" id="alamat" placeholder="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ ($dataPemeriksaan != null) ? $dataPemeriksaan['alamat'] : '' }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-4">
                                    <label for="keterangan" class="">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" placeholder="keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{ ($dataPemeriksaan != null) ? $dataPemeriksaan['keterangan'] : '' }}</textarea>
                                    @error('keterangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-4">
                                    <label for="tgl_pemeriksaan" class="">Tanggal Pemeriksaan</label>
                                    <input name="tgl_pemeriksaan" id="tgl_pemeriksaan" placeholder="No Registrasi" type="date" class="form-control @error('tgl_pemeriksaan') is-invalid @enderror" value="{{ ($dataPemeriksaan != null) ? $dataPemeriksaan['tgl_pemeriksaan'] : '' }}">
                                    @error('tgl_pemeriksaan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-4">
                                    <label for="jam" class="">Jam Pemeriksaan</label>
                                    <input name="jam" id="jam" placeholder="Jam Pemeriksaan" class="form-control @error('jam') is-invalid @enderror" value="{{ ($dataPemeriksaan != null) ? $dataPemeriksaan['jam'] : '' }}">
                                    @error('jam')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="position-relative form-group col-md-4">
                                    <label for="patologi" class="">Hasil Patologi</label>
                                    <textarea name="patologi" id="patologi" placeholder="patologi" class="form-control @error('patologi') is-invalid @enderror">{{ ($dataPemeriksaan != null) ? $dataPemeriksaan['patologi'] : '' }}</textarea>
                                    @error('patologi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-4">
                                    <label for="tipe_diagnosa" class="">Diagnosa Klinik</label>
                                    <select name="tipe_diagnosa" id="tipe_diagnosa" class="form-control @error('dokter_perujuk') is-invalid @enderror">
                                        <option value="">-- Pilih tipe_diagnosa --</option>
                                        @foreach ($findAllDiagnosa as $item)
                                            <option value="{{ $item->id_tipe }}" {{ ($dataPemeriksaan != null && $dataPemeriksaan['tipe_diagnosa'] == $item->id_tipe) ? 'selected' : '' }} > {{$item->tipe}} </option>
                                        @endforeach
                                    </select>
                                    @error('tipe_diagnosa')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="position-relative form-group col-md-4">
                                    <label for="patologi" class="">Laporan Pemeriksaan</label>
                                    <textarea name="laporan" id="laporan" placeholder="laporan" class="form-control @error('patologi') is-invalid @enderror">{{ ($dataPemeriksaan != null) ? $dataPemeriksaan['laporan'] : '' }}</textarea>
                                    @error('laporan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="position-relative form-group col-md-4">
                                    <label for="kesimpulan" class="">Kesimpulan</label>
                                    <textarea name="kesimpulan" id="kesimpulan" placeholder="kesimpulan" class="form-control @error('kesimpulan') is-invalid @enderror">{{ ($dataPemeriksaan != null) ? $dataPemeriksaan['kesimpulan'] : '' }}</textarea>
                                    @error('kesimpulan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="mt-1 btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Pemeriksaan</th>
                                            <th>Hasil</th>
                                            <th>Nilai Normal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($detailPemeriksaan !== null)
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($detailPemeriksaan as $key => $item)
                                            <tr>
                                                <td class="text-center text-muted">{{ $no }}</td>
                                                <td>{{ $item['pemeriksaan'] }}</td>
                                                <td>{{ $item['hasil'] }}</td>
                                                <td>{{ $item['nilai_normal'] }}</td>
                                                <td>
                                                    <div class="form-inline">
                                                        <form action="{{ route('pemeriksaan.hapus.detail', $key) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="button" class="btn btn-danger btn-md" data-toggle="tooltip" title="Hapus" data-placement="top" onclick="confirm('{{ __("Apakah anda yakin ingin menghapus?") }}') ? this.parentElement.submit() : ''">
                                                                <span class="fa fa-trash"></span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                                $no++
                                            @endphp
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" style="text-align: center; padding: 2rem 0px">Kosong</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Detail pemeriksaan</h5>
                                <form action="{{ route('pemeriksaan.tambah.detail') }}" method="post">
                                    @csrf
                                    <div class="position-relative form-group">
                                        <label for="tipe_pemeriksaan" class="">Pemeriksaan</label>
                                        <select name="tipe_pemeriksaan" id="tipe_pemeriksaan" class="form-control @error('pengirim') is-invalid @enderror">
                                            <option value="">-- PEMERIKSAAN --</option>
                                            @foreach ($findAllTipe as $item)
                                                <option value="{{ $item->id_tipe }}" {{ old('tipe_pemeriksaan') == $item->id_tipe ? 'selected' : '' }} > {{$item->tipe}} </option>
                                            @endforeach
                                        </select>
                                        @error('tipe_pemeriksaan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="position-relative form-group">
                                        <label for="hasil" class="">Hasil</label>
                                        <select name="hasil" id="hasil" class="form-control  @error('hasil') is-invalid @enderror">
                                            <option value="">-- Hasil --</option>
                                            <option value="NON REAKTIF" {{ old('hasil') == 'NON REAKTIF' ? 'selected' : '' }} >NON REAKTIF</option>
                                            <option value="REAKTIF" {{ old('hasil') == 'REAKTIF' ? 'selected' : '' }} >REAKTIF</option>
                                        </select>
                                        @error('hasil')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="mt-1 btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <form action="{{ route('pemeriksaan.store') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success" data-toggle="tooltip" title="Hapus" data-placement="top" onclick="confirm('{{ __("Apakah anda yakin ingin menyimpan semua ?") }}') ? this.parentElement.submit() : ''">Simpan Semua</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#jam').timepicker({
            uiLibrary: 'bootstrap4',
            format: 'HH:MM'
        });
    </script>
@endsection
