@include('layout.start')

@include('layout.a_navbar')

<div class="h-screen flex flex-row">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-white">
        {{-- start breadcrumb --}}
        @include('layout.breadcrumb')
        {{-- end breadcrumb --}}
        <div class="w-full h-fit p-5">
            <form id="form_pengumuman" action="{{ url('admin/pengumuman') }}" method="POST" enctype="multipart/form-data">
                <div class="px-10 py-10 min-w-full bg-white grid grid-cols-4 gap-x-20 gap-y-2 outline-none outline-4 outline-gray-700 rounded-xl">
                    <h1 class="px-5 pb-5 pt-10 mb-5 font-semibold text-center text-lg rtl:text-right text-gray-900 border-b-2 col-span-4 ">
                        {{ $page->title }}
                    </h1>
                    @csrf
                    {{-- @method('PUT') --}}

                    <!-- Display errors -->
                    @if ($errors->any())
                    <div class="col-span-4">
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Ada yang salah!</strong>
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif

                    {{-- judul_pengumuman --}}
                    <label for="judul_pengumuman" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">Judul</label>
                    <input type="text" name="judul_pengumuman" id="judul_pengumuman" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan judul" required />

                    {{-- id_user penulis --}}
                    {{-- dibutuhkan id_user dari login --}}
                    {{-- <input type="hidden" name="id_user" id="id_user" value="{{ id_user }}" required /> --}}

                    {{-- deskripsi --}}
                    <div class="col-span-4 mt-2">
                        <label for="deskripsi" class="block mb-2 text-xs font-bold text-gray-900">Deskripsi</label>
                        <div id="editor">
                            <textarea name="deskripsi" class="normal-case" placeholder="Ketik isi pengumuman disini...">

                            </textarea>
                        </div>

                     </div>

                    {{-- Lampiran --}}
                    <div class="relative w-full group col-span-4">
                        <label for="lampiran" class="block mt-2 text-xs font-bold text-gray-900 col-span-4">Lampiran <span class="font-normal">(File gambar max ukuran 2MB)</span> </label>
                        <input type="file" name="lampiran" id="lampiran" accept="image/*" class="block w-full text-sm bg-gray-50 border border-gray-300 rounded-lg
                            file:mr-4 file:py-2 file:px-4
                            file:border-0 file:rounded-l-lg
                            file:text-xs flie:font-medium
                            file:bg-teal-400
                            hover:file:bg-teal-600
                        "/>

                        <div id="uploadIndicator_foto" class="hidden col-span-4">
                            <!-- Contoh: ikon atau pesan teks -->
                            <span class="text-green-500 text-sm">Gambar Terunggah</span>
                        </div>
                    </div>
                    {{-- <div class="col-span-4">
                        <label for="lampiran" class="block mt-2 text-xs font-bold text-gray-900 col-span-4">Lampiran</label>
                        <div class="relative col-span-2 rounded-lg w-full h-full transition duration-300 ease-in-out mt-2">
                            <label for="lampiran" class="text-xs font-medium cursor-pointer text-white text-center py-2 px-4 bg-teal-500 rounded-lg hover:bg-teal-600 transition duration-300 ease-in-out">
                                Submit Gambar Lampiran (Max ukuran 2MB)
                            </label>
                            <input type="file" name="lampiran" id="lampiran" accept="image/*" class="absolute inset-0 cursor-pointer col-span-2"/>

                            <span id="file-name" class="text-xs text-gray-700 mt-2 block"></span>
                        </div>

                    </div> --}}

                    {{-- Submit --}}
                    <div class="flex mt-4 col-span-2">
                        <a href="{{ url('admin/pengumuman') }}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
                        <button type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center ">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
        {{-- start box form create --}}

    </div>
</div>

@push('js')
<script>
    // ckeditor plugin init
    ClassicEditor
        .create( document.querySelector( '#editor' ), {
        toolbar: [ 'undo', 'redo', '|','bold', 'italic', '|', 'link', 'numberedList', 'bulletedList' ]
        } )

        .catch( error => {
            console.error( error );
        } );

    const lampiran = document.getElementById('lampiran');

    const uploadIndicator_foto = document.getElementById('uploadIndicator_foto');
    lampiran.addEventListener('change', function() {
        if (lampiran.files.length > 0) {
            uploadIndicator_foto.classList.remove('hidden');
        } else {
            uploadIndicator_foto.classList.add('hidden');
        }
    });
</script>
@endpush
@include('layout.end')
