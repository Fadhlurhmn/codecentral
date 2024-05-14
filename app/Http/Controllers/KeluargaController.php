<?php

namespace App\Http\Controllers;

use App\Models\detail_keluarga_model;
use App\Models\KeluargaModel;
use App\Models\PendudukModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KeluargaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Keluarga Keluarga Penduduk',
            'list' => ['Home', 'Keluarga Keluarga Penduduk']
        ];

        $page = (object)[
            'title' => 'Daftar Keluarga Keluarga Penduduk yang terdaftar'
        ];

        $activeMenu = 'keluarga';

        return view('admin.keluarga.keluarga', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $keluarga = KeluargaModel::select('id_keluarga', 'nomor_keluarga', 'jumlah_kendaraan', 'jumlah_tanggungan', 'jumlah_orang_kerja', 'luas_tanah');

        return DataTables::of($keluarga)
            ->addIndexColumn()
            ->addColumn('aksi', function ($keluarga) {
                $btn = '<a href="' . url('admin/keluarga/' . $keluarga->id_keluarga . '/show') . '" class="btn btn-primary ml-1 flex-col "><i class="fas fa-info-circle"></i></a> ';

                // Periksa apakah detail keluarga ada untuk keluarga saat ini
                $detailKeluarga = detail_keluarga_model::where('id_keluarga', $keluarga->id_keluarga)->first();

                // Jika detail keluarga ditemukan
                if ($detailKeluarga) {
                    $btn .= '<a href="' . url('admin/keluarga/' . $keluarga->id_keluarga . '/edit') . '" class="btn btn-info ml-2 mr-2 flex-col"><i class="fas fa-edit"></i></a> ';
                } else {
                    $btn .= '<a href="' . url('admin/keluarga/' . $keluarga->id_keluarga . '/create_anggota') . '" class="btn btn-primary ml-2 mr-2 flex-col"><i class="fas fa-user-plus"></i></a> ';
                }

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // form untuk tabel keluarga
    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Keluarga Penduduk',
            'list' => ['Home', 'Keluarga Penduduk', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah Data Keluarga'
        ];

        $penduduk = PendudukModel::all(); // ambil data penduduk untuk ditampilkan di form
        $activeMenu = 'keluarga'; // set menu yang sedang aktif

        return view('admin.keluarga.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penduduk' => $penduduk, 'activeMenu' => $activeMenu]);
    }

    // store untuk tabel keluarga
    public function store(Request $request)
    {
        $request->validate([
            'nomor_keluarga' => 'required|integer|digits:16',
            'jumlah_kendaraan' => 'required|integer',
            'alamat' => 'required|string',
            'kelurahan' => 'required|string',
            'kecamatan' => 'required|string',
            'kota' => 'required|string',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'luas_tanah' => 'required|integer',
            'foto_kk' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'jumlah_tanggungan' => 'required|integer',
            'jumlah_orang_kerja' => 'required|integer',
        ]);

        // Menyimpan data foto KK yang diupload ke variabel foto_kk
        $foto_kk = $request->file('foto_kk');
        $nama_file = time() . "_" . $foto_kk->getClientOriginalName();

        // Isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'data_kk';
        $foto_kk->move($tujuan_upload, $nama_file);

        // Simpan data keluarga dan ambil objek yang baru saja disimpan
        KeluargaModel::create([
            'nomor_keluarga' => $request->nomor_keluarga,
            'jumlah_kendaraan' => $request->jumlah_kendaraan,
            'alamat' => $request->alamat,
            'kelurahan' => $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'kota' => $request->kota,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'luas_tanah' => $request->luas_tanah,
            'jumlah_tanggungan' => $request->jumlah_tanggungan,
            'jumlah_orang_kerja' => $request->jumlah_orang_kerja,
            'foto_kk' => $nama_file,
        ]);

        $keluarga = KeluargaModel::where('nomor_keluarga', $request->nomor_keluarga)->first();

        // Redirect ke halaman create_anggota dengan pesan sukses
        return redirect('admin/keluarga/' . $keluarga->id_keluarga . '/create_anggota')->with('success', 'Data keluarga berhasil disimpan');
    }


    // form untuk tabel detail keluarga
    public function createAnggota($id)
    {
        $keluarga = $id; // ambil id keluarga
        $breadcrumb = (object)[
            'title' => 'Anggota Keluarga',
            'list' => ['Home', 'Anggota Keluarga', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Anggota Keluarga'
        ];

        // Ambil data jumlah orang bekerja dan tanggungan dari database
        $jumlahOrangBekerja = KeluargaModel::where('id_keluarga', $id)->sum('jumlah_orang_kerja');
        $jumlahTanggungan = KeluargaModel::where('id_keluarga', $id)->sum('jumlah_tanggungan');

        // Hitung total jumlah orang dari kedua kategori tersebut
        $totalOrang = $jumlahOrangBekerja + $jumlahTanggungan;

        $penduduk = PendudukModel::all(); // ambil data penduduk untuk ditampilkan di form
        $activeMenu = 'detail_keluarga'; // set menu yang sedang aktif

        return view('admin.keluarga.create_anggota', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penduduk' => $penduduk, 'keluarga' => $keluarga, 'activeMenu' => $activeMenu], compact('totalOrang'));
    }

    // method untuk simpan data detail anggota di keluarga
    public function storeAnggota(Request $request)
    {
        $request->validate([
            'id_keluarga' => 'required|integer',
            'id_penduduk' => 'required|array',
            'id_penduduk.*' => 'required|exists:penduduk,id_penduduk',
            'peran_keluarga' => 'required|array',
            'peran_keluarga.*' => 'required|string',
        ]);

        // Menghapus data lama berdasarkan id_keluarga
        detail_keluarga_model::where('id_keluarga', $request->id_keluarga)->delete();

        // Loop through each submitted data to store the family members
        foreach ($request->id_penduduk as $key => $pendudukId) {
            // Store the family member
            detail_keluarga_model::create([
                'id_penduduk' => $pendudukId,
                'peran_keluarga' => $request->peran_keluarga[$key],
                'id_keluarga' => $request->id_keluarga
            ]);
        }

        return redirect('admin/keluarga/' . $request->id_keluarga . '/show')->with('success', 'Data detail anggota berhasil disimpan');
    }


    public function show(string $id)
    {
        $keluarga = KeluargaModel::find($id);

        if (!$keluarga) {
            return redirect('admin/keluarga')->with('error', 'Data keluarga tidak ditemukan');
        }

        // Anda bisa menambahkan logika untuk menampilkan detail anggota keluarga di sini
        $detail_keluarga = detail_keluarga_model::where('id_keluarga', $id)->whereIn('peran_keluarga', ['Kepala Keluarga', 'Istri', 'Anggota Keluarga'])->get();
        $kepala_keluarga = $detail_keluarga->where('peran_keluarga', 'Kepala Keluarga');
        $istri = $detail_keluarga->where('peran_keluarga', 'Istri');
        $anggota = $detail_keluarga->where('peran_keluarga', 'Anggota Keluarga');
        $breadcrumb = (object) [
            'title' => 'Detail Keluarga Penduduk',
            'list' => ['Home', 'Keluarga Penduduk', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail data keluarga '
        ];

        $activeMenu = 'keluarga';

        return view('admin.keluarga.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'keluarga' => $keluarga,
            'detail_keluarga' => $detail_keluarga,
            'kepala_keluarga' => $kepala_keluarga,
            'istri' => $istri,
            'anggota' => $anggota,
            'activeMenu' => $activeMenu
        ]);
    }

    public function edit(string $id)
    {
        $keluarga = KeluargaModel::find($id);

        if (!$keluarga) {
            return redirect('admin/keluarga')->with('error', 'Data keluarga tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Edit Keluarga Penduduk',
            'list' => ['Home', 'Keluarga Penduduk', 'Edit']
        ];

        $page = (object) [
            'title' => 'Ubah data keluarga'
        ];

        $activeMenu = 'keluarga'; // set menu yang sedang aktif
        return view('admin.keluarga.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'keluarga' => $keluarga, 'activeMenu' => $activeMenu]);
    }

    // menyimpan perubahan data keluarga
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nomor_keluarga' => 'required|integer|digits:16',
            'jumlah_kendaraan' => 'required|integer',
            'alamat' => 'required|string',
            'kelurahan' => 'required|string',
            'kecamatan' => 'required|string',
            'kota' => 'required|string',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'luas_tanah' => 'required|integer',
            'jumlah_tanggungan' => 'required|integer',
            'jumlah_orang_kerja' => 'required|integer',
            // 'foto_kk' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $keluarga = KeluargaModel::find($id);

        if (!$keluarga) {
            return redirect('admin/keluarga')->with('error', 'Data keluarga tidak ditemukan');
        }

        // Menyimpan data foto KK yang diupload ke variabel foto_kk
        // $foto_kk = $request->file('foto_kk');
        // $nama_file = time() . "_" . $foto_kk->getClientOriginalName();

        // // Isi dengan nama folder tempat kemana file diupload
        // $tujuan_upload = 'data_kk';
        // $foto_kk->move($tujuan_upload, $nama_file);

        $data = [
            'nomor_keluarga' => $request->nomor_keluarga,
            'jumlah_kendaraan' => $request->jumlah_kendaraan,
            'alamat' => $request->alamat,
            'kelurahan' => $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'kota' => $request->kota,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'luas_tanah' => $request->luas_tanah,
            'jumlah_tanggungan' => $request->jumlah_tanggungan,
            'jumlah_orang_kerja' => $request->jumlah_orang_kerja,
            // 'foto_kk' => $nama_file
        ];

        // Cek apakah ada file gambar yang diunggah
        if ($request->hasFile('foto_kk')) {
            $request->validate([
                'foto_kk' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $foto_kk = $request->file('foto_kk');
            $nama_file_baru = time() . "_" . $foto_kk->getClientOriginalName();
            $tujuan_upload = 'data_kk';
            $foto_kk->move($tujuan_upload, $nama_file_baru);

            // Hapus foto KK lama jika ada
            if ($keluarga->foto_kk) {
                unlink(public_path('data_kk/' . $keluarga->foto_kk));
            }

            $data['foto_kk'] = $nama_file_baru;
        }

        $keluarga->update($data);

        return redirect('admin/keluarga/' . $keluarga->id_keluarga . '/create_anggota')->with('success', 'Data keluarga berhasil disimpan');
    }
}
