<x-trea-components.layout />
<x-trea-components.header />
<x-trea-components.content>
    <x-trea-components.sidebar :profile="$profile" :firstname="$firstname" :lastname="$lastname">

        <div class="mt-4">
            <x-trea-components.content-header>REPORTS</x-trea-components.content-header>

            <x-trea-components.year-sorting />

            <x-trea-components.sorting>
            </x-trea-components.sorting>

            <div x-data="{ 
                showDetails: false, 
                modalDate: '', 
                modalSource: '', 
                modalAmount: '', 
                selectedYearBlock: '', 
                selectedDescription: '', 
                selectedMonth: '', 
                remittances: {{ $remittanceRecords->toJson() }} 
            }" class="flex flex-col md:flex-row">
        
            <x-two-table-scrollable>
                <thead>
                    <tr class="bg-white border border-black">
                        <th class="p-2 border border-black">YEAR AND BLOCK</th>
                        <th class="p-2 border border-black bg-green-700 text-white">TOTAL RECEIVABLE</th>
                        <th class="p-2 border border-black text-black">TOTAL REMITTED</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($groupedData as $data)
                        <tr @click="selectedYearBlock = '{{ $data->year_and_block }}'; showDetails = true;" class="cursor-pointer hover:bg-gray-200 transition-all duration-300 ease-in-out">
                            <td class="p-2 border border-black">{{ $data->year_and_block }}</td>
                            <td class="p-2 border border-black text-black">{{ number_format($data->total_receivable, 2) }}</td>
                            <td class="p-2 border border-black">{{ number_format($data->total_remitted, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-2 text-center text-gray-500">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td class="p-2 text-white border border-black text-center font-bold">Grand Total</td>
                        <td class="p-2 border border-black font-bold text-white">{{ number_format($groupedData->sum('total_receivable'), 2) }}</td>
                        <td class="p-2 border border-black font-bold text-white">{{ number_format($groupedData->sum('total_remitted'), 2) }}</td>
                    </tr>
                </tfoot>
            </x-two-table-scrollable>
        
            <div x-show="showDetails"
            x-transition:enter="transition duration-300 transform"
            x-transition:enter-start="-translate-y-10 opacity-0"
            x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transition duration-200 transform"
            x-transition:leave-start="translate-y-0 opacity-100"
            x-transition:leave-end="-translate-y-10 opacity-0"
            class="h-[100%] w-full md:w-1/2 mx-auto p-6 mt-4 bg-gray-300 bg-opacity-40 shadow-lg border-2 border-green-700 rounded-lg relative">
        
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold text-green-800">
                    Details for <span x-text="selectedYearBlock"></span>
                </h2>
                <button @click="showDetails = false" class="text-red-600 font-bold">X</button>
            </div>
        
            <!-- Description Dropdown -->
            <div class="mb-2 flex justify-left">
                <select x-model="selectedDescription" class="w-1/3 p-2 border border-green-700 rounded">
                    <option value="" disabled selected>Select Description</option>
                    <template x-for="desc in [...new Set(remittances.filter(r => r.yearLevel + ' - ' + r.block === selectedYearBlock).map(r => r.description))]" :key="desc">
                        <option x-text="desc" :value="desc"></option>
                    </template>
                </select>
            </div>
        
            <!-- Month Dropdown -->
            <div class="mb-2 flex justify-left mt-2">
                <select x-model="selectedMonth" class="w-1/3 p-2 border border-green-700 rounded">
                    <option value="" disabled selected>Select Month</option>
                    <template x-for="month in Array.from({length: 12}, (_, i) => i + 1)">
                        <option :value="month" x-text="new Date(0, month - 1).toLocaleString('en-US', { month: 'long' })"></option>
                    </template>
                </select>
            </div>
        
            <!-- Remittance Table -->
            <x-scrollable-table height="max-h-[40vh]">
                <thead>
                    <tr class="bg-green-700 text-white text-center">
                        <th class="p-2 border border-black">DATE REMITTED</th>
                        <th class="p-2 border border-black">PAID</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-center">
                    <template x-if="selectedDescription">
                        <template x-for="item in remittances
                            .filter(r => {
                                const matchBlock = r.yearLevel + ' - ' + r.block === selectedYearBlock;
                                const matchDesc = r.description === selectedDescription;
                                const matchMonth = selectedMonth ? new Date(r.date).getMonth() + 1 === +selectedMonth : true;
                                return matchBlock && matchDesc && matchMonth;
                            })
                            .reduce((acc, curr) => {
                                const existing = acc.find(r => new Date(r.date).toLocaleDateString('en-US') === new Date(curr.date).toLocaleDateString('en-US'));
                                if (existing) {
                                    existing.paid += parseFloat(curr.paid); 
                                } else {
                                    acc.push({ ...curr, paid: parseFloat(curr.paid) }); 
                                }
                                return acc;
                            }, [])
                            .sort((a, b) => new Date(a.date) - new Date(b.date))" :key="item.id">
                            <tr @click="openModal(item)" class="cursor-pointer">
                                <td class="p-2 border border-black" 
                                    x-text="new Date(item.date).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })">
                                </td>
                                <td class="p-2 border border-black" 
                                    x-text="`₱${item.paid.toFixed(2)}`">
                                </td>
                            </tr>
                        </template>
                    </template>
        
                    <!-- No Data Message -->
                    <template x-if="!selectedDescription || !remittances.filter(r => r.yearLevel + ' - ' + r.block === selectedYearBlock && r.description === selectedDescription && (selectedMonth ? new Date(r.date).getMonth() + 1 === +selectedMonth : true)).length">
                        <tr>
                            <td colspan="2" class="p-2 text-center text-red-500">No data available for this description</td>
                        </tr>
                    </template>
                </tbody>
        
                <!-- Total Paid Footer -->
                <tfoot x-show="selectedDescription && remittances.filter(r => r.yearLevel + ' - ' + r.block === selectedYearBlock && r.description === selectedDescription && (selectedMonth ? new Date(r.date).getMonth() + 1 === +selectedMonth : true)).length">
                    <tr>
                        <td class="p-2 text-white border border-black text-center font-bold">Total Paid</td>
                        <td class="p-2 border border-black font-bold text-white text-center">
                            ₱
                            <span x-text="remittances.filter(r => r.yearLevel + ' - ' + r.block === selectedYearBlock && r.description === selectedDescription && (selectedMonth ? new Date(r.date).getMonth() + 1 === +selectedMonth : true)).reduce((sum, r) => sum + parseFloat(r.paid), 0).toFixed(2)">
                            </span>
                        </td>
                    </tr>
                </tfoot>
            </x-scrollable-table>
        </div>
        
        <!-- MODAL -->
        <div class=" fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 z-50 hidden" id="modal">
        
            <!-- Modal Content -->
            <div class="modal bg-white rounded-md w-full md:w-2/3 lg:w-1/2 p-6 relative text-white shadow-lg">
        
                <!-- Close Button -->
                <div class="flex justify-end mb-4">
                    <button onclick="closeModal()" class="text-green-700 text-xl font-bold">✕</button>
                </div>
        
                <!-- Sub-header -->
                <div class="text-center mb-4">
                    <h3 class="text-lg font-bold text-black" id="specificDescription"></h3>
                    <p class="text-lg font-semibold text-black" id="selectedYearBlock">1ST YEAR - A</p> 
                </div>
        
                <!-- Table -->
                <div class="overflow-y-auto max-h-[50vh]">
                    <table class="w-full bg-green-700 text-white border border-white text-sm">
                        <thead>
                            <tr class="text-center bg-green-700">
                                <th class="p-2 border border-black">NAME</th>
                                <th class="p-2 border border-black">AMOUNT PAID</th>
                            </tr>
                        </thead>
                        <tbody id="remittancesTable" class="bg-white text-black">
                        </tbody>
        
                        <!-- Footer Total -->
                        <tfoot>
                            <tr class="bg-green-700 text-center font-bold">
                                <td class="p-2 border border-black">TOTAL</td>
                                <td class="p-2 border border-black" id="totalAmount">₱150.00</td> 
                            </tr>
                        </tfoot>
                    </table>
                </div>
        
                <!-- Buttons -->
                <div class="btn flex justify-center gap-4 mt-6">
                    <button onclick="printModal()" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-gray-200 font-bold">
                        🖨 PRINT
                    </button>
                    <button onclick="exportModal()" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-gray-200 font-bold">
                        📁 EXPORT
                    </button>
                </div>
        
            </div>
        
        </div>
        

            

        </x-trea-components.sidebar>
    </x-trea-components.content>



    <script>
        function openModal(item) {
            // Set description and year-block
            document.getElementById('specificDescription').textContent = item.description;
            document.getElementById('selectedYearBlock').textContent = item.yearLevel + ' - ' + item.block;
    
            const tableBody = document.getElementById('remittancesTable');
            tableBody.innerHTML = ''; // Clear previous table rows to avoid duplication
    
            let total = 0;
    
            // Check if item.remittances is an array
            if (Array.isArray(item.remittances)) {
                item.remittances.forEach(r => {
                    const row = document.createElement('tr');
                    row.classList.add('text-center');
                    row.innerHTML = `
                        <td class="p-2 border border-black">${r.firstName} ${r.lastName}</td>
                        <td class="p-2 border border-black">₱${parseFloat(r.paid).toFixed(2)}</td>
                    `;
                    tableBody.appendChild(row);
                    total += parseFloat(r.paid);
                });
            } else {
                // Fallback for single remittance object
                const row = document.createElement('tr');
                row.classList.add('text-center');
                row.innerHTML = `
                    <td class="p-2 border border-black">${item.firstName} ${item.lastName}</td>
                    <td class="p-2 border border-black">₱${parseFloat(item.paid).toFixed(2)}</td>
                `;
                tableBody.appendChild(row);
                total = parseFloat(item.paid);
            }
    
            // Set total amount
            document.getElementById('totalAmount').textContent = `₱${total.toFixed(2)}`;
    
            // Show modal
            document.getElementById('modal').classList.remove('hidden');
        }
    
        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }
    
        function printModal() {
            window.print();
        }
    
        function exportModal() {
            const description = document.getElementById('specificDescription').textContent;
            const yearBlock = document.getElementById('selectedYearBlock').textContent;
            const rows = document.querySelectorAll('#remittancesTable tr');
            let csvContent = "data:text/csv;charset=utf-8,";
            csvContent += "Description,Year and Block,Name,Amount Paid\n";
    
            rows.forEach(row => {
                const cols = row.querySelectorAll('td');
                if (cols.length === 2) {
                    const name = cols[0].textContent.trim();
                    const amount = cols[1].textContent.trim().replace('₱', '');
                    csvContent += `${description},${yearBlock},${name},${amount}\n`;
                }
            });
    
            const encodedUri = encodeURI(csvContent);
            const link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", `remittance_report_${Date.now()}.csv`);
            document.body.appendChild(link);
            link.click();
            link.remove();
        }
    </script>
    

    
    <style>
        @media print {
    body * {
        visibility: hidden;
        background: none;
    }

    #modal   * {
        visibility: visible;
        border: none;
       
    }
    #btn * {
        visibility: hidden;
       
    }

    

    #myModal {
        position: absolute;
        left: 0;
        top: 0;
    }
}

    </style>