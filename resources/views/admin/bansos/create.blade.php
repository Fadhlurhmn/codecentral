@include('layout.start')
@include('layout.a_navbar')

<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-white">
        <div class="w-full h-fit min-w-max p-5">
            @include('layout.breadcrumb2')
            <form id="form" action="{{ url('admin/bansos') }}" method="POST">
                @csrf
                <div class="px-10 py-10 text-xs bg-white gap-x-20 gap-y-2 grid grid-cols-4 outline-none outline-4 outline-gray-700 rounded-xl">
                    <h1 class="px-5 pb-5 mb-5 font-semibold text-center text-lg rtl:text-right text-gray-900 border-b-2 col-span-full">
                        Form Penambahan Bantuan Sosial
                    </h1>
                    
                    <div class="col-span-2">
                        <label for="nama_bansos" class="block text-sm font-bold text-gray-900">Nama Bantuan Sosial</label>
                        <input type="text" name="nama_bansos" id="nama_bansos" class="shadow-sm w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block p-2.5" required>
                    </div>

                    <div class="col-span-2">
                        <label for="tanggal_bansos" class="block text-sm font-bold text-gray-900">Tanggal Pemberian Bantuan</label>
                        <input type="date" name="tanggal_bansos" id="tanggal_bansos" class="shadow-sm w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block p-2.5" required>
                    </div>

                    <div class="col-span-2 font-medium">
                        <label for="kategori_bansos" class="block text-sm font-bold text-gray-900">Kategori</label>
                        <select name="id_kategori_bansos" id="id_kategori_bansos" class="shadow-sm w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block p-2.5" required>
                            <option value="" selected hidden>Pilih Kategori</option>
                            @foreach($kategori as $Kategori)
                                <option value="{{$Kategori->id_kategori_bansos}}">{{$Kategori->nama_kategori}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label for="jumlah_penerima" class="block text-sm font-bold text-gray-900">Jumlah Penerima</label>
                        <input type="number" name="jumlah_penerima" id="jumlah_penerima" class="shadow-sm w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block p-2.5" required>
                    </div>

                    <div class="flex py-2 px-3 mt-5 justify-start group col-span-full">
                        <a href="{{ url('admin/bansos') }}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-xs w-32 sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
                        <button type="submit" class="text-white bg-teal-600 hover:bg-teal-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs w-32 sm:w-auto px-5 py-2.5 text-center">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layout.end')