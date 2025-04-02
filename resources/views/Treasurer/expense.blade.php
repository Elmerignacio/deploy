<x-trea-components.layout/>
<x-trea-components.header/>
<x-trea-components.content>
<x-trea-components.sidebar>

    <div class="mt-4">
        <x-trea-components.content-header>EXPENSES</x-trea-components.content-header>

   

        <x-trea-components.nav-link>
          <x-trea-components.year-sorting/> 
          <x-trea-components.year-sorting/> 
          <x-trea-components.year-sorting/> 
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
                    <th class="p-2 border border-black">DATE</th>
                    <th class="p-2 border border-black">FUND ALLOCATION</th>
                    <th class="p-2 border border-black">DESCRIPTION</th>
                    <th class="p-2 border border-black">AMOUNT</th>
                  </tr>
                </thead>
                <tbody>
                   
                </tbody>
                
                <tfoot>
                    <tr class="font-bold">
                        <td colspan="4" class="p-2 border border-black text-center">TOTAL BALANCE:</td>
             
                    </tr>
                </tfoot>
              </table>
                 
                
              </div>
            </div>

            <x-trea-components.payment-modal/>

         </form>
        
    </div>


</x-trea-components.sidebar>

</x-trea-components.content>

