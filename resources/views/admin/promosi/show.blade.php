@include('layout.start')

@include('layout.a_navbar')

<!-- start wrapper -->
<div class="h-screen flex flex-row flex-wrap">

  @include('layout.a_sidebar')

  <!-- start content -->
  <div class="bg-white flex-1 p-5 md:mt-16 cursor-default border-t-2 border-teal-500">
    <h1 class=" text-2xl text-gray-600 font-extrabold">{{ $breadcrumb->title }}</h1>
    {{-- Alert ketika data tidak ditemukan --}}
    @if(!$promosi)
    <div class="my-5 bg-white border border-red-500 text-red-500 px-4 py-3 rounded-lg alert">
        <h5 class="font-semibold"><i class="fas fa-ban mr-2"></i>Kesalahan!</h5>
        <p>Data yang Anda cari tidak ditemukan</p>
        <button type="button" class="px-5 mt-2 close bg-red-300/30 rounded-lg " data-dismiss="alert" aria-label="Close" onclick="window.location.href = '{{ url('admin/promosi') }}';">
            close <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @else
    {{-- End bagian alert data --}}
    <div class="flex my-5 bg-white rounded-lg border py-3 shadow-md ">
      <div class="w-1/2 px-4 flex items-center justify-start">
          <img src="https://images.unsplash.com/photo-1611520189922-f7b1ba7d801e?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
               alt="Gambar Usaha"
               class="w-full h-96 rounded-md object-cover">
      </div>
      <dl class="my-3 text-sm">
          <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
              <dt class="font-medium text-base text-gray-900">Nama Usaha</dt>
              <dd class="text-gray-700 sm:col-span-2">{{$promosi->nama_usaha}}</dd>
          </div>

          <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
              <dt class="font-medium text-base text-gray-900">Deskripsi</dt>
              <dd class="text-gray-700 sm:col-span-2">{{$promosi->deskripsi}}</dd>
          </div>

          <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
            <dt class="font-medium text-base text-gray-900">Kategori</dt>
            <dd class="text-gray-700 sm:col-span-2">{{$promosi->kategori}}</dd>
          </div>

          <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
              <dt class="font-medium text-base text-gray-900">Alamat Usaha</dt>
              <dd class="text-gray-700 sm:col-span-2">{{$promosi->alamat}}</dd>
          </div>

          <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
              <dt class="font-medium text-base text-gray-900">NIK Pemilik usaha</dt>
              <dd class="text-gray-700 sm:col-span-2">{{$nik}}</dd>
          </div>

          <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
              <dt class="font-medium text-base text-gray-900">Status Pengajuan</dt>
              {{-- Filter status_pengajuan --}}
              @php
              $bgColor = '';
              switch($promosi->status_pengajuan) {
                  case 'Tolak':
                      $bgColor = 'bg-red-600/60 text-red-800';
                      break;
                  case 'Menunggu':
                      $bgColor = 'bg-yellow-600/60 text-yellow-800';
                      break;
                  case 'Terima':
                      $bgColor = 'bg-teal-600/60 text-teal-800';
                      break;
                  default:
                      $bgColor = 'bg-gray-600/60'; // Warna default jika tidak cocok dengan kondisi di atas
                      break;
              }
              @endphp
              {{-- End filter status_pengajuan --}}
                <dd class="w-20 px-2 text-center {{ $bgColor }} sm:col-span-2 rounded-full inline-block">{{$promosi->status_pengajuan}}</dd>
                @if($promosi->status_pengajuan === 'Menunggu')
                    <div class="flex justify-start mt-2">
                        <form action="{{ url('admin/promosi/' . $promosi->id_promosi . '/show/update-status') }}" method="POST">
                            @csrf
                            <input type="hidden" name="status_pengajuan" value="Terima"> <!-- Tambahkan input tersembunyi untuk nilai status_pengajuan -->
                            <button type="submit" class="bg-teal-500 text-teal-800 text-center hover:bg-teal-600 hover:text-white transition duration-300 ease-in-out text-sm font-medium px-3 py-1 rounded mr-2">Terima</button>
                        </form>
                        <form action="{{ url('admin/promosi/' . $promosi->id_promosi . '/show/update-status') }}" method="POST">
                            @csrf
                            <input type="hidden" name="status_pengajuan" value="Tolak"> <!-- Tambahkan input tersembunyi untuk nilai status_pengajuan -->
                            <button type="submit" class="bg-red-500 text-red-800 text-center hover:bg-red-600 hover:text-white transition duration-300 ease-in-out text-sm font-medium px-3 py-1 rounded">Tolak</button>
                        </form>
                    </div>
                @endif
          </div>
      </dl>
  </div>
      @if($promosi->status_pengajuan === 'Menunggu')
      <a href="{{ url('admin/promosi/daftar') }}" class="text-white bg-teal-400 hover:bg-teal-500 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Kembali</a>
      @else
      <a href="{{ url('admin/promosi/') }}" class="text-white bg-teal-400 hover:bg-teal-500 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Kembali</a>
      @endif
    @endif

    <!-- end content -->
  </div>
  <!-- end wrapper -->

@include('layout.end')
