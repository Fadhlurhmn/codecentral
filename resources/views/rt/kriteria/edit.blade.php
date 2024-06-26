@include('layout.start')

@include('layout.rt_navbar')

<div class="h-screen flex flex-row flex-wrap">
    @include('layout.rt_sidebar')
    <div class="flex-grow bg-white">
        <div class="w-full h-fit min-w-max p-5">
            @include('layout.breadcrumb2')
            <form id="form_kriteria" action="{{ url('rt/kriteria') }}" method="POST">
                
                @csrf
                <div class="px-10 py-10 text-xs bg-white gap-x-20 gap-y-2 grid grid-cols-4 outline outline-none outline-4 outline-gray-700 rounded-xl">
                    {{-- Kriteria dan Bobot --}}
                    <div class="col-span-4">
                        <label class="block text-sm font-bold text-gray-900">Kriteria dan Bobot</label>
                        <div id="kriteria-container">
                            <div class="flex items-center gap-x-4 mt-2">
                                <input type="text" name="kriteria[]" class="shadow-sm w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block p-2.5 " placeholder="Kriteria" value="{{$kriteria->nama_kriteria}}" required>
                                <input type="number" name="bobot[]" class="bobot-input shadow-sm w-24 bg-gray-50 border border-gray-300 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block p-2.5 " placeholder="Bobot" oninput="calculateTotalBobot()" value="{{$kriteria->bobot_kriteria}}" required>
                                <button type="button" class="remove-kriteria p-2 bg-red-600 text-white hover:bg-red-700 focus:outline-none rounded-lg" onclick="removeKriteria(this)">Hapus</button>
                            </div>
                        </div>
                        <button type="button" class="py-1.5 px-2 mt-2 bg-teal-500 hover:bg-teal-600 text-white focus:outline-none rounded-lg" onclick="addKriteria()">Tambah Kriteria</button>
                    </div>
    
                    {{-- Total Bobot --}}
                    <div class="col-span-4 mt-4">
                        <label for="total_bobot" class="block text-sm font-medium text-gray-700">Total Bobot</label>
                        <input type="number" id="total_bobot" class="p-2 mt-1 block w-24 rounded-md bg-gray-50 border border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm" readonly>
                        <p id="error-message" class="text-red-500 text-sm mt-2 hidden">Total bobot harus tepat 100.</p>
                    </div>
    
                    {{-- Button submit --}}
                    <div class="flex py-2 px-3 mt-5 justify-start group col-span-2">
                        <a href="{{ url('rt/bansos') }}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-xs w-32 sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
                        <button type="submit" class="text-white bg-teal-600 hover:bg-teal-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs w-32 sm:w-auto px-5 py-2.5 text-center">Simpan</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

@include('layout.end')
<script>
    function addKriteria() {
        const container = document.getElementById('kriteria-container');
        const kriteriaDiv = document.createElement('div');
        kriteriaDiv.className = 'flex items-center gap-x-4 mt-2';
        kriteriaDiv.innerHTML = `
            <input type="text" name="kriteria[]" class="shadow-sm w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block p-2.5 " placeholder="Kriteria" required>
            <input type="number" name="bobot[]" class="bobot-input shadow-sm w-24 bg-gray-50 border border-gray-300 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block p-2.5 " placeholder="Bobot" oninput="calculateTotalBobot()" required>
            <button type="button" class="remove-kriteria p-2 bg-red-600 text-white hover:bg-red-700 focus:outline-none rounded-lg" onclick="removeKriteria(this)">Hapus</button>
        `;
        container.appendChild(kriteriaDiv);
    }
    
    function removeKriteria(button) {
        button.parentElement.remove();
        calculateTotalBobot();
    }
    
    function calculateTotalBobot() {
        let total = 0;
        document.querySelectorAll('.bobot-input').forEach(input => {
            total += parseInt(input.value) || 0;
        });
        document.getElementById('total_bobot').value = total;
        document.getElementById('error-message').classList.toggle('hidden', total === 100);
    }
    
    function validateForm() {
        const total = parseInt(document.getElementById('total_bobot').value);
        if (total !== 100) {
            document.getElementById('error-message').classList.remove('hidden');
            return false;
        }
        document.getElementById('error-message').classList.add('hidden');
        return true;
    }
    </script>