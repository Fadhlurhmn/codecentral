<?php

namespace App\Http\Controllers;

use App\Models\BansosModel;
use App\Models\DetailBansosModel;
use App\Models\KriteriaBansosModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BansosController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Penerima Bantuan Sosial',
            'list' => ['Home', 'Penerima Bantuan Sosial']
        ];

        $page = (object)[
            'title' => 'Daftar Penerima Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        $bansos = BansosModel::all();

        $totalBansos = $bansos->count('id_bansos');

        // Lakukan pengecekan apakah kriteria sudah ada atau belum
        $kriteriaExists = KriteriaBansosModel::count() > 0;

        return view('admin.bansos.bansos', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'bansos' => $bansos,
            'totalBansos' => $totalBansos,
        ])->with('kriteriaExists', $kriteriaExists);
    }

    public function list(Request $request)
    {
        $bansos = BansosModel::all();

        return DataTables::of($bansos)
            ->addIndexColumn()
            ->addColumn('aksi', function ($bansos) {
                return '<a href="' . url('admin/bansos/' . $bansos->id_bansos . '/show') . '">Detail</a>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show($id)
    {
        // Mengambil data Bansos beserta DetailBansos terkait berdasarkan id_bansos
        $bansos = BansosModel::with(['detail_bansos.keluarga'])->find($id);

        if (!$bansos) {
            return redirect('admin/bansos')->with('error', 'Data Bantuan Sosial tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Detail Bantuan Sosial',
            'list' => ['Home', 'Bantuan Sosial', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        return view('admin.bansos.detail', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'bansos' => $bansos,
            'activeMenu' => $activeMenu,
            'detailBansos' => $bansos->detail_bansos
        ]);
    }

    public function daftar($id)
    {
        $bansos = BansosModel::find($id);

        if (!$bansos) {
            return redirect('admin/bansos')->with('error', 'Data Bantuan Sosial tidak ditemukan');
        }
        $breadcrumb = (object) [
            'title' => 'Detail Bantuan Sosial',
            'list' => ['Home', 'Bantuan Sosial', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        return view('admin.bansos.daftar', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'bansos' => $bansos,
            'activeMenu' => $activeMenu
        ]);
    }

    public function create_bansos()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Bantuan Sosial',
            'list' => ['Home', 'Bantuan Sosial', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah Bantuan Sosial'
        ];

        $activeMenu = 'bansos';
        return view('admin.bansos.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function store_bansos(Request $request)
    {
        $request->validate([
            'kode' => 'required|string',
            'nama_bansos' => 'required|string',
            'tanggal_bansos' => 'required|date',
            'pengirim' => 'required|string',
            'bentuk_pemberian' => 'required|string',
            'jumlah_penerima' => 'required|integer'
        ]);

        $bansos = new BansosModel();
        $bansos->kode = $request->kode;
        $bansos->nama = $request->nama_bansos;
        $bansos->tanggal_pemberian = $request->tanggal_bansos;
        $bansos->pengirim = $request->pengirim;
        $bansos->bentuk_pemberian = $request->bentuk_pemberian;
        $bansos->jumlah_penerima = $request->jumlah_penerima;
        $bansos->save();

        return redirect('admin/bansos/')
            ->with('success', 'Data Bansos Berhasil Ditambahkan');
    }

    public function edit_bansos($id)
    {
        $bansos = BansosModel::find($id);

        if (!$bansos) {
            return redirect('admin/bansos')->with('error', 'Data Bantuan Sosial tidak ditemukan');
        }

        $breadcrumb = (object)[
            'title' => 'Edit Bantuan Sosial',
            'list' => ['Home', 'Bantuan Sosial', 'Edit']
        ];

        $page = (object)[
            'title' => 'Bantuan Sosial'
        ];

        $activeMenu = 'bansos';
        return view('admin.bansos.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'bansos' => $bansos,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update_bansos(Request $request, string $id)
    {
        $request->validate([
            'kode' => 'required|string',
            'nama_bansos' => 'required|string',
            'tanggal_bansos' => 'required|date',
            'pengirim' => 'required|string',
            'bentuk_pemberian' => 'required|string',
            'jumlah_penerima' => 'required|integer'
        ]);

        $bansos = BansosModel::find($id);

        if ($bansos) {
            $bansos->kode = $request->kode;
            $bansos->nama = $request->nama_bansos;
            $bansos->tanggal_pemberian = $request->tanggal_bansos;
            $bansos->pengirim = $request->pengirim;
            $bansos->bentuk_pemberian = $request->bentuk_pemberian;
            $bansos->jumlah_penerima = $request->jumlah_penerima;
            $bansos->save();

            return redirect('admin/bansos')->with('success', 'Data Bansos Berhasil diperbarui');
        } else {
            return redirect('admin/bansos')->with('error', 'Data Bansos tidak ditemukan');
        }
    }

    public function delete_bansos($id)
    {
        $bansos = BansosModel::find($id);

        if ($bansos) {
            $bansos->delete();

            return redirect('admin/bansos')->with('success', 'Data Bansos Berhasil dihapus');
        } else {
            return redirect('admin/bansos')->with('error', 'Data Bansos tidak ditemukan');
        }
    }

    public function cek_histori()
    {
        // ambil data histori penerimaan bansos
        $histori_bansos = DetailBansosModel::where('status', 'acc')->get();

        $breadcrumb = (object) [
            'title' => 'Histori Penerimaan Bantuan Sosial',
            'list' => ['Home', 'Bantuan Sosial', 'Histori Penerimaan']
        ];

        $page = (object) [
            'title' => 'Histori Penerimaan Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        return view('admin.bansos.hisgori', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'histori_bansos' => $histori_bansos,
            'activeMenu' => $activeMenu
        ]);
    }
}
