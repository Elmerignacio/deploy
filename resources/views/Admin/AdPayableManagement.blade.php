<x-trea-components.layout/>
<x-trea-components.header/>
<x-trea-components.content>
    <x-Add-components.sidebar :profile="$profile"  :firstname="$firstname" :lastname="$lastname">

            <div class="mt-4">
            <x-trea-components.content-header>PAYABLE MANAGEMENT</x-trea-components.content-header>
                
            <x-trea-components.year-sorting/>

           <x-trea-components.sorting>
            <a href="#" onclick="openModal()" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-green-700">
                Add Payable <i class="fas fa-plus"></i>
            </a>
           </x-trea-components.sorting>
                
 
     <div x-data="{ showDetails: false, selectedPayable: {} }" class="flex flex-col md:flex-row">
        
         <x-two-table-scrollable height="max-h-[70%]"> 
             <thead>
                    <tr class="bg-white text-black border border-black">
                        <th class="p-2 border border-black"><input type="checkbox" id="selectAll"></th>
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
                        <td class="p-2 border border-black">
                            <input type="checkbox" class="rowCheckbox" @click.stop>
                        </td>
                        <td class="p-2 border border-black">{{ $payable->description }}</td>
                        <td class="p-2 border border-black">₱{{ number_format(floor($payable->input_balance), 2) }}</td>
                        <td class="p-2 border border-black">₱{{ number_format(floor($payable->expected_receivable), 2) }}</td>
                        <td class="p-2 border border-black">{{ $payable->dueDate }}</td>
                    </tr>
                @endforeach
        </tbody>
         </x-two-table-scrollable>
               
       
            <x-trea-components.update-payable/>
                 
                    <div class="mt-4 flex justify-end">
                    <button id="deleteButton" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition hidden">
                        DELETE
                    </button>
                </div>
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        let checkboxes = document.querySelectorAll('.rowCheckbox');
                        let deleteButton = document.getElementById('deleteButton');
                
                        checkboxes.forEach(checkbox => {
                            checkbox.addEventListener('change', function () {
                                let selectedCount = document.querySelectorAll('.rowCheckbox:checked').length;
                                
                                if (selectedCount >= 2) {
                                    deleteButton.classList.remove('hidden'); 
                                } else {
                                    deleteButton.classList.add('hidden'); 
                                }
                            });
                        });
                    });
                </script>
            </div>
        </div>
    

      
<x-trea-components.create-payable>
    <div>
        <label class="block mb-1 text-sm font-semibold">YEAR LEVEL:</label>
        <select id="yearLevel" name="yearLevel" class="w-full p-2 rounded-md text-black border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500" required>
            <option value="">SELECT YEAR LEVEL</option>
            <option value="all">ALL YEAR LEVEL</option>
            @foreach($yearLevels as $yearLevel)
                <option value="{{ $yearLevel->yearLevel }}">{{ strtoupper($yearLevel->yearLevel) }}</option>
            @endforeach
        </select>
    </div>
</x-trea-components.create-payable>





       

</x-Add-components.sidebar>

</x-trea-components.content>  

