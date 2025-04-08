<x-trea-components.layout/>
<x-trea-components.header/>
<x-trea-components.content>
<x-trea-components.sidebar>

    <div class="mt-4">
        <x-trea-components.content-header>
            <a href="javascript:void(0);" class="back-link" onclick="goBack()">
              <i class="fas fa-arrow-left hover:text-blue-500"></i>
            </a>
            STUDENT LEDGER
          </x-trea-components.content-header>
          
          <script>
            function goBack() {
              window.scrollTo({ top: 0, behavior: 'smooth' });
          
              setTimeout(function() {
                window.location.href = '/studentBalance'; 
              }, 500); 
            }
          </script>
        
        <h3 class="text-2xl font-extrabold mt-2">{{ strtoupper($student->firstname) }} {{ strtoupper($student->lastname) }}</h3>
        <p class="text-gray-700 font-medium">ID NUM: {{ $student->IDNumber }}</p>
        <p class="text-gray-700 font-medium">{{ strtoupper($student->yearLevel) }} {{ strtoupper($student->block) }}</p>
    </div>
    
  <div class="flex flex-col md:flex-row gap-6 mt-6">

<div class="md:w-1/3">
    <h3 class="text-lg font-bold text-green-900">REMAINING BALANCE</h3>
    <div class="overflow-x-auto">
        <table class="w-full border border-gray-300 mt-2 text-sm">
            <thead>
                <tr class="bg-green-900 text-white">
                    <th class="p-3 border border-gray-300 text-left">DESCRIPTION</th>
                    <th class="p-3 border border-gray-300 text-left">AMOUNT</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payables as $payable)
                    <tr class="bg-white">
                        <td class="p-3 border border-gray-300">{{ $payable->description }}</td>
                        <td class="p-3 border border-gray-300 font-bold">₱{{ number_format($payable->total_balance, 2) }}</td>
                    </tr>
                @endforeach
                <tr class="bg-green-900 text-white font-bold">
                    <td class="p-3 border border-gray-300">TOTAL</td>
                    <td class="p-3 border border-gray-300">₱{{ number_format($payables->sum('total_balance'), 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    </div>

    <div class="md:w-2/3">
        <h3 class="text-lg font-bold text-green-900">SETTLED PAYABLE</h3>
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 mt-2 text-sm">
                <thead>
                    <tr class="bg-green-900 text-white">
                        <th class="p-3 border border-gray-300 text-left">DATE</th>
                        <th class="p-3 border border-gray-300 text-left">DESCRIPTION</th>
                        <th class="p-3 border border-gray-300 text-left">AMOUNT</th>
                        <th class="p-3 border border-gray-300 text-left">RECEIVED BY</th>
                        <th class="p-3 border border-gray-300 text-left">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($settledPayables as $settled)
                        <tr class="bg-white">
                            <td class="p-3 border border-gray-300">
                                {{ \Carbon\Carbon::parse($settled->date)->format('F d, Y') }}
                            </td>
                            <td class="p-3 border border-gray-300">
                                {{ $settled->description }}
                            </td>
                            <td class="p-3 border border-gray-300 font-bold">
                                ₱{{ number_format($settled->paid, 2) }}
                            </td>
                            <td class="p-3 border border-gray-300">
                                {{ $settled->collectedBy ?? 'N/A' }}
                            </td>
                            <td class="p-3 border border-gray-300 font-bold 
                                @if(strtoupper($settled->status) === 'PENDING') text-orange-500 
                                @elseif(strtoupper($settled->status) === 'REMITTED') text-blue-500 
                                @elseif(strtoupper($settled->status) === 'CLEARED') text-green-500 
                                @else text-gray-500 @endif">
                                {{ strtoupper($settled->status) }}
                            </td>
                        </tr>
                    @endforeach
    
                    <tr class="bg-green-900 text-white font-bold">
                        <td class="p-3 border border-gray-300 text-left" colspan="2">TOTAL</td>
                        <td class="p-3 border border-gray-300">
                            ₱{{ number_format($settledPayables->sum('paid'), 2) }}
                        </td>
                        <td class="p-3 border border-gray-300"></td>
                        <td class="p-3 border border-gray-300"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

  
</x-trea-components.sidebar>
</x-trea-components.content>


