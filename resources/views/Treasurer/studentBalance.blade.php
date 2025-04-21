<x-trea-components.layout/>
<x-trea-components.header/>
<x-trea-components.content>
<x-trea-components.sidebar :profile="$profile"  :firstname="$firstname" :lastname="$lastname">

<div class="mt-4">
    <x-trea-components.content-header>STUDENT BALANCES</x-trea-components.content-header>

    <x-trea-components.table-guide>
        <select id="yearLevelFilter" class="border mt-3 border-black rounded-md px-3 py-1 text-sm focus:ring-2 focus:ring-green-500">
            <option value="" selected>All YEAR LEVEL</option>
            @foreach ($yearLevels as $yearLevel)
                <option value="{{ $yearLevel->yearLevel }}">{{ $yearLevel->yearLevel }}</option>
            @endforeach
        </select>

        <select id="blockFilter" class="border mt-3 border-black rounded-md px-3 py-1 text-sm focus:ring-2 focus:ring-green-500">
            <option value="" selected>BLOCK</option>
            @foreach ($blocks as $block)
                <option value="{{ $block->block }}">{{ $block->block }}</option>
            @endforeach
        </select>
    </x-trea-components.table-guide>

    <x-trea-components.table-dash>
        <h3 id="groupTitle" class="text-green-800 text-2xl font-bold">ALL YEAR LEVEL</h3>
        <p class="text-[15px] text-gray-700">Representative: <span id="representativeName" class="font-medium"></span></p>
        <input type="hidden" id="cashOnHandAmount" value="₱0.00">


        <div class="w-full overflow-x-auto mt-4">
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
                        <td class="p-3 border border-black" id="cashOnHandDisplay">₱0.00</td>
                        <td class="p-3 border border-black" id="remittedDisplay">₱0.00</td>
                        <td class="p-3 border border-black" id="receivableDisplay">₱0.00</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </x-trea-components.table-dash>

    <div class="mt-4 overflow-auto">
        <x-trea-components.table>
            <thead>
                <tr class="bg-green-700 text-white border border-black">
                    <th class="p-2 border border-black">ID NUMBER</th>
                    <th class="p-2 border border-black">LASTNAME</th>
                    <th class="p-2 border border-black">FIRSTNAME</th>
                    <th class="p-2 border border-black">YEAR AND BLOCK</th>
                    <th class="p-2 border border-black">BALANCE</th>
                </tr>
            </thead>
            <tbody id="usersTableBody">
                @php $grandTotal = 0; @endphp
                @forelse($students as $student)
                    @php
                        $totalBalance = $payables[$student->IDNumber]->total_balance ?? 0;
                        $grandTotal += $totalBalance;
                    @endphp
                    <tr class="border border-black cursor-pointer student-row hover:bg-gray-200"
                        data-yearlevel="{{ strtoupper($student->yearLevel) }}"
                        data-block="{{ strtoupper($student->block) }}"
                        onclick="routeToStudentLedger('{{ $student->IDNumber }}')">
                        <td class="p-2 border border-black">{{ $student->IDNumber }}</td>
                        <td class="p-2 border border-black">{{ strtoupper($student->lastname) }}</td>
                        <td class="p-2 border border-black">{{ strtoupper($student->firstname) }}</td>
                        <td class="p-2 border border-black">
                            {{ strtoupper($student->yearLevel) }} - {{ strtoupper($student->block) }}
                        </td>
                        <td class="p-2 border border-black balance-cell">₱{{ number_format($totalBalance, 2) }}</td>
                    </tr>
                @empty
                    <tr id="noStudentsRow">
                        <td colspan="5" class="p-2 border border-black text-red-500">
                            No students found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
            
            <tfoot>
                <tr class=" font-bold text-center text-sm md:text-lg">
                    <td colspan="4" class="p-2 border border-black text-center">TOTAL BALANCE:</td>
                    <td class="p-2 border border-black text-black">₱{{ number_format($grandTotal, 2) }}</td>
                </tr>
            </tfoot>
        </x-trea-components.table>
    </div>

    <script>
        function routeToStudentLedger(idNumber) {
            window.location.href = "/treasurer/student-ledger/" + idNumber;
        }
    </script>

    <script>
        const representatives = @json($representatives);
        const cashOnHand = @json($cashOnHand);
        const remitted = @json($remitted);

        const yearLevelFilter = document.getElementById('yearLevelFilter');
        const blockFilter = document.getElementById('blockFilter');
        const repNameDisplay = document.getElementById('representativeName');
        const cashDisplay = document.getElementById('cashOnHandAmount');
        const cashTableDisplay = document.getElementById('cashOnHandDisplay');
        const remittedDisplay = document.getElementById('remittedDisplay');
        const receivableDisplay = document.getElementById('receivableDisplay');
        const groupTitle = document.getElementById('groupTitle');
        const studentRows = document.querySelectorAll('.student-row');
        const totalBalanceCell = document.querySelector('tfoot td:last-child');

        yearLevelFilter.addEventListener('change', updateDisplay);
        blockFilter.addEventListener('change', updateDisplay);

        function updateDisplay() {
            const year = yearLevelFilter.value.toUpperCase();
            const block = blockFilter.value.toUpperCase();
            let key = year && block ? `${year} - ${block}` : year || block || '';

            groupTitle.innerText = year ? year : 'ALL YEAR LEVEL';

            let totalCash = 0;
            let totalRemitted = 0;
            let totalBalance = 0;

            if (!year || year === 'ALL YEAR LEVEL') {
                Object.entries(representatives).forEach(([repKey, repName]) => {
                    if (!block || repKey.endsWith(block)) {
                        totalCash += parseFloat(cashOnHand[repName] ?? 0);
                        totalRemitted += parseFloat(remitted[repName] ?? 0);
                    }
                });
            } else if (year && !block) {
                Object.entries(representatives).forEach(([repKey, repName]) => {
                    if (repKey.startsWith(year)) {
                        totalCash += parseFloat(cashOnHand[repName] ?? 0);
                        totalRemitted += parseFloat(remitted[repName] ?? 0);
                    }
                });
            } else {
                const repName = representatives[key] || '';
                repNameDisplay.innerText = repName;
                totalCash = parseFloat(cashOnHand[repName] ?? 0);
                totalRemitted = parseFloat(remitted[repName] ?? 0);
            }

            cashDisplay.innerText = `₱${totalCash.toFixed(2)}`;
            cashTableDisplay.innerText = `₱${totalCash.toFixed(2)}`;
            remittedDisplay.innerText = `₱${totalRemitted.toFixed(2)}`;

            studentRows.forEach(row => {
                const rowYear = row.dataset.yearlevel;
                const rowBlock = row.dataset.block;
                const match = (!year || rowYear === year) && (!block || rowBlock === block);

                row.style.display = match ? '' : 'none';

                if (match) {
                    const balanceCell = row.querySelector('td:last-child');
                    const balance = parseFloat(balanceCell.innerText.replace(/[₱,]/g, '')) || 0;
                    totalBalance += balance;
                }
            });

            totalBalanceCell.innerText = `₱${totalBalance.toFixed(2)}`;
            receivableDisplay.innerText = `₱${totalBalance.toFixed(2)}`;
        }

        updateDisplay();
    </script>
</div>



</x-trea-components.sidebar>
</x-trea-components.content>
