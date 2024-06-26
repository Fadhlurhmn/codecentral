<style>
    /* For WebKit browsers (Chrome, Safari) */
    .custom-scrollbar::-webkit-scrollbar {
        width: 0px;  /* Remove scrollbar space */
        background: transparent;  /* Optional: just make scrollbar invisible */
    }
    
    /* For Firefox */
    .custom-scrollbar {
        scrollbar-width: none;  /* Remove scrollbar space */
        -ms-overflow-style: none;  /* IE and Edge */
    }
    
    /* To make sure the custom-scrollbar class is applied properly */
    .custom-scrollbar {
        overflow-y: auto;
    }
</style>

@include('layout.start')

@include('layout.rt_navbar')

<div class="h-screen flex flex-row flex-wrap">
    @include('layout.rt_sidebar')
    <div class="flex-grow bg-white">
        <div class="p-5 flex flex-col">
            @include('layout.breadcrumb2')
        </div>
        <div class="w-full h-screen min-w-max p-5 overflow-y-auto custom-scrollbar">
            <form id="form" class="px-10 py-10 bg-white outline-none outline-4 outline-gray-700 rounded-xl" action="{{ url('rt/keluarga') }}" method="POST" enctype="multipart/form-data">
                <h1 class="pb-5 mb-10 font-semibold text-center text-lg rtl:text-right text-gray-900 border-b-2">
                    Isi data keluarga
                </h1>
                @csrf
                @if ($errors->any())
                        <div id="errorMessage" class="col-span-full bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Oops! Ada kesalahan:</strong>
                            <ul class="mt-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button id="closeButton" type="button" class="absolute top-0 right-0 px-4 py-3 focus:outline-none">
                                <i class="fas fa-times-circle"></i>
                            </button>
                        </div>
                @endif
                {{-- Nomor Keluarga --}}
                <div class="grid grid-cols-4 gap-x-20 gap-y-2 mb-5">
                    <div class="col-span-4">
                        <label for="nomor_keluarga" class="block mb-2 text-xs font-bold text-gray-900">Nomor Keluarga<span class="text-red-500">*</span></label>
                        <input type="number" name="nomor_keluarga" id="nomor_keluarga" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan Nomor Keluarga" value="{{old('nomor_keluarga')}}" required />
                        <small id="nomor_keluarga_help" class="text-red-500 hidden">Nomor keluarga harus terdiri dari 16 digit.</small>
                    </div>
                    <div class="relative col-span-2 mt-2">
                        <input type="file" name="foto_kk" id="foto_kk" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full" required />
                        {{-- <input type="file" name="foto_kk" id="foto_kk" accept="image/*" class="shadow bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" required /> --}}
                        <label for="foto_kk" class="text-xs font-medium cursor-pointer text-white py-2 px-4 bg-teal-500 rounded-lg hover:bg-teal-600 transition duration-300 ease-in-out">
                            Submit Foto KK (Max ukuran 2MB)
                        </label>
                        <span id="file-name" class="text-xs text-gray-700 mt-2 block"></span>
                        <div id="uploadIndicator_kk" class="hidden mt-2">
                            <span class="text-green-500 text-sm">Gambar Terunggah</span>
                        </div>
                    </div>
                </div>
                
                {{-- Jumlah Kendaraan --}}
                <div class="grid grid-cols-4 gap-x-20 gap-y-2 mb-5">
                    <div class="col-span-4">
                        <label for="jumlah_kendaraan" class="block mb-2 text-xs font-bold text-gray-900">Jumlah Kendaraan<span class="text-red-500">*</span></label>
                        <input type="number" name="jumlah_kendaraan" id="jumlah_kendaraan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan Jumlah Kendaraan" value="{{old('jumlah_kendaraan')}}" required />
                    </div>
                </div>

                {{-- Jumlah Tanggungan --}}
                <div class="grid grid-cols-4 gap-x-20 gap-y-2 mb-5">
                    <div class="col-span-4 sm:col-span-2">
                        <label for="jumlah_tanggungan" class="block mb-2 text-xs font-bold text-gray-900">Jumlah Tanggungan<span class="text-red-500">*</span></label>
                        <input type="number" name="jumlah_tanggungan" id="jumlah_tanggungan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan Jumlah Tanggungan" value="{{old('jumlah_tanggungan')}}" required />
                    </div>
                </div>

                {{-- Jumlah Orang Kerja --}}
                <div class="grid grid-cols-4 gap-x-20 gap-y-2 mb-5">
                    <div class="col-span-4 sm:col-span-2">
                        <label for="jumlah_orang_kerja" class="block mb-2 text-xs font-bold text-gray-900">Jumlah Orang Kerja<span class="text-red-500">*</span></label>
                        <input type="number" name="jumlah_orang_kerja" id="jumlah_orang_kerja" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan Jumlah Orang Kerja" value="{{old('jumlah_orang_kerja')}}" required />
                    </div>
                </div>
                {{-- Luas Tanah --}}
                {{-- <div class="grid grid-cols-4 gap-x-20 gap-y-2 mb-5">
                    <div class="col-span-4 sm:col-span-2">
                        <label for="luas_tanah" class="block mb-2 text-xs font-bold text-gray-900">Luas Tanah<span class="text-red-500">*</span></label>
                        <input type="number" name="luas_tanah" id="luas_tanah" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan Luas Tanah" value="{{old('luas_tanah')}}" required />
                    </div>
                </div> --}}

                {{-- Alamat --}}
                {{-- <div class="grid grid-cols-4 gap-x-20 gap-y-2 mb-5">
                    <div class="col-span-4">
                        <label for="alamat" class="block mb-2 text-xs font-bold text-gray-900">Alamat KK<span class="text-red-500">*</span></label>
                        <input type="text" name="alamat" id="alamat" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan Alamat" value="{{old('alamat')}}" required />
                    </div>
                </div> --}}

                {{-- Kelurahan, Kecamatan, Kota --}}
                {{-- <div class="grid grid-cols-4 gap-x-20 gap-y-2 mb-5">
                    <div class="col-span-4 sm:col-span-2">
                        <label for="kelurahan" class="block mb-2 text-xs font-bold text-gray-900">Kelurahan<span class="text-red-500">*</span></label>
                        <input type="text" name="kelurahan" id="kelurahan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan Kelurahan" value="{{old('kelurahan')}}" required />
                    </div>
                    <div class="col-span-4 sm:col-span-2">
                        <label for="kecamatan" class="block mb-2 text-xs font-bold text-gray-900">Kecamatan<span class="text-red-500">*</span></label>
                        <input type="text" name="kecamatan" id="kecamatan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan Kecamatan" value="{{old('kecamatan')}}" required />
                    </div>
                    <div class="col-span-4 sm:col-span-2">
                        <label for="kota" class="block mb-2 text-xs font-bold text-gray-900">Kota<span class="text-red-500">*</span></label>
                        <input type="text" name="kota" id="kota" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan Kota" value="{{old('kota')}}" required />
                    </div>
                    <div class="col-span-4 sm:col-span-2">
                        <label for="rt" class="block mb-2 text-xs font-bold text-gray-900">RT<span class="text-red-500">*</span></label>
                        <input type="number" name="rt" id="rt" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan RT" value="{{old('rt')}}" required />
                    </div>
                    <div class="col-span-4 sm:col-span-2 hidden">
                        <label for="rw" class="block mb-2 text-xs font-bold text-gray-900">RW<span class="text-red-500">*</span></label>
                        <input type="hidden" value="1" name="rw" id="rw" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan RW" required />
                    </div>
                </div> --}}
                {{-- Submit Button --}}
                <div class="flex col-span-1">
                    <a href="{{ url('rt/keluarga') }}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
                    <button id="submitBtn" type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center ">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layout.end')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const nomorKeluargaInput = document.getElementById('nomor_keluarga');
        const nomorKeluargaHelp = document.getElementById('nomor_keluarga_help');

        // Validasi nomor keluarga harus 16 digit
        nomorKeluargaInput.addEventListener('input', function() {
            if (nomorKeluargaInput.value.length !== 16) {
                nomorKeluargaHelp.classList.remove('hidden');
            } else {
                nomorKeluargaHelp.classList.add('hidden');
            }
        });

        // Upload indicator
        const kkPhotoInput = document.getElementById('foto_kk');
        const uploadIndicatorKK = document.getElementById('uploadIndicator_kk');

        kkPhotoInput.addEventListener('change', function() {
            if (kkPhotoInput.files.length > 0) {
                uploadIndicatorKK.classList.remove('hidden');
            } else {
                uploadIndicatorKK.classList.add('hidden');
            }
        });

        // Script nama gambar
        document.getElementById('foto_kk').addEventListener('change', function(event) {
            const input = event.target;
            const fileName = input.files[0] ? input.files[0].name : '';
            document.getElementById('file-name').textContent = fileName;
        });

        document.getElementById('closeButton').addEventListener('click', function() {
            document.getElementById('errorMessage').style.display = 'none';
        });
    });
</script>
