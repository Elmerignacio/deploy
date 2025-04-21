
<!-- Modal Denomination -->
<div id="DenominationModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-green-800 text-white rounded-lg shadow-xl w-full max-w-xl relative">
        <div id="modalHeader" class="p-4 border-b border-white flex justify-between">
            <div id="selectedDate" class="font-bold text-lg bg-green-900 px-3 py-1 rounded"></div>
            <div class="font-bold text-lg bg-green-900 px-3 py-1 rounded" x-text="'Total amount: ₱' + getTotalPaid()"></div>
            <button id="closeModalButton" class="text-white text-xl">&times;</button>
        </div>

        <div class="bg-white text-black px-6 py-4 overflow-auto">
            <form action="{{ route('denomination.store') }}" method="POST">
                
                
               
          
                <input type="hidden" id="selectedDatesInput" name="selectedDates" value="2025-04-09">

                <input type="hidden" name="date" id="hiddenDateInput">

                <table class="w-full table-auto border border-black text-center">
                    <thead class="bg-green-700 text-white">
                        <tr>
                            <th class="py-2 px-3 border border-black">DENOMINATION</th>
                            <th class="py-2 px-3 border border-black">QTY</th>
                            <th class="py-2 px-3 border border-black">AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody id="denominationRows">
                    </tbody>
                    <tr class="bg-green-700 text-white font-bold">
                        <td class="py-2 px-3 border border-black">TOTAL</td>
                        <td class="border border-black"></td>
                        <td id="totalAmountCell" class="border border-black">₱0.00</td>
                    </tr>
                </table>

                <div class="mt-4">
                    <button type="button" id="confirm" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-md cursor-pointer" 
                    title="Select at least one student to enable">
                    CONFIRM
                </button>
                
                </div>
       
        </div>
    </div>
</div>
@csrf
<div id="archiveModalMale" class="fixed inset-0 flex items-center justify-center bg-white/60 z-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96 h-[40%] border-2 border-green-700 flex flex-col justify-center">
        <div class="flex flex-col items-center">
            <img class="w-[38%] h-[100%] mb-10" src="https://scontent.fmnl13-3.fna.fbcdn.net/v/t1.15752-9/489814149_1468467140599131_6960946035468336908_n.png?_nc_cat=100&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeF0tEk91O1wcWsNSxqNyXlhdHHakCrBmtp0cdqQKsGa2tz0m5fjMsSEqbMPPDlr18rjA5m4XhOlohgr17sJqjrl&_nc_ohc=U4FmyU0N2kwQ7kNvwHD651_&_nc_oc=Admm1tNp9mdPCrUpq8Pc6Vsam0oFOgrZJhL5o1vsHFmvtID0G3TIRBYgx8QUGkJIsYnNJDJmzQ4nnj7iAgzqaq7D&_nc_zt=23&_nc_ht=scontent.fmnl13-3.fna&oh=03_Q7cD2AGx9A72XdmV0wy9qFR7DB6e__2IpkprmH7YkwpIy_FOvQ&oe=681FD52E"
            alt="Male Image">
            <p class="text-green-600 text-center font-semibold">Are you sure you want to confirm this remittance? This action cannot be undone.</p>   
            <div class="flex mt-10 space-x-4">
                <button type="button" class="cancelBtn bg-red-600 text-white px-4 py-2 rounded-lg shadow hover:bg-red-700 transition">CANCEL</button>
                <button type="button" class="confirmBtn bg-green-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-green-700">CONFIRM</button>
            </div>
        </div>
    </div>
</div>

<div id="successModalMale" class="fixed inset-0 flex items-center justify-center bg-white/60 z-50 hidden">
    <div class="relative bg-white p-6 rounded-lg shadow-lg w-96 h-[40%] border-2 border-green-700 flex flex-col justify-center">
        <div class="flex flex-col items-center">
            <img class="w-[38%] h-auto mb-10" src="https://scontent.fmnl13-3.fna.fbcdn.net/v/t1.15752-9/489814149_1468467140599131_6960946035468336908_n.png?_nc_cat=100&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeF0tEk91O1wcWsNSxqNyXlhdHHakCrBmtp0cdqQKsGa2tz0m5fjMsSEqbMPPDlr18rjA5m4XhOlohgr17sJqjrl&_nc_ohc=U4FmyU0N2kwQ7kNvwHD651_&_nc_oc=Admm1tNp9mdPCrUpq8Pc6Vsam0oFOgrZJhL5o1vsHFmvtID0G3TIRBYgx8QUGkJIsYnNJDJmzQ4nnj7iAgzqaq7D&_nc_zt=23&_nc_ht=scontent.fmnl13-3.fna&oh=03_Q7cD2AGx9A72XdmV0wy9qFR7DB6e__2IpkprmH7YkwpIy_FOvQ&oe=681FD52E"
             alt="Archive Box" class="w-16 h-16 mb-4">
            
            <p class="text-green-600 text-center font-semibold">Remittance is now pending and ready for treasurer review. </p>   
            <div class="flex mt-10 space-x-4">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-green-700">
                    CONFIRM
                </button>
            </div>
        </div>
    </div>
</div>
</form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dateInput = document.getElementById('selectedyear');
        const remitButton = document.getElementById('remitButton');
        const hiddenDateInput = document.getElementById('hiddenDateInput');
        const confirmButton = document.getElementById('confirm');

        confirmButton.disabled = true; 
        confirmButton.title = "Select at least one student to enable"; 
        confirmButton.classList.add('cursor-not-allowed');

        const denominations = [
            { value: 1000, name: 'thousand' },
            { value: 500, name: 'five_hundred' },
            { value: 200, name: 'two_hundred' },
            { value: 100, name: 'one_hundred' },
            { value: 50, name: 'fifty' },
            { value: 20, name: 'twenty' },
            { value: 10, name: 'ten' },
            { value: 5, name: 'five' },
            { value: 1, name: 'one' },
            { value: 0.25, name: 'twenty_five_cents' }
        ];

        function formatDate(dateString) {
            const date = new Date(dateString);
            const options = { year: 'numeric', month: 'long', day: '2-digit' };
            return date.toLocaleDateString('en-US', options);
        }

        remitButton.addEventListener('click', function () {
            const selectedDate = dateInput.value;
            if (!selectedDate) {
                dateInput.style.borderColor = 'orange';
                return;
            }

            const formattedDate = formatDate(selectedDate);
            hiddenDateInput.value = selectedDate;
            document.getElementById('selectedDate').innerText = 'Date: ' + formattedDate;

            const rows = denominations.map(d => `
                <tr>
                    <td class="py-2 px-3 border border-black">₱${d.value.toFixed(2)}</td>
                    <td class="border border-black">
                        <input type="number" name="${d.name}" class="w-20 p-1" min="0" data-denomination="${d.value}">
                    </td>
                    <td class="border border-black" data-amount="0">₱0.00</td>
                </tr>
            `).join('');
            document.getElementById('denominationRows').innerHTML = rows;

            confirmButton.disabled = true; 
            confirmButton.title = "Select at least one student to enable"; 
            confirmButton.classList.add('cursor-not-allowed'); 
            document.getElementById('DenominationModal').classList.remove('hidden');
        });

        document.getElementById('closeModalButton').addEventListener('click', function () {
            document.getElementById('DenominationModal').classList.add('hidden');
        });

        document.getElementById('DenominationModal').addEventListener('input', function (e) {
            if (e.target.matches('input[type="number"]')) {
                const denom = parseFloat(e.target.dataset.denomination);
                const qty = parseInt(e.target.value) || 0;
                const amt = denom * qty;
                e.target.closest('tr').querySelector('td[data-amount]').innerText = '₱' + amt.toFixed(2);
                updateTotalAmount();
                checkIfAnyQtyInput(); 
            }
        });

        function updateTotalAmount() {
            const totalCells = document.querySelectorAll('td[data-amount]');
            let total = 0;
            totalCells.forEach(cell => {
                total += parseFloat(cell.innerText.replace('₱', '')) || 0;
            });
            document.getElementById('totalAmountCell').innerText = '₱' + total.toFixed(2);
        }

        function checkIfAnyQtyInput() {
            const inputs = document.querySelectorAll('#denominationRows input[type="number"]');
            let hasValue = false;
            inputs.forEach(input => {
                if (parseInt(input.value) > 0) {
                    hasValue = true;
                }
            });
            confirmButton.disabled = !hasValue;

            if (confirmButton.disabled) {
                confirmButton.classList.add('cursor-not-allowed'); 
                confirmButton.title = "Select at least one student to enable";
            } else {
                confirmButton.classList.remove('cursor-not-allowed'); 
                confirmButton.classList.add('cursor-pointer'); 
                confirmButton.title = "";
            }
        }
    });
</script>