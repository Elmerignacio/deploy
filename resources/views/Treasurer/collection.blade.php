<x-trea-components.layout/>
<x-trea-components.header/>
<x-trea-components.content>
<x-trea-components.sidebar>

    <div class="mt-4">
        <x-trea-components.content-header>COLLECTIONS</x-trea-components.content-header>

   

        <x-trea-components.nav-link>
          <a href="collection" class="text-[15px] sm:text-[17px] font-semibold text-green-700 border-b-2 border-green-700 pb-1">Payment</a>
         <a href="remitted" class="text-[15px] sm:text-[17px] text-gray-600"> Remittance</a>
        </x-trea-components.nav-link>
      
              
        <x-trea-components.sorting/>

        
        <form action="save-payment" method="POST">
          @csrf
        
          <div 
            x-data="collectionsApp()" 
            class="flex flex-col md:flex-row overflow-auto"
          >
            <div class="w-full md:w-1/2 overflow-auto">
              <div class="mt-4 overflow-auto sm:mr-4 md:mr-6 lg:mr-8 xl:mr-10">
                <table class="w-full min-w-[600px] border border-black rounded-lg text-sm text-center">
                <thead>
                  <tr class="bg-green-700 text-white border border-black">
                    <th class="p-2 border border-black">ID NUMBER</th>
                    <th class="p-2 border border-black">FIRSTNAME</th>
                    <th class="p-2 border border-black">LASTNAME</th>
                    <th class="p-2 border border-black">YEAR AND BLOCK</th>
                  </tr>
                </thead>
                <tbody id="usersTableBody" x-data="{ activeRow: null }">
                    @php $grandTotalBalance = 0; @endphp
                    @foreach ($students as $student)
                        @php
                            $totalBalance = $payables->where('IDNumber', $student->IDNumber)->sum('amount');
                            $grandTotalBalance += $totalBalance;
                        @endphp
                        <tr 
                            class="border border-black cursor-pointer hover:bg-gray-200"
                            :class="activeRow === '{{ $student->IDNumber }}' ? 'bg-gray-300' : ''"
                            @click="activeRow = '{{ $student->IDNumber }}'; handleClick('{{ $student->IDNumber }}', '{{ strtoupper($student->firstname) }} {{ strtoupper($student->lastname) }}', '{{ strtoupper($student->yearLevel) }} - {{ strtoupper($student->block) }}')"
                        >
                            <td class="p-2 border border-black">{{ $student->IDNumber }}</td>
                            <td class="p-2 border border-black">{{ strtoupper($student->firstname) }}</td>
                            <td class="p-2 border border-black">{{ strtoupper($student->lastname) }}</td>
                            <td class="p-2 border border-black">
                                {{ strtoupper($student->yearLevel) }} - {{ strtoupper($student->block) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                
                <tfoot>
                </tfoot>
              </table>
                 
                
              </div>
            </div>

            <x-trea-components.payment-modal/>

         </form>
        
    </div>


</x-trea-components.sidebar>

</x-trea-components.content>

