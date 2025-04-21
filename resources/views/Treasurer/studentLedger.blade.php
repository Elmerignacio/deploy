<x-trea-components.layout/>
<x-trea-components.header/>
<x-trea-components.content>
<x-trea-components.sidebar :profile="$profile"  :firstname="$firstname" :lastname="$lastname">

    <div class="mt-4">
        <x-trea-components.content-header>
            <a href="javascript:void(0);" class="back-link" onclick="goBack()">
              <i class="fas fa-arrow-left hover:text-blue-500"></i>
            </a>
            STUDENT LEDGER
        </x-trea-components.content-header>
        <script>
            function goBack() {
                window.history.back();
            }
        </script>
        
        
        <h3 class="text-2xl font-extrabold mt-2">{{ strtoupper($student->firstname) }} {{ strtoupper($student->lastname) }}</h3>
        <p class="text-gray-700 font-medium">ID: {{ $student->IDNumber }}</p>
        <p class="text-gray-700 font-medium">{{ strtoupper($student->yearLevel) }} - {{ strtoupper($student->block) }}</p>
    </div>
    
  <div class="flex flex-col md:flex-row gap-6 mt-6">

<div class="md:w-1/3">
    <h3 class="text-lg font-bold text-green-900">REMAINING BALANCE</h3>
    <div class="overflow-x-auto">
        <table class="w-full border border-black mt-2 text-sm">
            <thead>
                <tr class="bg-green-700 text-white">
                    <th class="p-3 border border-black text-left">DESCRIPTION</th>
                    <th class="p-3 border border-black text-left">AMOUNT</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payables as $payable)
                    <tr class="bg-white">
                        <td class="p-3 border border-black">{{ $payable->description }}</td>
                        <td class="p-3 border border-black font-bold">₱{{ number_format($payable->total_balance, 2) }}</td>
                    </tr>
                @endforeach
                <tr class="bg-green-700 text-white font-bold">
                    <td class="p-3 border border-black">TOTAL</td>
                    <td class="p-3 border border-black">₱{{ number_format($payables->sum('total_balance'), 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    </div>

    <div class="md:w-2/3 ">
      <h3 class="text-lg font-bold text-green-900 mb-2">SETTLED PAYABLE</h3>

<div class="max-h-96 overflow-y-auto">
  <table class="w-full table-auto border-separate border-spacing-0">
    <thead class="sticky top-0 text-white z-10">
      <tr>
        <th class="w-1/5 p-3 border border-black bg-green-700">Date</th>
        <th class="w-1/5 p-3 border border-black bg-green-700">Description</th>
        <th class="w-1/5 p-3 border border-black bg-green-700">Amount</th>
        <th class="w-1/5 p-3 border border-black bg-green-700">Collected By</th>
        <th class="w-1/5 p-3 border border-black bg-green-700">Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach($settledPayables as $settled)
        <tr class="bg-white">
          <td class="w-1/5 p-3 border border-black">
            {{ \Carbon\Carbon::parse($settled->date)->format('F d, Y') }}
          </td>
          <td class="w-1/5 p-3 border border-black">
            {{ $settled->description }}
          </td>
          <td class="w-1/5 p-3 border border-black font-bold">
            ₱{{ number_format($settled->paid, 2) }}
          </td>
          <td class="w-1/5 p-3 border border-black">
            {{ $settled->collectedBy ?? 'N/A' }}
          </td>
          <td class="w-1/5 p-3 border border-black font-bold 
              @if(strtoupper($settled->status)==='TO TREASURER') text-orange-500 drop-shadow-sm
              @elseif(strtoupper($settled->status)==='COLLECTED BY TREASURER') text-blue-600 drop-shadow-sm
              @elseif(strtoupper($settled->status)==='REMITTED') text-green-600 drop-shadow-sm
              @elseif(strtoupper($settled->status)==='COLLECTED') text-yellow-600 drop-shadow-sm
              @else text-red-600 @endif">
            {{ strtoupper($settled->status) }}
          </td>
        </tr>
      @endforeach
    </tbody>
    <tfoot class="sticky bottom-0 bg-green-700 text-white z-10">
      <tr>
        <td class="w-2/5 p-3 border border-black text-left font-bold">TOTAL</td>
        <td class="w-1/5 p-3 border border-black font-bold">
          ₱{{ number_format($settledPayables->sum('paid'), 2) }}
        </td>
        <td class="w-1/5 p-3 border border-black"></td>
        <td class="w-1/5 p-3 border border-black"></td>
        <td class="w-1/5 p-3 border border-black"></td>
      </tr>
    </tfoot>
  </table>
</div>

        
        </div>
    </div>

  
</x-trea-components.sidebar>
</x-trea-components.content>


