<?php

namespace App\Http\Controllers;

use App\Models\DetailPemeriksaan;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Pemeriksaan;
use App\Models\RumahSakit;
use App\Models\TipeDiagnosa;
use App\Models\TipeTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PemeriksaanController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['title'] = 'Pemeriksaan';
        $this->param['pageTitle'] = 'Pemeriksaan';
        $this->param['pageIcon'] = 'notes-medical';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->param['btnRight']['text'] = 'Tambah Pemeriksaan';
        $this->param['btnRight']['link'] = route('pemeriksaan.create');

        try {
            $keyword = $request->get('keyword');
            $getPemeriksaan = DB::table('pemeriksaan')
                ->join('rumah_sakit', 'rumah_sakit.id_rm', '=', 'pemeriksaan.id_rm')
                ->join('pasien', 'pasien.id_pasien', '=', 'pemeriksaan.id_pasien')
                ->join('dokter as dk_perujuk', 'dk_perujuk.id_dokter', '=', 'pemeriksaan.id_dokter_perujuk')
                ->join('dokter as dk_pengirim', 'dk_pengirim.id_dokter', '=', 'pemeriksaan.id_dokter_pengirim')
                ->select('pemeriksaan.*', 'dk_pengirim.nama_dokter as dokter_pengirim', 'dk_perujuk.nama_dokter as dokter_perujuk', 'pasien.*', 'rumah_sakit.*')
                ->orderByDesc('tgl_pemeriksaan');

            if ($keyword) {
                $getPemeriksaan->where('dk_perujuk.nama_dokter', 'LIKE', "%{$keyword}%")->orWhere('dk_pengirim.nama_dokter', 'LIKE', "%{$keyword}%")->orWhere('nama_pasien', 'LIKE', "%{$keyword}%")->orWhere('no_reg', 'LIKE', "%{$keyword}%");
            }

            $this->param['pemeriksaan'] = $getPemeriksaan->paginate(10);
        } catch (\Illuminate\Database\QueryException $e) {
            \dd($e);
            return redirect()->back()->withStatus('Terjadi Kesalahan');
        }

        return \view('pemeriksaan.list-pemeriksaan', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('pemeriksaan.index');
        $this->param['findAllDokter'] = Dokter::all();
        $this->param['findAllTipe'] = TipeDiagnosa::all();
        $this->param['findAllRm'] = RumahSakit::all();
        $this->param['findAllDiagnosa'] = TipeDiagnosa::all();
        $this->param['dataPemeriksaan'] = null;
        $this->param['detailPemeriksaan'] = null;

        return \view('pemeriksaan.tambah-pemeriksaan', $this->param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // \dd($request);
        try {
            DB::beginTransaction();
            $pasien = Pasien::create([
                'nik' => $request->nik,
                'nama_pasien' => $request->name,
                'umur' => $request->umur,
                'alamat' => $request->alamat,
            ]);

            $tgl_pemeriksaan = $request->tgl_pemeriksaan . ' ' . $request->jam;

            $dokter_perujuk = Dokter::findOrFail($request->dokter_perujuk);
            $dokter_pengirim = Dokter::findOrFail($request->dokter_pengirim);
            $rumah_sakit = RumahSakit::findOrFail($request->rumah_sakit);
            $tipe_diagnosa = TipeDiagnosa::findOrFail($request->tipe_diagnosa);

            $pemeriksaan = new Pemeriksaan();
            $pemeriksaan->no_pa = $request->no_pa;
            $pemeriksaan->id_rm = $rumah_sakit->id_rm;
            $pemeriksaan->id_pasien = $pasien->id_pasien;
            $pemeriksaan->id_dokter_pengirim = $dokter_pengirim->id_dokter;
            $pemeriksaan->id_dokter_perujuk = $dokter_perujuk->id_dokter;
            $pemeriksaan->id_tipe_diagnosa = $tipe_diagnosa->id_tipe;
            $pemeriksaan->hasil_patologi = $request->patologi;
            $pemeriksaan->laporan_pemeriksaan = $request->laporan;
            $pemeriksaan->kesimpulan = $request->kesimpulan;
            $pemeriksaan->tgl_pemeriksaan = $tgl_pemeriksaan;
            $pemeriksaan->save();
            DB::commit();
            return redirect()
                ->route('pemeriksaan.index')
                ->with('status', 'Berhasil ditambah');
        } catch (\Exception $ex) {
            DB::rollback();
            Log::debug($ex);

            return redirect()->route('pemeriksaan.index')->withError('Terjadi kesalahan : ' . $ex->getMessage());
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            Log::debug($ex);

            return redirect()->route('pemeriksaan.index')->withError('Terjadi kesalahan pada database : ' . $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Pemeriksaan $pemeriksaan)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemeriksaan $pemeriksaan)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemeriksaan $pemeriksaan)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemeriksaan $pemeriksaan)
    {
    }

    public function print($id)
    {
        $this->param['pemeriksaan'] = Pemeriksaan::with('pasien', 'dokterPerujuk', 'dokterPengirim', 'rumahSakit', 'tipeDiagnosa')->find($id);

        return view('pemeriksaan.print-pemeriksaan', $this->param);
    }

    public function showHasil($id)
    {
        $this->param['pemeriksaan'] = Pemeriksaan::with('pasien', 'dokter')->find($id);

        return view('pemeriksaan.hasil-pemeriksaan', $this->param);
    }
}
