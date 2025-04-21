
                  <div 
                    x-show="showDetails"
                    x-transition:enter="transition duration-300 transform"
                    x-transition:enter-start="-translate-y-10 opacity-0"
                    x-transition:enter-end="translate-y-0 opacity-100"
                    x-transition:leave="transition duration-200 transform"
                    x-transition:leave-start="translate-y-0 opacity-100"
                    x-transition:leave-end="-translate-y-10 opacity-0"
                    class="w-full md:w-1/2 p-4 mt-4 bg-gray-400 bg-opacity-40 hadow-md border-green-600 border-2 relative"

                  >
                
                  <div 
                  x-show="showDetails"
                  x-transition
                >
                <form id="paymentForm" action="{{ route('repre.payment') }}" method="POST">

                    @csrf
                    <input type="hidden" name="student_id" id="studentId" x-model="studentId">

                    <div>
                      <p id="studentName" class="text-[25px] font-bold text-green-700" x-text="studentName">SELECT A STUDENT</p>
                      <p id="studentYearBlock" class="text-[19px] font-bold text-gray-600" x-text="studentYearBlock"></p>
                    </div>
                
                    <div class="flex items-center space-x-2 mt-4">
                      <input type="date" id="schoolYearFilter" name="date" class="border border-black rounded-md px-3 py-1 text-sm focus:ring-2 focus:ring-green-500" required>
                    </div>
                
                    <div class="mt-2">
                      <table class="w-full border border-black text-center text-sm">
                        <thead>
                          <tr class="bg-green-700 text-white">
                            <th class="p-2 border border-black">DESCRIPTION</th>
                            <th class="p-2 border border-black">REMAINING BALANCE</th>
                            <th class="p-2 border border-black">AMOUNT PAID</th>
                          </tr>
                        </thead>
                        <tbody class="bg-white" id="payablesTableBody">
                        </tbody>
                        <tfoot>
                          <tr class="bg-white font-bold">
                            <td class="p-2 border border-black">TOTAL</td>
                            <td class="p-2 border border-black" id="totalRemaining">₱0.00</td>
                            <td class="p-2 border border-black" id="totalAmountPaid">₱0.00</td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                
                    <div class="mt-4">
                      <button type="submit" class="px-6 py-3 bg-green-700 text-white rounded-lg font-bold">
                        RECEIVE
                      </button>
                    </div>
                  </form>
                </div>

                  </div>
              

              <script>
            function collectionsApp() {
                return {
                    showDetails: false,
                    studentName: '',
                    studentYearBlock: '',
                    studentId: '',

                    handleClick(studentId, name, yearBlock) {
                    this.studentName = name;
                    this.studentYearBlock = yearBlock;
                    this.studentId = studentId;
                    this.showDetails = true;

                    handleRowClick(studentId, name, yearBlock);
                    }
                }
                }

              </script>
              
              
              
              

  <script>
  document.addEventListener("DOMContentLoaded", function () {
      const archiveModal = document.getElementById("archiveModalMale");
      const successModal = document.getElementById("successModalMale");        
      const confirmButton = archiveModal.querySelector(".confirmBtn");
      const cancelButton = archiveModal.querySelector(".cancelBtn");
      const successConfirmButton = successModal.querySelector("button[type='submit']");
  
  
      confirmButton.addEventListener("click", function () {
          successModalMale.classList.add("hidden");
      });
  
  
      confirmButton.addEventListener("click", function () {
          archiveModalMale.classList.add("hidden");
          successModalMale.classList.remove("hidden");
      });
  
      
  
      cancelButton.addEventListener("click", function () {
          archiveModal.classList.add("hidden");
      });
  
      successConfirmButton.addEventListener("click", function () {
          successModal.classList.add("hidden");
      });
  });
  </script>
  
  <style>
  @keyframes checkmark {
      0% { opacity: 0; transform: scale(0.5); }
      100% { opacity: 1; transform: scale(1); }
  }
  
  .checkmark-animate {
      animation: checkmark 0.3s ease-out forwards;
  }
  </style>

<script>
    function handleRowClick(studentId, fullName, yearBlock) {
    console.log("Row clicked! Student ID:", studentId);

    document.getElementById("studentName").textContent = fullName;
    document.getElementById("studentYearBlock").textContent = yearBlock;
    document.getElementById("studentId").value = studentId; 

    fetch(`/get-student-payables/${studentId}`)
        .then(response => response.json())
        .then(data => {
            console.log("Payables Data:", data);
            const tbody = document.getElementById("payablesTableBody");
            tbody.innerHTML = "";

            const remainingPayables = data.filter(payable => parseFloat(payable.amount) > 0);

            if (remainingPayables.length > 0) {
                remainingPayables.forEach(payable => {
                    let formattedAmount = parseFloat(payable.amount).toFixed(2);

                    const row = `
                        <tr>
                            <td class="p-2 border border-black">${payable.description}</td>
                            <td class="p-2 border border-black remaining-balance">₱${formattedAmount}</td>
                            <td class="p-2 border border-black">
                                <input type="number" name="amount_paid[]" class="rounded-md p-1 w-20 amount-paid" min="0" step="0.01" oninput="updateTotals(); checkPaymentInputs();">
                                <input type="hidden" name="payable_id[]" value="${payable.id}">
                                <input type="hidden" class="original-balance" value="${formattedAmount}">
                            </td>
                        </tr>
                    `;
                    tbody.innerHTML += row;
                });

                updateTotals();
                checkPaymentInputs(); 
            } else {
                tbody.innerHTML = `<tr><td colspan="3" class="p-2 border border-black text-red-500">No remaining balances</td></tr>`;
            }
        })
        .catch(error => console.error("Error fetching student payables:", error));

    document.getElementById("paymentModal").classList.remove("hidden");
}

function updateTotals() {
    let totalRemaining = 0;
    let totalPaid = 0;

    document.querySelectorAll(".amount-paid").forEach((input, index) => {
        let originalBalance = parseFloat(document.querySelectorAll(".original-balance")[index].value);
        let paidAmount = parseFloat(input.value) || 0;
        let newBalance = originalBalance - paidAmount;

        if (newBalance < 0) {
            input.value = originalBalance; 
            newBalance = 0;
        }

        document.querySelectorAll(".remaining-balance")[index].textContent = `₱${newBalance.toFixed(2)}`;

        totalRemaining += newBalance;
        totalPaid += paidAmount;
    });

    document.getElementById("totalRemaining").textContent = `₱${totalRemaining.toFixed(2)}`;
    document.getElementById("totalAmountPaid").textContent = `₱${totalPaid.toFixed(2)}`;
}

function closeModal() {
    document.getElementById("paymentModal").classList.add("hidden");
}

document.getElementById("submitPayment").addEventListener("click", function (event) {
    event.preventDefault();

    const dateInput = document.getElementById("schoolYearFilter").value;

    if (!dateInput) {
        alert("Please select a date before submitting!");
        return;
    }

    const formData = new FormData(document.getElementById("paymentForm"));
    formData.append("date", dateInput);

    fetch("/save-payment", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Payment saved successfully!");

            const studentId = document.getElementById("studentId").value;
            fetch(`/get-student-payables/${studentId}`)
                .then(response => response.json())
                .then(updatedData => {
                    const tbody = document.getElementById("payablesTableBody");
                    tbody.innerHTML = "";

                    updatedData.forEach(payable => {
                        let formattedAmount = parseFloat(payable.amount).toFixed(2);

                        const row = `
                            <tr>
                                <td class="p-2 border border-black">${payable.description}</td>
                                <td class="p-2 border border-black remaining-balance">₱${formattedAmount}</td>
                                <td class="p-2 border border-black">
                                    <input type="number" name="amount_paid[]" class="rounded-md p-1 w-20 amount-paid" min="0" step="0.01" oninput="updateTotals(); checkPaymentInputs();">
                                    <input type="hidden" name="payable_id[]" value="${payable.id}">
                                    <input type="hidden" class="original-balance" value="${formattedAmount}">
                                </td>
                            </tr>
                        `;
                        tbody.innerHTML += row;
                    });

                    updateTotals();
                    checkPaymentInputs();
                })
                .catch(error => console.error("Error fetching updated payables:", error));

        } else {
            alert("Error: " + data.error);
        }
    })
    .catch(error => console.error("Error saving payment:", error));
});

function checkPaymentInputs() {
    let hasPayment = false;

    document.querySelectorAll(".amount-paid").forEach(input => {
        if (parseFloat(input.value) > 0) {
            hasPayment = true;
        }
    });

    document.getElementById("submitPayment").disabled = !hasPayment;
}

document.getElementById("paymentModal").addEventListener("input", function () {
    checkPaymentInputs();
});

</script>



