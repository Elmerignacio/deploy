<x-trea-components.layout/>
<x-trea-components.header/>
<x-trea-components.content>
<x-trea-components.sidebar>


    <div class="mt-3">
        <x-trea-components.content-header>MANAGE USER</x-trea-components.content-header>
        
        <x-trea-components.nav-link class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
            <a href="manageUser" class="text-[17px] font-semibold text-green-700 border-b-2 border-green-700 pb-1">Active</a>
            <a href="archiveUser" class="text-[17px] text-gray-600">Archive</a>
        </x-trea-components.nav-link>
             
        <x-trea-components.sorting class="mt-4">
            <a href="#" onclick="openModal()" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-green-700">
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


<form action="">
    @csrf
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
        <div class="w-full md:w-1/2 overflow-auto">
            <div class="mt-4 overflow-auto sm:mr-4 md:mr-6 lg:mr-8 xl:mr-10">
                <table class="w-full min-w-[600px] border border-black rounded-lg text-sm text-center">
                    <thead>
                        <tr class="bg-green-700 text-white border border-black text-sm sm:text-base">
                            <th class="p-2 border border-black"><input type="checkbox" id="selectAll"></th>
                            <th class="p-2 border border-black">ID NUMBER</th>
                            <th class="p-2 border border-black">FIRSTNAME</th>
                            <th class="p-2 border border-black">LASTNAME</th>
                            <th class="p-2 border border-black">YEAR & BLOCK</th>
                        </tr>
                    </thead>
                    <tbody id="usersTableBody">
                        @foreach ($students as $student)
                        <tr class="border border-black cursor-pointer text-sm sm:text-base"
                        @click="selectUser({ 
                            id: '{{ $student->IDNumber }}', 
                            name: '{{ strtoupper($student->firstname) }} {{ strtoupper($student->lastname) }}',
                            yearLevel: '{{ strtoupper($student->yearLevel) }}',
                            block: '{{ strtoupper($student->block) }}',
                            gender: '{{ ucfirst(strtolower($student->gender)) }}',  
                            description: '', 
                            amount: '', 
                            dueDate: '' 
                        })">
                    
                            <td class="p-2 border border-black">
                                <input type="checkbox" name="students[]" value="{{ $student->IDNumber }}" class="rowCheckbox">
                            </td>
                            <td class="p-2 border border-black">{{ $student->IDNumber }}</td>
                            <td class="p-2 border border-black">{{ strtoupper($student->firstname) }}</td>
                            <td class="p-2 border border-black">{{ strtoupper($student->lastname) }}</td>
                            <td class="p-2 border border-black">{{ strtoupper($student->yearLevel) }} - {{ strtoupper($student->block) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>     
                <div class="mt-4 flex justify-end">
                    <button id="archiveBtn" class="bg-gray-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed" disabled title="Select at least one student to enable">
                        Archive
                    </button>
                </div> 
            </div>
        </div>
</form>



<x-trea-components.create-users/>
    
<x-trea-components.modify-modal/>
<x-trea-components.archive-modal/>
<x-trea-components.archive-success-modal/>


</x-trea-components.sidebar>




</x-trea-components.content>