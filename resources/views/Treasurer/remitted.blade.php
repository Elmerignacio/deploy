<x-trea-components.layout />
<x-trea-components.header />

<x-trea-components.sidebar>
        <div class="mt-4" x-data="remittanceComponent()">
            <x-trea-components.content-header>COLLECTIONS</x-trea-components.content-header>

            <x-trea-components.nav-link>
                <a href="/treasurer/collection" class="text-[17px] text-gray-600">Payment</a>
                <a href="/treasurer/remitted" class="text-[17px] font-semibold text-green-700 border-b-2 border-green-700 pb-1">Remittance</a>
                <a href="/treasurer/CashOnHand" class="text-[17px] text-gray-600">Cash on hand</a>
            </x-trea-components.nav-link>

            <div class="flex flex-col md:flex-row overflow-auto">
                <div class="w-full md:w-1/2 overflow-auto">
                    <div class=" overflow-auto sm:mr-4 md:mr-6 lg:mr-8 xl:mr-10">
                        <div class="flex flex-col md:flex-row md:justify-between items-start mb-4 w-full">
                            <x-trea-components.sorting class="w-full md:w-auto" />
                            <x-trea-components.year-sorting class="w-full md:w-auto" />
                        </div>

                        <table class="w-full min-w-[600px] border border-black rounded-lg text-sm text-center">
                            <thead>
                                <tr class="bg-green-700 text-white border border-black">
                                    <th class="p-2 border border-black">DATE</th>
                                    <th class="p-2 border border-black">COLLECTED BY</th>
                                    <th class="p-2 border border-black">AMOUNT</th>
                                    <th class="p-2 border border-black">STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $groupedRemittances = $remittances->unique('id')->groupBy(function($remittance) {
                                        return \Carbon\Carbon::parse($remittance->date)->format('Y-m-d') . '-' . $remittance->collectedBy;
                                    });
                                @endphp
                        
                                @foreach ($groupedRemittances as $group => $remittanceGroup)
                                    @php
                                        $remittance = $remittanceGroup->first();
                                        $payableCount = $remittanceGroup->count(); 
                                        $descriptions = $remittanceGroup->pluck('description')->unique(); 
                                        
                        
                                        $totalPaid = $remittanceGroup->sum('paid');
                                        $totalCollected = $remittanceGroup->sum('amountCollected');
                                    @endphp
                        
                                    <tr class="border border-black hover:bg-gray-200 cursor-pointer"
                                        @click="openModal({
                                            id: '{{ $remittance->id }}',
                                            date: '{{ \Carbon\Carbon::parse($remittance->date)->format('F d, Y') }}',
                                            collectedBy: '{{ $remittance->collectedBy }}',
                                            totalPaid: {{ $totalPaid }},
                                            totalCollected: {{ $totalCollected }}, 
                                            payableCount: {{ $payableCount }},
                                            descriptions: @js($descriptions)
                                        })">
                                        <td class="p-2 border border-black">{{ \Carbon\Carbon::parse($remittance->date)->format('F d, Y') }}</td>
                                        <td class="p-2 border border-black">{{ $remittance->collectedBy }}</td>
                                        <td class="p-2 border border-black">
                                            {{ number_format($totalPaid + $totalCollected, 2) }}  
                                        </td>
                                        <td class="p-2 border border-black font-bold {{
                                            strtoupper($remittance->status) === 'PENDING' ? 'text-orange-600' :
                                            (strtoupper($remittance->status) === 'REMITTED' ? 'text-blue-600' : 'text-green-600') }}">
                                            {{ strtoupper($remittance->status) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            
                            
                            
                        </table>
                    </div>
                </div>
       

            
            <div 
            x-show="showModal"
            x-transition:enter="transition duration-300 transform"
            x-transition:enter-start="-translate-y-10 opacity-0"
            x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transition duration-200 transform"
            x-transition:leave-start="translate-y-0 opacity-100"
            x-transition:leave-end="-translate-y-10 opacity-0"
            class="w-full md:w-1/2 p-4 mt-[4%] bg-gray-400 bg-opacity-40 shadow-md border-green-600 border-2 relative">
            
            <div x-show="showModal" x-transition>

              <div class="flex flex-col md:flex-row items-center md:justify-between">
                <div class="mb-4 md:mb-0">
                    <p id="studentName" class="text-[25px] font-bold text-green-700" x-text="studentName"></p>
                    <p class="text-[18px]"><span x-text="collectorYearLevel + ' - ' + collectorBlock"></span></p>
                </div>
                    
                
                <div class="w-full md:w-auto overflow-x-auto flex md:text-center md:justify-end">
                    <table class="w-full border border-black shadow-lg rounded-lg"> 
                        <thead>
                            <tr class="bg-gray-800 text-white text-xs md:text-base">
                                <th class="p-2 border border-black bg-green-700">CASH ON HAND</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white text-black text-center text-sm md:text-lg font-semibold">
                                <td class="p-2 border border-black">₱0.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>

        
             
                
                <!-- Payable Table -->
                <div x-show="showPayableDetails" class="mt-4">
                    <table class="w-full text-sm text-center border border-black">
                        <thead>
                            <tr class="bg-green-700 text-white">
                                <th class="p-2 border border-black">Description</th>
                                <th class="p-2 border border-black">Amount</th>
                                <th class="p-2 border border-black">Amount Paid</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="desc in descriptions" :key="desc">
                                <tr class="cursor-pointer hover:bg-green-100" @click="fetchStudents(desc)">
                                    <td class="p-2 border border-black" x-text="desc"></td>
                                    <td class="p-2 border border-black" x-text="getBalance(desc)"></td>
                                    <td class="p-2 border border-black" x-text="getPaid(desc)"></td>
                                </tr>
                            </template>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="p-2 border border-black font-bold" colspan="2">Total</td>
                                <td class="p-2 border border-black font-bold" x-text="getTotalPaid()"></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="mt-4 text-left">
                        <button 
                            class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-md transition duration-200"
                            @click="receiveCash"
                        >
                            Receive
                        </button>                       
                    </div>
                </div>
            </div>
        </div>
        

<style>
@keyframes checkmark {
0% { opacity: 0; transform: scale(0.5); }
100% { opacity: 1; transform: scale(1); }
}

.checkmark-animate {
animation: checkmark 0.3s ease-out forwards;
}
</style>

    
            <div x-show="showStudentListModal" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-1/2" @click.stop>
                    <h2 class="text-xl font-bold mb-4">Students Who Paid: <span x-text="selectedDescription"></span></h2>
                    <p class="mb-2"><strong>Date:</strong> <span x-text="selectedDate"></span></p>

                    <table class="w-full text-sm text-center border border-black">
                        <thead>
                            <tr class="bg-green-700 text-white">
                                <th class="p-2 border border-black">Name</th>
                                <th class="p-2 border border-black">Description</th>
                                <th class="p-2 border border-black">Amount Paid</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="student in studentList" :key="student.firstname + student.lastname">
                                <tr>
                                    <td class="p-2 border border-black" x-text="student.firstname + ' ' + student.lastname"></td>
                                    <td class="p-2 border border-black" x-text="selectedDescription"></td>
                                    <td class="p-2 border border-black" x-text="parseFloat(student.paid).toFixed(2)"></td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                    <button @click="showStudentListModal = false" class="mt-4 px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Close</button>
                </div>
            </div>
        </div>

        

</x-trea-components.sidebar>

<script>
    function remittanceComponent() {
        return {
            selectedId: null,
            selectedDate: '',
            selectedDateForRequest: '',
            studentName: '',
            totalAmount: 0,
            payableCount: 0,
            showModal: false,
            showPayableDetails: false,
            showStudentListModal: false,
            selectedDescription: '',
            studentList: [],
            descriptions: [],
            balances: @json($balances),
            paids: @json($paids),
            collectors: @json($collectors), 
            collectorRole: '',
            collectorYearLevel: '',
            collectorBlock: '',
            collectorDate: '',

            openModal(data) {
                this.selectedId = data.id;
                this.selectedDate = data.date;
                this.selectedDateForRequest = this.formatDateForRequest(data.date);
                this.studentName = data.collectedBy;
                this.totalAmount = data.totalAmount;
                this.payableCount = data.payableCount;
                this.descriptions = data.descriptions;
                this.showModal = true;
                this.showPayableDetails = true;

                const [firstname, lastname] = data.collectedBy.split(' ');
                const collector = this.collectors.find(c =>
                    c.firstname === firstname && c.lastname === lastname
                );

                if (collector) {
                    this.collectorRole = collector.role;
                    this.collectorYearLevel = collector.yearLevel;
                    this.collectorBlock = collector.block;
                    this.collectorDate = collector.date;
                } else {
                    this.collectorRole = 'N/A';
                    this.collectorYearLevel = 'N/A';
                    this.collectorBlock = 'N/A';
                }
            },
            getBalance(desc) {
                const match = this.balances.find(b =>
                    b.description === desc &&
                    b.yearLevel === this.collectorYearLevel &&
                    b.block === this.collectorBlock
                );
                return match ? parseFloat(match.balance).toFixed(2) : '0.00';
            },

            getPaid(desc) {
                const matchingPaids = this.paids.filter(b =>
                b.description === desc &&
                b.yearLevel === this.collectorYearLevel &&
                b.block === this.collectorBlock &&
                b.date === this.selectedDateForRequest &&
                b.status === (this.collectorRole === 'REPRESENTATIVE' ? 'PENDING' : 'REMITTED')
            );
            return matchingPaids.reduce((total, paid) => total + parseFloat(paid.paid), 0).toFixed(2);
            },

            getTotalPaid() {
            let totalPaid = 0;
            this.descriptions.forEach(desc => {
                totalPaid += parseFloat(this.getPaid(desc));
            });
            return totalPaid.toFixed(2);
        },
        

            fetchStudents(description) {
                this.selectedDescription = description;
                this.studentList = [];

                fetch(`/remitted/students?date=${this.selectedDateForRequest}&collectedBy=${this.studentName}&description=${encodeURIComponent(description)}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.length > 0) {
                            this.studentList = data;
                            this.showStudentListModal = true;
                        } else {
                            alert('No students found for this description.');
                        }
                    })
                    .catch(err => {
                        alert('Failed to fetch student list');
                        console.error(err);
                    });
            },

            formatDateForRequest(date) {
                const dateObj = new Date(date);
                return `${dateObj.getFullYear()}-${String(dateObj.getMonth() + 1).padStart(2, '0')}-${String(dateObj.getDate()).padStart(2, '0')}`;
            }
        };
    }
</script>