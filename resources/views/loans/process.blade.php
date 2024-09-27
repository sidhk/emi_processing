<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Process List') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-2 flex items-center justify-end gap-x-2">
                <button type="button" id="process_button"
                    class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">Process Data</button>
            </div>

            <div id="process_table" class="bg-white overflow-hidden shadow-sm sm:rounded-lg hidden mt-1">
                <div class="p-6 text-gray-900">
                    <h2>Process Data</h2>
                    <div class="container mt-5 overflow-x-auto">
                        <table id="emiTable" class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                            <thead>
                                <tr class="w-full bg-gray-100 text-gray-600 text-sm uppercase leading-normal" id="tableHeader"></tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light" id="tableBody"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>

<script>
    $(document).ready(function() {
        $("#process_button").click(function() {
            $('#emiTable').hide();
            $.ajax({
                url: "{{ url('processed_data')}}",
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    let headers = response.columns;
                    let thead = $('#tableHeader');
                    thead.empty();
                    headers.forEach(function(header) {
                        thead.append('<th class="py-3 px-6 text-left">' + header + '</th>');
                    });
                    let tbody = $('#tableBody');
                    tbody.empty();
                    response.data.forEach(function(row) {
                        let tr = $('<tr class="border-b border-gray-200 hover:bg-gray-100"></tr>');
                        headers.forEach(function(header) {
                            let value = row[header] !== undefined ? row[header] : '0.00';
                            tr.append('<td class="py-3 px-6 ">' + value + '</td>');
                        });
                        tbody.append(tr);
                    });
                    $('#process_table').show();

                    $('#emiTable').show();
                },
                error: function(xhr, status, error) {
                    console.error("An error occurred while fetching data:", error);
                }
            });
        });
    });
</script>