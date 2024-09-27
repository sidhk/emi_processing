<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Loan List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h2>Loan Details</h2>

                 <!-- Table to display records -->
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                        <thead>
                            <tr class="w-full bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Client ID</th>
                                <th class="py-3 px-6 text-left">No. of Payment</th>
                                <th class="py-3 px-6 text-left">First Payment Date</th>
                                <th class="py-3 px-6 text-left">Last Payment Date</th>
                                <th class="py-3 px-6 text-left">Loan Amount</th>

                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($loans as $loan)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6">{{ $loan->clientid }}</td>
                                    <td class="py-3 px-6">{{ $loan->num_of_payment }}</td>
                                    <td class="py-3 px-6">{{ $loan->first_payment_date }}</td>
                                    <td class="py-3 px-6">{{ $loan->last_payment_date }}</td>
                                    <td class="py-3 px-6">{{ $loan->loan_amount }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            
               
            </div>
            </div>
        </div>
    </div>
</x-app-layout>

