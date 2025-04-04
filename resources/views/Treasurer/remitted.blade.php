<x-trea-components.layout/>
<x-trea-components.header/>
<x-trea-components.content>
<x-trea-components.sidebar>
 
         <div class="mt-4">
            <x-trea-components.content-header>COLLECTIONS</x-trea-components.content-header>
      
        
              <x-trea-components.nav-link>
                <a href="collection" class="text-[17px] text-gray-600">Payment</a>
                <a href="remitted" class="text-[17px] font-semibold text-green-700 border-b-2 border-green-700 pb-1">Remittance</a>
                <a href="" class="text-[17px] text-gray-600">Cash on hand</a>
              </x-trea-components.nav-link>


            <div 
            x-data="collectionsApp()" 
            class="flex flex-col md:flex-row overflow-auto"
          >
            <div class="w-full md:w-1/2 overflow-auto">
              <div class="mt-4 overflow-auto sm:mr-4 md:mr-6 lg:mr-8 xl:mr-10">

                
                <div class="flex flex-col md:flex-row md:justify-between items-start mb-3 w-full">
                    <x-trea-components.sorting class="w-full md:w-auto"/>
                    <x-trea-components.year-sorting class="w-full md:w-auto"/>
                </div>
                
                <table class="w-full min-w-[600px] border border-black rounded-lg text-sm text-center">
                    <thead>
                        <tr class="bg-green-700 text-white border border-black">
                            <th class="p-2 border border-black">DATE</th>
                            <th class="p-2 border border-black">COLLECTED BY</th>
                            <th class="p-2 border border-black">AMOUNT</th>
                            <th class="p-2 border border-black">STATUS</th>
                            <th class="p-2 border border-black">ROLE</th> 
                        </tr>
                    </thead>
                    <tbody x-data="{ selectedId: null, selectedDate: '' }">
                        @php
                            $groupedRemittances = $remittances->groupBy(function($remittance) {
                                return \Carbon\Carbon::parse($remittance->date)->format('Y-m-d') . '-' . $remittance->firstname . ' ' . $remittance->lastname . '-' . $remittance->status;
                            });
                        @endphp
                    
                        @foreach ($groupedRemittances as $group => $remittanceGroup)
                            @php
                                $totalAmount = $remittanceGroup->sum('paid');
                                $remittance = $remittanceGroup->first(); 
                            @endphp
                            <tr class="border border-black hover:bg-gray-200 cursor-pointer"
                                @click="selectedId = '{{ $remittance->id }}'; selectedDate = '{{ \Carbon\Carbon::parse($remittance->date)->format('F d, Y') }}'; showDetails = true; studentId = '{{ $remittance->id }}'; filterPayables('{{ \Carbon\Carbon::parse($remittance->date)->format('Y-m-d') }}'); console.log(selectedDate)"
                                :class="selectedId === '{{ $remittance->id }}' ? 'bg-gray-300' : ''">
                                <td class="p-2 border border-black">{{ \Carbon\Carbon::parse($remittance->date)->format('F d, Y') }}</td>
                                <td class="p-2 border border-black">{{ $remittance->collectedBy }}</td>
                                <td class="p-2 border border-black">{{ number_format($totalAmount, 2) }}</td>
                                <td class="p-2 border border-black font-bold {{ 
                                    strtoupper($remittance->status) === 'PENDING' ? 'text-orange-600' : 
                                    (strtoupper($remittance->status) === 'REMITTED' ? 'text-blue-600' : 'text-green-600') }}">
                                    {{ strtoupper($remittance->status) }}
                                </td>
                                <td class="p-2 border border-black">{{ $remittance->role }}</td> 
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
                
                
              </div>
            </form>

                
            <script>
                function openModal() {
                    document.getElementById("received").classList.remove("hidden");
                }
            
                function closeModal() {
                    document.getElementById("received").classList.add("hidden");
                }
            
                document.addEventListener("DOMContentLoaded", function () {
                    const form = document.querySelector("#received form");
            
                    form.addEventListener("submit", function (event) {
                        event.preventDefault();
                        alert("Remittance Received!"); 
                        closeModal(); 
                    });
                });
            </script>
            
         </div>
         





         <div 
         x-show="showDetails"
         x-transition:enter="transition duration-300 transform"
         x-transition:enter-start="-translate-y-10 opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100"
         x-transition:leave="transition duration-200 transform"
         x-transition:leave-start="translate-y-0 opacity-100"
         x-transition:leave-end="-translate-y-10 opacity-0"
         class="w-full md:w-1/2 p-4 mt-[5%] bg-gray-400 bg-opacity-40 shadow-md border-green-600 border-2 relative"
     >
         <form>
             @csrf
             <input type="hidden" name="student_id" id="studentId">
     

             <div class="flex justify-end pb-2">
                 <button type="button" onclick="closeModal()" class="text-red-500 font-bold text-2xl">&times;</button>
             </div>

    <div class="flex flex-col md:flex-row items-start justify-between w-full gap-5">

    <div class="flex flex-col w-full md:w-auto">
        <div>
            <div class="flex flex-col w-full md:w-auto">
                @if(isset($remittance)) 
                    <div>
                        <p class="text-[20px] font-bold text-green-700">
                            {{$remittance->collectedBy}} 
                        </p>
                        <p class="text-[20px] font-bold text-green-700">
                            {{ $remittance->yearLevel }} - {{ $remittance->block }}
                        </p>
                        <p class="text-[15px] font-bold" x-text="selectedDate"></p>
                    </div>
                @else
                    <p class="text-red-500">No remittance data available.</p>
                @endif
            </div>
            
        </div>


    </div>

    <div class="w-full md:w-auto overflow-x-auto flex md:text-center">
        <table class="w-full border border-black shadow-lg rounded-lg">
            <thead>
                <tr class="bg-gray-800 text-white text-xs md:text-base">
                    <th class="p-2 border border-black bg-green-700">CASH ON HAND</th>
                    <th class="p-2 border border-black bg-blue-700">REMITTED</th>
                    <th class="p-2 border border-black bg-yellow-500">RECEIVABLE</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white text-black text-center text-sm md:text-lg font-semibold">
                    <td class="p-2 border border-black">₱0.00</td>
                    <td class="p-2 border border-black">₱0.00</td>
                    <td class="p-2 border border-black">₱750.00</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
      <!-- Payment Table -->
<div class="mt-5">
    <table class="w-full border border-black text-center text-sm">
        <thead>
            <tr class="bg-green-700 text-white">
                <th class="p-2 border border-black">DESCRIPTION</th>
                <th class="p-2 border border-black">AMOUNT</th>
                <th class="p-2 border border-black">AMOUNT PAID</th>
            </tr>
        </thead>
        <tbody>
            @foreach($remittances as $remittance)
            <tr data-student-id="{{ $remittance->id }}">
                <td class="p-2 border border-black">{{ $remittance->description ?? 'No Description' }}</td>
                <td class="p-2 border border-black">
                    ₱{{ number_format($remittance->amount ?? 0, 2) }} 
                </td>
                <td class="p-2 border border-black">₱{{ number_format($remittance->paid ?? 0, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
        
        <tfoot>
            <tr class="bg-white font-bold">
                <td class="p-2 border border-black">TOTAL</td>
                <td class="p-2 border border-black"></td>
                <td class="p-2 border border-black">₱{{ number_format($remittances->sum('paid'), 2) }}</td>
            </tr>
        </tfoot>
    </table>
</div>


    <!-- Submit Button -->
    <div class="mt-4 text-center">
        <button class="px-6 py-3 bg-green-700 text-white rounded-lg font-bold" disabled>
            RECEIVE
        </button>
    </div>

    <!-- Alpine.js Script -->
    <script>
        function collectionsApp() {
    return {
        showDetails: false,
        studentName: '',
        studentYearBlock: '',
        studentId: '',
    }

}

    </script>




</x-trea-components.sidebar>
</x-trea-components.content>  
