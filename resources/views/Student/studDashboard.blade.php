<x-trea-components.layout/>
<x-trea-components.header/>
<x-trea-components.content>
<x-Student-components.sidebar>
    
    <div>
        <h2 class="text-3xl font-bold">{{$firstname}} {{$lastname}}</h2>
        <p class="text-gray-600 text-sm">DEPARTMENT {{$role}}</p>
    </div>

    <div class="grid lg:grid-cols-3 md:grid-cols-3 gap-4 mt-6">

        <div class="bg-green-500 text-white p-6 rounded-lg shadow-lg text-center ">
            <div class="flex justify-center mt-[15px]">
                <img src="{{ asset('images/cashonhand.png') }}"
                class="w-[30%] h-[30%]" alt="Cash on Hand">
              
            <p class="font-bold text-[20px] flex place-items-center mt-2"  style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">CASH ON HAND</p> 
            </div>
            <p class="text-3xl font-bold"  style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">₱0.00</p>
        </div>

        <div class="bg-red-500 text-white p-6 rounded-lg shadow-lg text-center ">
            <div class="flex justify-center mt-[15px]">
                <img src="{{ asset('images/money.png') }}"
                class="w-[30%] h-[30%]" alt="Expenses">
              
            <p class="font-bold text-[20px] flex place-items-center mt-2"  style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">DEPARTMENT
                EXPENSES
                </p> 
            </div>
            <p class="text-3xl font-bold"  style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">₱0.00</p>
        </div>

        <div class="bg-yellow-500 text-white p-6 rounded-lg shadow-lg text-center ">
        <div class="flex justify-center mt-[15px]">
            <img src="{{ asset('images/receive.png') }}"
            class="w-[20%] h-[20%]" alt="Receivables">
        
        <p class="font-bold text-[20px] flex place-items-center mt-2"  style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">REMAINING BALANCE</p> 
        </div>
        <p class="text-3xl font-bold"  style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">₱172,000,000</p>
        </div>  
    </div>



<!-- Payables Table -->
<div class="mt-6 pb-5">
    <h3 class="text-lg font-bold mb-4">PAYABLES</h3>
    <table class="w-full border-collapse border border-gray-300">
        <thead class="bg-green-500">
            <tr class="text-left">
                <th class="border border-gray-300 p-2">DESCRIPTION</th>
                <th class="border border-gray-300 p-2">AMOUNT</th>
                <th class="border border-gray-300 p-2">EXPECTED RECEIVABLE</th>
                <th class="border border-gray-300 p-2">DUE DATE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border border-gray-300 p-2">SEMESTRAL DUE</td>
                <td class="border border-gray-300 p-2">₱250.00</td>
                <td class="border border-gray-300 p-2">₱75,000.00</td>
                <td class="border border-gray-300 p-2">MAY 20, 2025</td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">SINULOG FESTIVAL</td>
                <td class="border border-gray-300 p-2">₱300.00</td>
                <td class="border border-gray-300 p-2">₱90,000.00</td>
                <td class="border border-gray-300 p-2">JANUARY 10, 2025</td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">FINES</td>
                <td class="border border-gray-300 p-2">₱25.00</td>
                <td class="border border-gray-300 p-2">₱7,500.00</td>
                <td class="border border-gray-300 p-2">MAY 20, 2025</td>
            </tr>
        </tbody>
    </table>
</div>	
</div>

</x-Student-components.sidebar>
</x-trea-components.content>
        
       
           
   
   
