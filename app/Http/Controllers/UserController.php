<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use App\Models\PendudukModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    // Menampilkan halaman daftar akun
    public function index()
    {
        // Mengambil semua data level dari database
        $level = LevelModel::all();

        // Menyiapkan data breadcrumb untuk navigasi halaman
        $breadcrumb = (object) [
            'title' => 'Daftar Akun',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Akun', 'url' => url('admin/akun')]
            ]
        ];

        // Menyiapkan judul halaman
        $page = (object) [
            'title' => 'Daftar akun yang terdaftar dalam sistem'
        ];

        // Menentukan menu yang aktif
        $activeMenu = 'user';

        // Menampilkan view dengan data yang sudah disiapkan
        return view('admin.akun.akun', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menampilkan data user dalam bentuk JSON untuk datatables
    public function list(Request $request)
    {
        // Mengambil data user dengan kolom yang diperlukan dan relasi level dan penduduk
        $akun = UserModel::select('id_user', 'username', 'id_penduduk', 'id_level', 'status_akun')
            ->with(['level', 'penduduk']);

        // Filter berdasarkan Level jika request memiliki id_level
        if ($request->id_level) {
            $akun->where('id_level', $request->id_level);
        }

        // Mengembalikan data user dalam bentuk datatable
        return DataTables::of($akun)
            ->addIndexColumn()
            ->addColumn('aksi', function ($user) {
                // Membuat tombol aksi untuk melihat dan mengedit user
                $btn = '<a href="'.url('admin/akun/' . $user->id_user. '/show').'" class="btn btn-primary ml-1"><i class="fas fa-info-circle"></i></a> ';
                $btn .= '<a href="'.url('admin/akun/' . $user->id_user . '/edit').'" class="btn btn-info ml-2 mr-2"><i class="fas fa-edit"></i></a>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Menampilkan halaman form tambah user
    public function create()
    {
        // Mengambil semua data level dan penduduk dari database
        $level = LevelModel::all();
        $penduduk = PendudukModel::where('status_data', 'Aktif')->get();

        // Menyiapkan data breadcrumb untuk navigasi halaman
        $breadcrumb = (object) [
            'title' => 'Form Tambah Akun Baru',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Akun', 'url' => url('admin/akun')],
                ['name' => 'Tambah', 'url' => url('admin/akun/create')]
            ]
        ];

        // Menyiapkan judul halaman
        $page = (object) [
            'title' => 'Isi data akun'
        ];

        // Menentukan menu yang aktif
        $activeMenu = 'user';

        // Menampilkan view dengan data yang sudah disiapkan
        return view('admin.akun.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'penduduk' => $penduduk,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan data user baru
    public function store(Request $request)
    {
        // Validasi input dari request
        $request->validate([
            'username' => 'required|string|min:3|unique:user,username',
            'id_penduduk' => 'required|integer|exists:penduduk,id_penduduk',
            'password' => 'required|min:5',
            'id_level' => 'required|integer|exists:level,id_level',
            'status_akun' => 'nullable|string',
        ]);

        // Cek apakah ada akun lain dengan jabatan yang sama dan status 'Aktif', kecuali untuk jabatan 'Admin'
        $level = LevelModel::find($request->id_level);
        if ($level->nama_level !== 'Admin') {
            $existingUser = UserModel::where('id_level', $request->id_level)
                                    ->where('status_akun', 'Aktif')
                                    ->first();
            if ($existingUser) {
                return redirect()->back()->withErrors(['id_level' => 'Sudah ada akun dengan jabatan ini yang aktif']);
            }
        }

        // Membuat data user baru dengan data yang sudah divalidasi
        $user = UserModel::create([
            'username' => $request->username,
            'id_penduduk' => $request->id_penduduk,
            'password' => bcrypt($request->password),  // Mengenkripsi password
            'id_level' => $request->id_level,
            'status_akun' => $request->status_akun ?? 'Aktif',  // Jika status_akun tidak diisi, defaultnya 'Aktif'
        ]);

        // Mengarahkan ke halaman detail user dengan pesan sukses
        return redirect('admin/akun/')->with('success', 'Data akun berhasil disimpan');
    }

    // Menampilkan detail user
    public function show(string $id)
    {
        // Mengambil data user berdasarkan ID yang diberikan
        $user = UserModel::with('penduduk', 'level')->find($id);

        // Jika user tidak ditemukan, arahkan kembali ke halaman daftar user dengan pesan error
        if (!$user) {
            return redirect('admin/akun')->with('error', 'Data user tidak ditemukan');
        }

        // Menyiapkan data breadcrumb untuk navigasi halaman
        $breadcrumb = (object) [
            'title' => 'Detail Akun',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Akun', 'url' => url('admin/akun')],
                ['name' => 'Detail', 'url' => url('admin/akun//{id}/show')]
            ]
        ];

        // Menyiapkan judul halaman
        $page = (object) [
            'title' => 'Detail akun yang terdaftar dalam sistem'
        ];

        // Menentukan menu yang aktif
        $activeMenu = 'user';

        // Menampilkan view dengan data yang sudah disiapkan
        return view('admin.akun.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menampilkan halaman form edit user
    public function edit(string $id)
    {
        // Mengambil data user berdasarkan ID yang diberikan
        $user = UserModel::find($id);
        // Mengambil semua data level dan penduduk dari database
        $level = LevelModel::all();
        $penduduk = PendudukModel::where('status_data', 'Aktif')->get();

        // Menyiapkan data breadcrumb untuk navigasi halaman
        $breadcrumb = (object) [
            'title' => 'Edit Akun',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Akun', 'url' => url('admin/akun')],
                ['name' => 'Edit', 'url' => url('admin/akun//{id}/edit')]
            ]
        ];

        // Menyiapkan judul halaman
        $page = (object) [
            'title' => 'Ubah data akun'
        ];

        // Menentukan menu yang aktif
        $activeMenu = 'user';

        // Menampilkan view dengan data yang sudah disiapkan
        return view('admin.akun.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'level' => $level,
            'penduduk' => $penduduk,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan perubahan data user
    public function update(Request $request, string $id)
    {
        // Validasi input dari request
        $request->validate([
            'username' => 'required|string|min:3|unique:user,username,' . $id . ',id_user',
            'id_penduduk' => 'required|integer|unique:user,id_penduduk,' . $id . ',id_user',
            'password' => 'nullable|min:5',
            'id_level' => 'required|integer|exists:level,id_level',
            'status_akun' => 'nullable|string',
        ]);

        // Mengambil data user berdasarkan ID yang diberikan
        $user = UserModel::find($id);

        // Cek apakah user yang sedang diupdate adalah admin yang sedang login
        if (Auth::id() == $id && $user->level->nama_level == 'Admin') {
            // Mencegah perubahan status_akun jika admin mengedit akun sendiri
            $request->merge(['status_akun' => $user->status_akun]);
        }

        // Cek apakah ada akun lain dengan jabatan yang sama dan status 'Aktif', kecuali untuk jabatan 'Admin'
        $level = LevelModel::find($request->id_level);
        if ($level->nama_level !== 'Admin') {
            $existingUser = UserModel::where('id_level', $request->id_level)
                                    ->where('status_akun', 'Aktif')
                                    ->where('id_user', '!=', $id) // Kecualikan akun yang sedang diupdate
                                    ->first();
            if ($existingUser) {
                return redirect()->back()->withErrors(['id_level' => 'Sudah ada akun dengan jabatan ini yang aktif']);
            }
        }

        $user->username = $request->username;
        $user->id_penduduk = $request->id_penduduk;

        // Jika password diisi, enkripsi password baru sebelum menyimpan
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->id_level = $request->id_level;
        $user->status_akun = $request->status_akun;
        $user->save();  // Menyimpan perubahan data user

        // Mengarahkan ke halaman detail user dengan pesan sukses
        return redirect('admin/akun/')->with('success', 'Data akun berhasil diubah');
    }

    // Menampilkan halaman profil pengguna
    public function profil()
    {
        // Mengambil data pengguna yang sedang login
        $user = Auth::user();

        // Mengambil data nomor telepon dari penduduk yang terkait dengan pengguna yang sedang login
        $penduduk = PendudukModel::where('id_penduduk', $user->id_penduduk)->first();

        // Menyiapkan data breadcrumb untuk navigasi halaman
        $breadcrumb = (object) [
            'title' => 'Profil Akun',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Profil', 'url' => url('admin/profil')]
            ]
        ];

        // Menyiapkan judul halaman
        $page = (object) [
            'title' => 'Ubah Profil Akun'
        ];

        // Menentukan menu yang aktif
        $activeMenu = 'profil';

        if($user->level->kode_level == 'ADM'){
            // Menampilkan view dengan data yang sudah disiapkan
            return view('layout.a_edit_profil', [
                'breadcrumb' => $breadcrumb,
                'page' => $page,
                'user' => $user,
                'penduduk' => $penduduk,
                'activeMenu' => $activeMenu
            ]);
        } elseif ($user->level->kode_level == 'RW') {
            // Menampilkan view dengan data yang sudah disiapkan
            return view('layout.rw_edit_profil', [
                'breadcrumb' => $breadcrumb,
                'page' => $page,
                'user' => $user,
                'penduduk' => $penduduk,
                'activeMenu' => $activeMenu
            ]);
        } elseif ($user->level->kode_level == 'RT') {
            // Menampilkan view dengan data yang sudah disiapkan
            return view('layout.rt_edit_profil', [
                'breadcrumb' => $breadcrumb,
                'page' => $page,
                'user' => $user,
                'penduduk' => $penduduk,
                'activeMenu' => $activeMenu
            ]);
        } else {
            return redirect()->back();
        }


    }

    // Menyimpan perubahan data profil pengguna
    public function editProfil(Request $request)
    {
        // Validasi input dari request
        $request->validate([
            'username' => 'required|string|min:3|unique:user,username,' . Auth::id() . ',id_user',
            'no_telp' => 'required|string|max:15',
            'password' => 'nullable|min:5',
        ]);

        // Mengambil data pengguna yang sedang login
        $user = Auth::user();
        $data = [
            'username' => $request->username,
        ];

        // Jika password diisi, enkripsi password baru sebelum menyimpan
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        // Menggunakan metode update untuk memperbarui data pengguna
        UserModel::where('id_user', $user->id_user)->update($data);

        // Memperbarui nomor telepon penduduk
        PendudukModel::where('id_penduduk', $user->id_penduduk)->update(['no_telp' => $request->no_telp]);

        // Mengarahkan ke halaman profil dengan pesan sukses
        return redirect()->back()->with('success', 'Profil berhasil diubah');
    }
}
