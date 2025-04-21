<x-trea-components.layout/>
<x-trea-components.header/>
<x-trea-components.content>
<x-trea-components.sidebar :profile="$profile"  :firstname="$firstname" :lastname="$lastname">

            <div class="mt-4">
            <x-trea-components.content-header>PAYABLE MANAGEMENT</x-trea-components.content-header>
                
            <x-trea-components.year-sorting/>

           <x-trea-components.sorting>
            <a href="#" onclick="openModal()" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-green-700">
              Add Expense <i class="fas fa-plus"></i>
            </a>
           </x-trea-components.sorting>
                
 
     <div class="flex flex-col md:flex-row">
        <div class="w-full md:w-1/2 overflow-auto">
            <div class="mt-4 overflow-auto sm:mr-4 md:mr-6 lg:mr-8 xl:mr-10">

              <table class="w-full min-w-[600px] border border-black rounded-lg text-sm text-center">
                <thead>
                    <tr class="bg-white border border-black">
                        <th class="p-2 border border-black">DATE</th>
                        <th class="p-2 border border-black bg-green-600 text-white">FUND ALLOCATION</th>
                        <th class="p-2 border border-black bg-red-700 text-white">AMOUNT</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($groupedExpenses as $date => $expensesForDate)
                      <tr class="cursor-pointer hover:bg-gray-200 transition" onclick="showModal('{{ \Carbon\Carbon::parse($date)->format('M d, Y') }}', '{{ $expensesForDate->first()->source }}', '{{ $expensesForDate->sum('amount') }}')">
                          <td class="p-2 border border-black">
                              {{ \Carbon\Carbon::parse($date)->format('M d, Y') }}
                          </td>
                          <td class="p-2 border border-black">
                              {{ $expensesForDate->first()->source }}
                          </td>
                          <td class="p-2 border border-black">
                              {{ $expensesForDate->sum('amount') }}
                          </td>
                      </tr>
                  @endforeach
              </tbody>
              
              <tfoot>
                  <tr>
                      <td colspan="2" class="p-2 border border-black text-center"><strong>Total Amount</strong></td>
                      <td class="p-2 border border-black font-bold">
             
                          {{ $groupedExpenses->flatten()->sum('amount') }}
                      </td>
                  </tr>
              </tfoot>
            </table>
            
            </div>
        </div>
     </div> 
     

    

      
        <div  id="expenseModal"  class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
          <div class="bg-green-900 rounded-xl w-[900px] p-6 relative text-white shadow-2xl ">
            
            <button onclick="closeModal()" class="absolute top-4 right-4 text-white text-2xl hover:text-red-400 font-bold">
              &times;
            </button>
        
      
            <h2 class="text-2xl font-bold text-center mb-6">CREATE EXPENSES</h2>

            <form method="POST" action="{{ route('expenses.store') }}">
              @csrf
            
              <div class="flex justify-between items-center">
                <div class="flex-1 mb-3">
                  <select id="descriptionSelect" name="description" class="border w-[40%] h-9 border-black rounded-md px-3 py-1 text-black" required>
                    <option value="" disabled selected>Select Description</option>
                    @foreach($descriptions as $desc)
                      <option value="{{ $desc }}">{{ $desc }}</option>
                    @endforeach
                  </select>
            
                  <div class="flex items-center space-x-2 mt-2 text-black">
                    <input type="date" id="selectedyear" name="date" class="w-[40%] h-9 border border-black rounded-md px-3 py-1 text-sm" required>
                  </div>
                </div>
            
                <div class="flex justify-end">
                  <div class="text-lg text-left">
                    <p class="font-bold text-lg" id="availableBalance">Available Balance: ₱0.00</p>
                    <p class="font-bold" id="totalExpenses">Total Expenses: ₱0.00</p>
                  </div>
                </div>
              </div>
            
    
              <div class="relative border-white">
                <table id="table" class="w-full min-w-[600px] border border-black rounded-lg text-sm text-center">
                  <thead>
                    <tr class="bg-white text-black border border-black">
                      <th class="p-2 border border-black bg-white">DESCRIPTION</th>
                      <th class="p-2 border border-black bg-white">QTY</th>
                      <th class="p-2 border border-black bg-white">LABEL</th>
                      <th class="p-2 border border-black bg-white">PRICE</th>
                      <th class="p-2 border border-black bg-white">AMOUNT</th>
                    </tr>
                  </thead>
                  <tbody id="tableBody">
                    <tr class="bg-white text-black">
                      <td class="p-2 border border-black"><input type="text" name="items[0][description]" class="w-full p-1" required /></td>
                      <td class="p-2 border border-black"><input type="number" name="items[0][quantity]" class="w-full p-1 qty" required /></td>
                      <td class="p-2 border border-black"><input type="text" name="items[0][label]" class="w-full p-1" required /></td>
                      <td class="p-2 border border-black"><input type="number" step="0.01" name="items[0][price]" class="w-full p-1 price" required /></td>
                      <td class="p-2 border border-black"><input type="number" step="0.01" name="items[0][amount]" class="w-full p-1 amount" readonly /></td>
                    </tr>
                  </tbody>
                </table>
            
                <div class="absolute left-[100%] translate-x-[-60%] bottom-[-14px] flex flex-col">
                  <button type="button" id="addRowButton" class="bg-green-600 hover:bg-green-700 w-6 h-6 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg  border-green-600">+</button>
                </div>
              </div>
            
              <div class="mt-4 flex justify-center">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow border border-green-600">DISBURSE</button>
              </div>
            </form>
            
            <script>
              const paidData = @json($paidData); 
              let rowIndex = 1;
            
              document.getElementById('descriptionSelect').addEventListener('change', function () {
                const selected = this.value;
                const paid = paidData[selected] || 0;
                document.getElementById('availableBalance').textContent = 'Available Balance: ₱' + Number(paid).toLocaleString(undefined, { minimumFractionDigits: 2 });
                updateTotalExpenses(); 
              });
            
              function updateAmounts() {
                let total = 0;
                document.querySelectorAll('#table tbody tr').forEach(row => {
                  const qty = parseFloat(row.querySelector('.qty')?.value) || 0;
                  const price = parseFloat(row.querySelector('.price')?.value) || 0;
                  const amount = qty * price;
                  row.querySelector('.amount').value = amount.toFixed(2);
                  total += amount;
                });
                document.getElementById('totalExpenses').textContent = 'Total Expenses: ₱' + total.toFixed(2);
              }
            
              document.getElementById('tableBody').addEventListener('input', function (e) {
                if (e.target.classList.contains('qty') || e.target.classList.contains('price')) {
                  updateAmounts();
                }
              });
            
              document.getElementById('addRowButton').addEventListener('click', () => {
                const tbody = document.getElementById('tableBody');
                const newRow = document.createElement('tr');
                newRow.classList.add('bg-white', 'text-black');
            
                newRow.innerHTML = `
                  <td class="p-2 border border-black"><input type="text" name="items[${rowIndex}][description]" class="w-full p-1" required /></td>
                  <td class="p-2 border border-black"><input type="number" name="items[${rowIndex}][quantity]" class="w-full p-1 qty" required /></td>
                  <td class="p-2 border border-black"><input type="text" name="items[${rowIndex}][label]" class="w-full p-1" required /></td>
                  <td class="p-2 border border-black"><input type="number" step="0.01" name="items[${rowIndex}][price]" class="w-full p-1 price" required /></td>
                  <td class="p-2 border border-black"><input type="number" step="0.01" name="items[${rowIndex}][amount]" class="w-full p-1 amount" readonly /></td>
                `;
                rowIndex++;
                tbody.appendChild(newRow);
                updateAmounts(); 
              });
            </script>
            
    

<script>
  // Function to auto-compute amount
  document.querySelectorAll('#table tbody tr').forEach(function (row) {
    const qtyInput = row.querySelector('.qty');
    const priceInput = row.querySelector('.price');
    const amountInput = row.querySelector('.amount');

    function computeAmount() {
      const qty = parseFloat(qtyInput.value) || 0;
      const price = parseFloat(priceInput.value) || 0;
      const amount = qty * price;
      amountInput.value = amount.toFixed(2);
    }

    qtyInput.addEventListener('input', computeAmount);
    priceInput.addEventListener('input', computeAmount);
  });
</script>


<script>
  function openModal() {
    document.getElementById("expenseModal").classList.remove("hidden");
  }

  function closeModal() {
    document.getElementById("expenseModal").classList.add("hidden");
  }

  window.onclick = function(event) {
    const modal = document.getElementById("expenseModal");
    if (event.target === modal) {
      closeModal();
    }
  }
</script>





<x-trea-components.update-payable/>
       

</x-trea-components.sidebar>

</x-trea-components.content>  

