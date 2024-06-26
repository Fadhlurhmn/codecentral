@include('layout.start')

@include('layout.rw_navbar')

<div class="min-h-screen flex flex-row bg-gray-100">
    @include('layout.rw_sidebar')

    <div class="flex flex-col flex-grow p-6 cursor-default">
        <div class="container bg-white shadow-lg rounded-lg p-6">
            
            <h1 class="text-2xl font-extrabold text-gray-700">{{$page->title}}</h1>

            <div class="p-5 text-sm font-normal text-gray-800">
                <div class="flex flex-row mb-4">
                    <div class="mr-8">
                        <h2 class="font-semibold text-lg">Nomor Keluarga:</h2>
                        <p class="text-base">{{$detail[0]->nomor_keluarga}}</p>
                    </div>
                    <div>
                        <h2 class="font-semibold text-lg">Nama Kepala Keluarga:</h2>
                        <p class="text-base">{{$detail[0]->nama_kepala_keluarga}}</p>
                    </div>
                </div>
                
                <table class="w-full bg-white border border-gray-200 rounded-lg shadow-md mt-6">
                    <thead class="bg-teal-500 text-white">
                        <tr>
                            <th class="px-6 py-3 text-xs font-semibold uppercase">Nama Kriteria</th>
                            <th class="px-6 py-3 text-xs font-semibold uppercase">Nilai Kriteria</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($detail as $data)
                        <tr>
                            <td class="px-6 py-4">{{$data->nama_kriteria}}</td>
                            @switch($data->id_kriteria)

                                @case(1)
                                    @switch($data->nilai_kriteria)
                                        @case(1)
                                            <td class="px-6 py-4 text-left"> 1 KK</td>
                                            @break
                                        @case(2)
                                            <td class="px-6 py-4 text-left"> 2 KK</td>
                                            @break
                                        @case(3)
                                            <td class="px-6 py-4 text-left"> 3 KK</td>
                                            @break
                                        @case(4)
                                            <td class="px-6 py-4 text-left"> >3 KK</td>
                                            @break
                                        @default
                                            <td class="px-6 py-4 text-left"> N/A</td>
                                    @endswitch
                                    @break

                                @case(2)
                                    @switch($data->nilai_kriteria)
                                        @case(1)
                                            <td class="px-6 py-4 text-left"> 1-3 Orang</td>
                                            @break
                                        @case(2)
                                            <td class="px-6 py-4 text-left"> 4 Orang</td>
                                            @break
                                        @case(3)
                                            <td class="px-6 py-4 text-left"> 5 Orang</td>
                                            @break
                                        @case(4)
                                            <td class="px-6 py-4 text-left"> ≥ 6 Orang</td>
                                            @break
                                        @default
                                            <td class="px-6 py-4 text-left"> N/A</td>
                                    @endswitch
                                    @break
                                
                                @case(3)
                                    @switch($data->nilai_kriteria)
                                        @case(1)
                                            <td class="px-6 py-4 text-left"> Tidak Sekolah/Tidak Tamat SD</td>
                                            @break
                                        @case(2)
                                            <td class="px-6 py-4 text-left"> SD</td>
                                            @break
                                        @case(3)
                                            <td class="px-6 py-4 text-left"> SMP</td>
                                            @break
                                        @case(4)
                                            <td class="px-6 py-4 text-left"> SMA/SMK/PT</td>
                                            @break
                                        @default
                                            <td class="px-6 py-4 text-left"> N/A</td>
                                    @endswitch
                                    @break
                                
                                @case(4)
                                    @switch($data->nilai_kriteria)
                                        @case(1)
                                            <td class="px-6 py-4 text-left"> ≥ 3 Orang</td>
                                            @break
                                        @case(2)
                                            <td class="px-6 py-4 text-left"> 2 Orang</td>
                                            @break
                                        @case(3)
                                            <td class="px-6 py-4 text-left"> 1 Orang</td>
                                            @break
                                        @case(4)
                                            <td class="px-6 py-4 text-left"> Tidak Ada</td>
                                            @break
                                        @default
                                            <td class="px-6 py-4 text-left"> N/A</td>
                                    @endswitch
                                    @break
                                
                                @case(5) {{-- Case untuk id_kriteria 5 --}}
                                    @switch($data->nilai_kriteria)
                                        @case(1)
                                            <td class="px-6 py-4 text-left"> < 400 ribu</td>
                                            @break
                                            @case(2)
                                            <td class="px-6 py-4 text-left"> 400 - 700 ribu</td>
                                            @break
                                        @case(3)
                                            <td class="px-6 py-4 text-left"> 700 ribu - 1 juta</td>
                                            @break
                                        @case(4)
                                            <td class="px-6 py-4 text-left"> > 1 juta</td>
                                            @break
                                        @default
                                            <td class="px-6 py-4 text-left"> N/A</td>
                                    @endswitch
                                    @break
                                
                                @case(6) {{-- Case untuk id_kriteria 6 --}}
                                    @switch($data->nilai_kriteria)
                                        @case(1)
                                            <td class="px-6 py-4 text-left"> < 400 ribu</td>
                                            @break
                                        @case(2)
                                            <td class="px-6 py-4 text-left"> 400 - 700 ribu</td>
                                            @break
                                        @case(3)
                                            <td class="px-6 py-4 text-left"> 700 ribu - 1 juta</td>
                                            @break
                                        @case(4)
                                            <td class="px-6 py-4 text-left"> > 1 juta</td>
                                            @break
                                        @default
                                            <td class="px-6 py-4 text-left"> N/A</td>
                                    @endswitch
                                    @break
                                
                                {{-- Tambahan case untuk id_kriteria 7 --}}
                                @case(7)
                                    @switch($data->nilai_kriteria)
                                        @case(1)
                                            <td class="px-6 py-4 text-left"> Magersari/Pakai Gratis</td>
                                            @break
                                        @case(2)
                                            <td class="px-6 py-4 text-left"> Sewa < 1 juta</td>
                                            @break
                                        @case(3)
                                            <td class="px-6 py-4 text-left"> Milik Orang Tua/Warisan</td>
                                            @break
                                        @case(4)
                                            <td class="px-6 py-4 text-left"> Milik Sendiri/Sewa</td>
                                            @break
                                        @default
                                            <td class="px-6 py-4 text-left"> N/A</td>
                                    @endswitch
                                    @break
                                
                                {{-- Tambahan case untuk id_kriteria 8 --}}
                                @case(8)
                                    @switch($data->nilai_kriteria)
                                        @case(1)
                                            <td class="px-6 py-4 text-left"> Sumur Milik Tetangga</td>
                                            @break
                                        @case(2)
                                            <td class="px-6 py-4 text-left"> Sumur Milik Sendiri</td>
                                            @break
                                        @case(3)
                                            <td class="px-6 py-4 text-left"> PDAM Terbatas</td>
                                            @break
                                        @case(4)
                                            <td class="px-6 py-4 text-left"> PDAM Bebas/Air Kemasan</td>
                                            @break
                                        @default
                                            <td class="px-6 py-4 text-left"> N/A</td>
                                    @endswitch
                                    @break
                                                                {{-- Case untuk id_kriteria 9 --}}
                                                                @case(9)
                                                                @switch($data->nilai_kriteria)
                                                                    @case(1)
                                                                        <td class="px-6 py-4 text-left"> Listrik Numpang</td>
                                                                        @break
                                                                    @case(2)
                                                                        <td class="px-6 py-4 text-left"> Listrik 450 watt</td>
                                                                        @break
                                                                    @case(3)
                                                                        <td class="px-6 py-4 text-left"> Listrik 900 watt</td>
                                                                        @break
                                                                    @case(4)
                                                                        <td class="px-6 py-4 text-left"> Listrik >900 watt</td>
                                                                        @break
                                                                    @default
                                                                        <td class="px-6 py-4 text-left"> N/A</td>
                                                                @endswitch
                                                                @break
                                                            
                                                            {{-- Case untuk id_kriteria 10 --}}
                                                            @case(10)
                                                                @switch($data->nilai_kriteria)
                                                                    @case(1)
                                                                        <td class="px-6 py-4 text-left"> Jalan Kaki/Sepeda/Sepeda Motor Seadanya</td>
                                                                        @break
                                                                    @case(2)
                                                                        <td class="px-6 py-4 text-left"> Sepeda Motor 1 Buah, Kondisi Baik</td>
                                                                        @break
                                                                    @case(3)
                                                                        <td class="px-6 py-4 text-left"> Sepeda Motor >1 Buah, Kondisi Baik</td>
                                                                        @break
                                                                    @case(4)
                                                                        <td class="px-6 py-4 text-left"> Mobil</td>
                                                                        @break
                                                                    @default
                                                                        <td class="px-6 py-4 text-left"> N/A</td>
                                                                @endswitch
                                                                @break
                            
                                @default
                                    <td class="px-6 py-4 text-left">N/A</td>
                            @endswitch
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <div class="flex flex-row mb-4">
                    <div class="mr-8">
                        <h2 class="font-semibold text-lg">Histori Menerima Bansos</h2>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full mx-auto bg-white border border-gray-200 rounded-lg shadow-md">
                        <thead class="bg-teal-500 text-white">
                            <tr>
                                <th class="px-6 py-3 text-xs font-semibold uppercase">Nama</th>
                                <th class="px-6 py-3 text-xs font-semibold uppercase">Tanggal Pemberian</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @if ($histori_menerima->isEmpty())
                            <tr>
                                <td class="px-6 py-4 text-xs text-center" colspan="2">Belum menerima bansos apapun</td>
                            </tr>
                            @else
                            @foreach ($histori_menerima as $data)
                            <tr>
                                <td class="px-6 py-4 text-xs text-center">{{$data->nama_bansos}}</td>
                                <td class="px-6 py-4 text-xs text-center">{{$data->tanggal_pemberian}}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    
                </div>
                
                
            </div>

            <div class="mt-6">
                <a href="{{ url('rw/bansos/'. $detail[0]->id_bansos . '/daftar') }}" class="p-2 font-normal text-center shadow-sm bg-teal-300 hover:bg-teal-400 hover:shadow-md hover:shadow-teal-300 text-xs text-teal-700 hover:text-teal-700 transition duration-300 ease-in-out rounded-lg">Kembali</a>
            </div>
        </div>
    </div>
</div>

@include('layout.end')
