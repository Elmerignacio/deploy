<x-trea-components.layout/>
<x-trea-components.header/>
<x-trea-components.content>
<x-trea-components.sidebar :profile="$profile"  :firstname="$firstname" :lastname="$lastname">

    <div class="mt-3">
        <x-trea-components.content-header>MANAGE USER</x-trea-components.content-header>
        
        <x-trea-components.nav-link class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
            <a href="/treasurer/manageUser" class="text-[17px] font-semibold text-green-700 border-b-2 border-green-700 pb-1">Active</a>
            <a href="/treasurer/archiveUser" class="text-[17px] text-gray-600">Archive</a>
        </x-trea-components.nav-link>
             
        <x-trea-components.sorting class="mt-4">
            <button id="archiveBtn" class="bg-gray-600 text-white px-6 py-2 mr-[350px] rounded-lg shadow-md hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed" disabled title="Select at least one student to enable">
                Archive
            </button>
        
            <a href="#" onclick="openModal()" class="bg-green-700 text-white px-4 py-2 rounded-lg shadow-md hover:bg-green-700">
                Add Users <i class="fas fa-plus"></i>
            </a>
            
        </x-trea-components.sorting>
        <script>
            function openModal() {
                document.getElementById("createUserModal").classList.remove("hidden");
            }
            
            function closeModal() {
                document.getElementById("createUserModal").classList.add("hidden");
            }
        </script>

    <div x-data="{ 
            showDetails: false, 
            selectedPayable: { id: '', name: '', yearLevel: '', block: '', description: '', amount: '', dueDate: '' },
            selectUser(user) { 
                this.selectedPayable = user;
                this.showDetails = true;
            }
        }"
        class="flex flex-col md:flex-row overflow-auto"
    >
    <x-two-table-scrollable>
        <thead class="sticky top-0 z-10 bg-green-700 text-white text-sm sm:text-base">
            <tr>
                <th class="p-2 border border-black text-center">
                    <input type="checkbox" id="selectAll" class="accent-green-700">
                </th>
                <th class="p-2 border border-black text-left">ID NUMBER</th>
                <th class="p-2 border border-black text-left">FIRSTNAME</th>
                <th class="p-2 border border-black text-left">LASTNAME</th>
                <th class="p-2 border border-black text-left">YEAR & BLOCK</th>
            </tr>
        </thead>
        <tbody id="usersTableBody" x-data="{ selectedRow: null }">
            @foreach ($students as $student)
            <tr 
                :class="selectedRow === '{{ $student->IDNumber }}' ? 'bg-gray-300' : 'hover:bg-gray-200'" 
                class="border border-black cursor-pointer text-sm sm:text-base transition-colors duration-150"
                data-yearlevel="{{ strtolower($student->yearLevel) }}"
                data-block="{{ strtolower($student->block) }}"
                @click="
                    selectedRow = '{{ $student->IDNumber }}';
                    selectUser({ 
                        id: '{{ $student->IDNumber }}', 
                        firstname: '{{ strtoupper($student->firstname) }}',
                        lastname: '{{ strtoupper($student->lastname) }}',
                        yearLevel: '{{ strtoupper($student->yearLevel) }}',
                        block: '{{ strtoupper($student->block) }}',
                        gender: '{{ ucfirst(strtolower($student->gender)) }}',  
                        description: '', 
                        amount: '', 
                        dueDate: '' 
                    })
                "
            >
                <td class="p-2 border border-black text-center">
                    <input type="checkbox" name="students[]" value="{{ $student->IDNumber }}" class="rowCheckbox accent-green-700">
                </td>
                <td class="p-2 border border-black">{{ $student->IDNumber }}</td>
                <td class="p-2 border border-black">{{ strtoupper($student->firstname) }}</td>
                <td class="p-2 border border-black">{{ strtoupper($student->lastname) }}</td>
                <td class="p-2 border border-black">{{ strtoupper($student->yearLevel) }} - {{ strtoupper($student->block) }}</td>
            </tr>
            @endforeach
        </tbody>
    </x-two-table-scrollable>
    

    <x-trea-components.modify-modal>
        <div class="relative flex justify-center">
            <img id="previewImage" class="w-32 h-32 rounded-full border-4 border-white"
                src="{{ asset('storage/' . ($profile ? $profile->profile : 'images/default.jpg')) }}"
                alt="User Profile">
        </div>
    </x-trea-components.modify-modal>


    </div>
    </div>
    
    
        
         
<x-trea-components.create-users/>

<x-trea-components.archive-modal/>
<x-trea-components.archive-success-modal/>


</x-trea-components.sidebar>
</x-trea-components.content>
