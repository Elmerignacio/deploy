<x-trea-components.layout/>
<x-trea-components.header/>
<x-trea-components.content>

<x-trea-components.sidebar>

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
                    <tr class="border border-black cursor-pointer student-row" 
                        data-yearlevel="{{ strtoupper($student->yearLevel) }}" 
                        data-block="{{ strtoupper($student->block) }}">
                        <td class="p-2 border border-black">{{ $student->IDNumber }}</td>
                        <td class="p-2 border border-black">{{ strtoupper($student->lastname) }}</td>
                        <td class="p-2 border border-black">{{ strtoupper($student->firstname) }}</td>
                        <td class="p-2 border border-black">
                            {{ strtoupper($student->yearLevel) }} - {{ strtoupper($student->block) }}
                        </td> 
                        <td class="p-2 border border-black">₱{{ number_format($totalBalance, 2) }}</td>
                    </tr>
                @empty
                    <tr id="noStudentsRow">
                        <td colspan="5" class="p-2 border border-black text-red-500">
                            No students found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </x-trea-components.table>
    </div>

</x-trea-components.sidebar>
</x-trea-components.content>


<script>
    let representatives = @json($representatives);

    function filterTable() {
        let selectedYearLevel = document.getElementById("yearLevelFilter").value.toUpperCase();
        let selectedBlock = document.getElementById("blockFilter").value.toUpperCase();
        let rows = document.querySelectorAll(".student-row");

        rows.forEach(row => {
            let yearLevel = row.getAttribute("data-yearlevel").toUpperCase();
            let block = row.getAttribute("data-block").toUpperCase();

            let showRow = (selectedYearLevel === "" || yearLevel === selectedYearLevel) &&
                          (selectedBlock === "" || block === selectedBlock);

            row.style.display = showRow ? "" : "none";
        });

        updateRepresentative();
        updateYearLevelTitle();
    }

    function updateRepresentative() {
        let selectedYearLevel = document.getElementById("yearLevelFilter").value.trim();
        let selectedBlock = document.getElementById("blockFilter").value.trim();

        let key = selectedYearLevel.toUpperCase() + '-' + selectedBlock.toUpperCase();
        console.log("Looking for representative with key:", key);

        let representativeName = representatives[key] || "No representative assigned";
        document.getElementById("representativeName").textContent = representativeName;
    }

    function updateYearLevelTitle() {
        let selectedYearLevel = document.getElementById("yearLevelFilter").value.trim();
        let selectedBlock = document.getElementById("blockFilter").value.trim();
        let titleElement = document.getElementById("groupTitle");

        if (selectedYearLevel === "" && selectedBlock === "") {
            titleElement.textContent = "ALL YEAR LEVEL";
        } else if (selectedYearLevel !== "" && selectedBlock === "") {
            titleElement.textContent = selectedYearLevel.toUpperCase();
        } else if (selectedYearLevel === "" && selectedBlock !== "") {
            titleElement.textContent = "ALL YEAR LEVEL - " + selectedBlock.toUpperCase();
        } else {
            titleElement.textContent = selectedYearLevel.toUpperCase() + " - " + selectedBlock.toUpperCase();
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("yearLevelFilter").addEventListener("change", filterTable);
        document.getElementById("blockFilter").addEventListener("change", filterTable);


        updateRepresentative();
        updateYearLevelTitle();
    });
</script>


