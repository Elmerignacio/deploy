<x-trea-components.layout/>
<x-trea-components.header/>
<x-trea-components.content>
<x-Student-components.sidebar :profile="$profile" :firstname="$firstname" :lastname="$lastname">

            <div class="mt-4">
            <x-trea-components.content-header>PAYABLE MANAGEMENT</x-trea-components.content-header>
                
            <x-trea-components.year-sorting/>

           <x-trea-components.sorting>
           </x-trea-components.sorting>
                
 
     <div x-data="{ showDetails: false, selectedPayable: {} }" class="flex flex-col md:flex-row">
        <x-two-table-scrollable height="max-h-[45vh] overflow-y-auto"> 

                    <thead>
                        <tr class="bg-white text-black border border-black">
                            <th class="p-2 border border-black">DESCRIPTION</th>
                            <th class="p-2 border border-black bg-green-700">AMOUNT</th>
                            <th class="p-2 border border-black bg-yellow-500">EXPECTED RECEIVABLE</th>
                            <th class="p-2 border border-black bg-red-700">DUE DATE</th>
                        </tr>
                    </thead>
                    <tbody id="usersTableBody">
            @foreach($Payables as $payable)
                <tr class="border border-black cursor-pointer hover:bg-gray-200"
                    @click="selectedPayable = {
                        description: '{{ $payable->description }}',
                        amount: '{{ number_format(floor($payable->input_balance), 2) }}', 
                        dueDate: '{{ $payable->dueDate }}',
                        yearLevel: '{{ $payable->yearLevel ?? '' }}',
                        block: '{{ $payable->block ?? '' }}',
                        name: '{{ $payable->name ?? '' }}'
                    }; showDetails = true">
                    <td class="p-2 border border-black">{{ $payable->description }}</td>
                    <td class="p-2 border border-black">₱{{ number_format(floor($payable->input_balance), 2) }}</td>
                    <td class="p-2 border border-black">₱{{ number_format(floor($payable->expected_receivable), 2) }}</td>
                    <td class="p-2 border border-black">{{ $payable->dueDate }}</td>
                </tr>
            @endforeach
        </tbody>
        </x-two-table-scrollable>
             







<x-Repre-components.viewpayable/>
       

</x-Student-components.sidebar>

</x-trea-components.content>  

