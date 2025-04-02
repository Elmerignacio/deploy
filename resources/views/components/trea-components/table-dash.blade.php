<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
              
    <div class="w-full md:w-72 flex items-center p-2 mt-10 md:mt-20 lg:mt-32">
        <x-trea-components.sorting/>
    </div>

    <div class="w-full md:w-auto flex flex-col items-start space-y-4">
        <div class="text-center md:text-left">     
     {{$slot}}
        </div>
    

        <!-- Table -->
        <div class="w-full overflow-x-auto">
            <table class="w-full md:w-auto border border-black shadow-lg rounded-lg">
                <thead>
                    <tr class="bg-gray-800 text-white text-xs md:text-base">
                        <th class="p-3 border border-black bg-green-700">CASH ON HAND</th>
                        <th class="p-3 border border-black bg-blue-700">REMITTED</th>
                        <th class="p-3 border border-black bg-yellow-500">RECEIVABLE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white text-black text-center text-sm md:text-lg font-semibold">
                        <td class="p-3 border border-black">₱0.00</td>
                        <td class="p-3 border border-black">₱0.00</td>
                        <td class="p-3 border border-black">₱750.00</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
