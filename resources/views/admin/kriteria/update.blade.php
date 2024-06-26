<!-- SweetAlert CSS Styling -->
<style>
    .swal2-actions {
        display: flex;
        justify-content: flex-end;
    }
    .swal2-actions .swal2-cancel {
        order: 1;
        margin-left: 10px;
    }
    .swal2-actions .swal2-confirm {
        order: 2;
        background-color: #38b2ac !important; /* teal-500 */
        color: white !important;
    }
    .swal2-actions .swal2-confirm:hover {
        background-color: #319795 !important; /* teal-600 */
    }
</style>

@include('layout.start')
@include('layout.a_navbar')

<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-white">
        <div class="w-full h-fit min-w-max p-5">
            @include('layout.breadcrumb2')
            
            <form id="form_kriteria" action="{{ url('admin/kriteria') }}" method="POST" onsubmit="return validateForm()">
                @csrf
                <div class="px-10 py-10 text-xs bg-white gap-x-20 gap-y-2 grid grid-cols-4 outline outline-none outline-4 outline-gray-700 rounded-xl">
                    <h1 class="px-5 pb-5 mb-5 font-semibold text-center text-lg rtl:text-right text-gray-900 border-b-2 col-span-full">
                        {{$page->title}}
                    </h1>
                    
                    <!-- Kriteria dan Bobot -->
                    <div class="col-span-4">
                        <label class="block text-sm font-bold text-gray-900">Kriteria dan Bobot</label>
                        <div id="kriteria-container">
                            <div class="flex items-center gap-x-4 mt-2">
                                <input type="text" name="kriteria[]" class="shadow-sm w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block p-2.5" placeholder="Kriteria" required>
                                <input type="number" name="bobot[]" class="bobot-input shadow-sm w-24 bg-gray-50 border border-gray-300 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block p-2.5" placeholder="Bobot" oninput="validateBobot(this)" required>
                                <select name="jenis[]" id="" class="shadow-sm w-24 bg-gray-50 border border-gray-300 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block p-2.5">
                                    <option value="benefit">Benefit</option>
                                    <option value="cost">Cost</option>
                                </select>
                                <button type="button" class="remove-kriteria p-2 bg-red-600 text-white hover:bg-red-700 focus:outline-none rounded-lg" onclick="removeKriteria(this)">Hapus</button>
                            </div>
                        </div>
                        <button type="button" class="py-1.5 px-2 mt-2 bg-teal-500 hover:bg-teal-600 text-white focus:outline-none rounded-lg" onclick="addKriteria()">Tambah Kriteria</button>
                    </div>
                    
                    <!-- Button submit -->
                    <div class="flex py-2 px-3 mt-5 justify-start group col-span-2">
                        <a href="{{ url('admin/bansos') }}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-xs w-32 sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
                        <button type="button" id="saveButton" class="p-2 font-normal text-center shadow-sm bg-teal-500 hover:bg-teal-600 hover:shadow-md hover:shadow-teal-300 text-xs text-white transition duration-300 ease-in-out rounded-lg">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layout.end')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('input[name="bobot[]"]').forEach(function(input) {
            input.addEventListener('input', function() {
                if (parseFloat(this.value) > 100) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Nilai bobot tidak boleh lebih dari 100',
                        confirmButtonText: 'OK'
                    });
                    this.value = 100; // Reset the value to 100 if it exceeds 100
                }
            });
        });

        const saveButton = document.getElementById('saveButton');
        saveButton.addEventListener('click', function() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang telah diubah akan disimpan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#38b2ac', /* teal-500 */
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal',
                customClass: {
                    actions: 'swal2-actions',
                    confirmButton: 'swal2-confirm',
                    cancelButton: 'swal2-cancel'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.querySelector('form').submit();
                }
            })
        });
    });
</script>
