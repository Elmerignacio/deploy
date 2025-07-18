<x-trea-components.layout/>
<x-trea-components.header/>
<x-trea-components.content>
<x-Add-components.sidebar :profile="$profile"  :firstname="$firstname" :lastname="$lastname">
    <div>
        <h2 class="text-4xl text-[#1a4d2e] font-bold">WELCOME, {{$firstname}} {{$lastname}}!</h2>
        <p class="text-gray-600 text-xl">DEPARTMENT {{$role}}</p>
    </div>

    <div class="grid lg:grid-cols-3 md:grid-cols-3 gap-4 mt-6">

        <div class="bg-[#1a4d2e] text-white p-6 rounded-lg shadow-lg text-center ">
            <div class="flex justify-center mt-[15px]">
                <img src="{{ asset('images/cashonhand.png') }}"
                     class="w-[30%] h-[30%]" alt="Cash on Hand">
                <p class="font-bold text-[20px] flex place-items-center mt-2"
                   style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">CASH ON HAND</p> 
            </div>
            <p class="text-3xl font-bold" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">
                ₱{{ number_format($cashOnHand, 2) }}
            </p>
        </div>
        

        <div class="bg-red-500 text-white p-6 rounded-lg shadow-lg text-center ">
            <div class="flex justify-center mt-[15px]">
                   <img src="{{ asset('images/money.png') }}"
                class="w-[30%] h-[30%]" alt="Expenses">
              
            <p class="font-bold text-[20px] flex place-items-center mt-2"  style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">EXPENSES</p> 
            </div>
            <p class="text-3xl font-bold"  style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);"> ₱{{ number_format($totalExpenses, 2) }}</p>
        </div>

        <div class="bg-yellow-500 text-white p-6 rounded-lg shadow-lg text-center ">
        <div class="flex justify-center mt-[15px]">
          <img src="{{ asset('images/receive.png') }}"
        class="w-[20%] h-[20%]" alt="Receivables">
        
        <p class="font-bold text-[20px] flex place-items-center mt-2" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">RECEIVABLE</p>
        </div>
        <p class="text-3xl font-bold" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">₱{{ number_format($totalAmount, 2) }}</p>
        </div>  
    </div>

<!-- Payables Table -->
<div class="mt-6 pb-5">
    <h3 class="text-2xl text-[#1a4d2e] mt-[15px] font-bold mb-4">STUDENTS PAYABLES</h3>
    <x-scrollable-table height="max-h-[45vh] overflow-y-auto">
        <thead class="bg-[#1a4d2e] border-black text-white">
            <tr class="text-left">
                <th class="border border-gray-300 p-2">DESCRIPTION</th>
                <th class="border border-gray-300 p-2">AMOUNT</th>
                <th class="border border-gray-300 p-2">EXPECTED RECEIVABLE</th>
                <th class="border border-gray-300 p-2">DUE DATE</th>
            </tr>
        </thead>
        <tbody id="usersTableBody">
            @foreach($Payables as $payable)
            <tr class="border border-black cursor-pointer"
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
                <td class="p-2 border border-black">{{ \Carbon\Carbon::parse($payable->dueDate)->format('F d, Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </x-scrollable-table>
    
    
</div>



</div>

</x-Add-components.sidebar>
</x-trea-components.content>
        
       
           
   
   
