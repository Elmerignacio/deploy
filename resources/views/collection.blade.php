<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fund Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<style>
 /* Sidebar styles */
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 320px;
    height: 100%;
    transform: translateX(-100%);
    transition: transform 0.4s ease-in-out;
    will-change: transform;
    z-index: 100;
}

/* When the sidebar is opened */
.sidebar.open {
    transform: translateX(0);
}

/* Sidebar Trigger Area */
.sidebar-trigger {
    position: fixed;
    top: 0;
    left: 0;
    width: 100px;
    height: 100%;
    z-index: 50;
}

/* Content when sidebar is hidden */
.content-center {
    margin-left: 0;
    transition: margin-left 0.4s ease-in-out;
}

/* Content with sidebar */
.content-with-sidebar {
    margin-left: 320px;
    transition: margin-left 0.4s ease-in-out;
}

.cash{
    transition: all 1s;
}

.cash:hover{
  transform: scale(1.09)
}

.expense{
    transition: all 1s;
}

.expense:hover{
  transform: scale(1.09)
}

.receive{
    transition: all 1s;
}

.receive:hover{
  transform: scale(1.09)
}


</style>

<body class="bg-gray-100">
 
    <div class="grid grid-cols-[repeat(12,1fr)] grid-rows-[repeat(12,1fr)] h-[100vh] w-[100%]">
   
<!-- Sidebar -->
<aside class="sidebar col-start-1 col-end-3 row-start-2 row-end-13 mt-[85px] bg-green-900 text-white p-4">
    <!-- Profile Section -->
    
    <div class="relative">
        <div  class="w-full py-3 rounded text-left px-4 flex gap-4 items-center mt-4">
            <div class="w-10 h-10 bg-[url('https://scontent.fcgy1-3.fna.fbcdn.net/v/t1.15752-9/476576892_648669014486867_3927621611615304678_n.png?_nc_cat=107&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeFItCpz8qmXnuup9gAOpSYUzZTtUua-yWrNlO1S5r7JaiVl8xtM4UqThCpkdz0MTSGAA0f9ieExtk10B8KKfVXa&_nc_ohc=2UtHA-UnI08Q7kNvgGpTMTv&_nc_oc=Adl8rjmaAbiCOJKlj9iPHqpUP3QmbtahCLqIMwzgn5XwMSVP-81Z5ULUQyzx08H46nxQhDj7wqdpo7CJdAEnbg2H&_nc_zt=23&_nc_ht=scontent.fcgy1-3.fna&oh=03_Q7cD1wFur8UdpohB6NESdevD8qBfvbh8X_0X24oJ7JtlH--tCg&oe=6804D618')] rounded-full bg-center bg-cover"></div>
            <div>
                <p class="font-bold text-sm">JUAN DELA CRUZ</p>
            </div>
        </div>
    </div>

    
    <!-- Sidebar Menu -->
    <nav class="space-y-10 text-[19px] pt-10 flex flex-col">
        <!-- Student Balances Dropdown -->
        <div class="relative">
            <button id="StudentBalancesButton" class="w-full py-3 rounded text-left px-4 hover:bg-green-700 flex gap-4 items-center">
                <i class="fas fa-user"></i> STUDENT BALANCES
            </button>
            <div id="StudentBalancesMenu" class="absolute left-full  top-0 w-48 bg-green-800 rounded shadow-md hidden z-10">
                <a href="#" class="block px-4 py-2 hover:bg-green-700">BSIT - 1A</a>
                <a href="#" class="block px-4 py-2 hover:bg-green-700">BSIT - 1B</a>
                <a href="#" class="block px-4 py-2 hover:bg-green-700">BSIT - 2A</a>
                <a href="#" class="block px-4 py-2 hover:bg-green-700">BSIT - 2B</a>
                <a href="#" class="block px-4 py-2 hover:bg-green-700">BSIT - 3A</a>
                <a href="#" class="block px-4 py-2 hover:bg-green-700">BSIT - 3B</a>
                <a href="#" class="block px-4 py-2 hover:bg-green-700">BSIT - 4A</a>
            </div>
        </div>

        <!--Collections-->
        <div class="relative">
            <a href="collection" id="" class="w-full py-3 rounded text-left px-4 hover:bg-green-700 flex gap-4 items-center">
                <i class="fas fa-wallet"></i> COLLECTIONS
            </a>
        </div>

             <!--Payable-->
             <div class="relative">
                <a href="payableManagement" id="" class="w-full py-3 rounded text-left px-4 hover:bg-green-700 flex gap-4 items-center">
                    <i class="fas fa-money-bill-wave"></i> PAYABLE MANAGEMENT
                </a>
            </div>

            <!--Expenses-->
            <div class="relative">
                <button id="ExpenseButton" class="w-full py-3 rounded text-left px-4 hover:bg-green-700 flex gap-4 items-center">
                    <i class="fas fa-receipt"></i> EXPENSES
                </button>
                <div id="ExpenseMenu" class="absolute left-full top-0 w-48 bg-green-800 rounded shadow-md hidden z-10">
                    <a href="#" class="block px-4 py-2 hover:bg-green-700">Create Expenses</a>
                    <a href="#" class="block px-4 py-2 hover:bg-green-700">Expense History</a>
                </div>
            </div>

            <!---Reports-->
            <div class="relative">
                <a href="#" class="w-full py-3 rounded text-left px-4 hover:bg-green-700 flex gap-4 items-center">
                    <i class="fas fa-chart-line"></i> REPORTS
                </a>
            </div>

               <!--User Management-->
               <div class="relative">
                <a href="manageUser" id="" class="w-full py-3 rounded text-left px-4 hover:bg-green-700 flex gap-4 items-center">
                    <i class="fas fa-user-plus"></i> MANAGE USER
                </a>
            </div>


            <div class="relative">
                <a href="/" class="w-full py-3 rounded text-left px-4 hover:bg-red-700 flex gap-4 items-center">
                    <i class="fas fa-sign-out-alt"></i> LOGOUT
                </a>
            </div>
    </nav>
</aside>


<div class="sidebar-trigger"></div>


<script>
    //Student balance
    document.getElementById('StudentBalancesButton').addEventListener('mouseenter', function() {
        document.getElementById('StudentBalancesMenu').classList.remove('hidden');
    });

    document.getElementById('StudentBalancesButton').addEventListener('mouseleave', function() {
        document.getElementById('StudentBalancesMenu').classList.add('hidden');
    });

    document.getElementById('StudentBalancesMenu').addEventListener('mouseenter', function() {
        document.getElementById('StudentBalancesMenu').classList.remove('hidden');
    });

    document.getElementById('StudentBalancesMenu').addEventListener('mouseleave', function() {
        document.getElementById('StudentBalancesMenu').classList.add('hidden');
    });


//Collection
    document.getElementById('CollectionsButton').addEventListener('mouseenter', function() {
        document.getElementById('CollectionsMenu').classList.remove('hidden');
    });

    document.getElementById('CollectionsButton').addEventListener('mouseleave', function() {
        document.getElementById('CollectionsMenu').classList.add('hidden');
    });

    document.getElementById('CollectionsMenu').addEventListener('mouseenter', function() {
        document.getElementById('CollectionsMenu').classList.remove('hidden');
    });

    document.getElementById('CollectionsMenu').addEventListener('mouseleave', function() {
        document.getElementById('CollectionsMenu').classList.add('hidden');
    });

//Payable
    document.getElementById('PayableButton').addEventListener('mouseenter', function() {
        document.getElementById('PayableMenu').classList.remove('hidden');
    });

    document.getElementById('PayableButton').addEventListener('mouseleave', function() {
        document.getElementById('PayableMenu').classList.add('hidden');
    });

    document.getElementById('PayableMenu').addEventListener('mouseenter', function() {
        document.getElementById('PayableMenu').classList.remove('hidden');
    });

    document.getElementById('PayableMenu').addEventListener('mouseleave', function() {
        document.getElementById('PayableMenu').classList.add('hidden');
    });

    //Expense
    document.getElementById('ExpenseButton').addEventListener('mouseenter', function() {
        document.getElementById('ExpenseMenu').classList.remove('hidden');
    });

    document.getElementById('ExpenseButton').addEventListener('mouseleave', function() {
        document.getElementById('ExpenseMenu').classList.add('hidden');
    });

    document.getElementById('ExpenseMenu').addEventListener('mouseenter', function() {
        document.getElementById('ExpenseMenu').classList.remove('hidden');
    });

    document.getElementById('ExpenseMenu').addEventListener('mouseleave', function() {
        document.getElementById('ExpenseMenu').classList.add('hidden');
    });

    //UserManagement

    document.getElementById('UserManagementButton').addEventListener('mouseenter', function() {
        document.getElementById('UserManagementMenu').classList.remove('hidden');
    });

    document.getElementById('UserManagementButton').addEventListener('mouseleave', function() {
        document.getElementById('UserManagementMenu').classList.add('hidden');
    });

    document.getElementById('UserManagementMenu').addEventListener('mouseenter', function() {
        document.getElementById('UserManagementMenu').classList.remove('hidden');
    });

    document.getElementById('UserManagementMenu').addEventListener('mouseleave', function() {
        document.getElementById('UserManagementMenu').classList.add('hidden');
    });





</script>



        <!-- Header -->
        <header class=" flex justify-center items-center gap-2 text-white p-2 font-bold text-2xl col-start-1 col-end-13 row-start-1 row-end-1 
        bg-[url('https://scontent.fcgy1-3.fna.fbcdn.net/v/t1.15752-9/476890606_1033672748598390_7650911982562615150_n.png?_nc_cat=110&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeFy1_KZh_695itxUzt0_gY0RFZEy8vZy05EVkTLy9nLTlH7dbaWvxAzT7Gn6DYNsphQT9JNl5Psj4BAN--vJp2_&_nc_ohc=Nlp8mHYnHukQ7kNvgEmVncN&_nc_oc=AdlPcZBtvuJkJogsg7qzXoO9A6DFM4RO09OXkl2x2xS0JQHeQLhSreyKRxTu3gK6d5KEXq4hs1TBSjTIPhj92_bM&_nc_zt=23&_nc_ht=scontent.fcgy1-3.fna&oh=03_Q7cD1wEhuwbuutFiXH_K8ERXeBqsC-aUuZ6ippYPOcZFOX-wtg&oe=68024476')] 
        bg-cover bg-center bg-no-repeat w-full">
            
            <img class="w-[70px] h-[70px] rounded-full" src="https://scontent.fmnl13-3.fna.fbcdn.net/v/t1.15752-9/474751507_9312187378816358_8255926976147863753_n.png?_nc_cat=101&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeHNhfrQrWyumfGMaXg_vvGCmDUZr_XEvpWYNRmv9cS-ld-qxLvleocJ_LK1dDwuJsfKyOCF8IPf6xoJwz11hpXG&_nc_ohc=5pBQ3SlD48oQ7kNvgElqWc0&_nc_oc=AdnwQKQ5a2kaU2YIPj6Lac9Ce791hSq4onmzBx6XRQvF4P_4J6FTioFFp2fbIrfDHF6jaa5k09NL1sdzyuFV9dc8&_nc_zt=23&_nc_ht=scontent.fmnl13-3.fna&oh=03_Q7cD1wE1IFbRHyI2MMxUycKxRbya9GM46OiLApOkaP1cVcXpmA&oe=68023D6D" alt="">
            COLLEGE OF INFORMATION TECHNOLOGY FUND MANAGEMENT SYSTEM
        </header>
        
        <!-- Content Area -->
        <div class="max-w-screen-full mx-auto p-[50px] bg-cover bg-center bg-no-repeat w-full col-start-1 col-end-13 row-start-2 row-end-13"
        style="background-image: url('https://scontent.fcgy1-3.fna.fbcdn.net/v/t1.15752-9/476576892_648669014486867_3927621611615304678_n.png?_nc_cat=107&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeFItCpz8qmXnuup9gAOpSYUzZTtUua-yWrNlO1S5r7JaiVl8xtM4UqThCpkdz0MTSGAA0f9ieExtk10B8KKfVXa&_nc_ohc=2UtHA-UnI08Q7kNvgGpTMTv&_nc_oc=Adl8rjmaAbiCOJKlj9iPHqpUP3QmbtahCLqIMwzgn5XwMSVP-81Z5ULUQyzx08H46nxQhDj7wqdpo7CJdAEnbg2H&_nc_zt=23&_nc_ht=scontent.fcgy1-3.fna&oh=03_Q7cD1wFur8UdpohB6NESdevD8qBfvbh8X_0X24oJ7JtlH--tCg&oe=6804D618');">
        
        <div class="content-center">
            
          <!-- Header Section -->

                
          <div class="mt-4">
            <h2 class="text-2xl sm:text-3xl font-semibold text-center md:text-left">COLLECTIONS</h2>
              
              <!-- Navigation Links -->
              <div class="flex flex-col md:flex-row space-x-0 md:space-x-6 mt-4 border-b pb-2 text-sm text-center md:text-left">
                <a href="#" class="text-[17px] font-semibold text-green-700 border-b-2 border-green-700 pb-1">Payment</a>
                <a href="#" class="text-[17px] text-gray-600">Remittance</a>
            </div>
          </div>

          <!-- Search and Add User Button -->
          <div class="flex flex-col md:flex-row items-center justify-between mt-4 space-y-2 md:space-y-0">
              <div class="flex items-center border border-black rounded-lg p-2 w-full md:w-72">
                  <input type="text" placeholder="Search..." class="w-full outline-none px-2"/>
                  <button class="text-gray-500 hover:text-gray-700">
                      <i class="fa-solid fa-magnifying-glass"></i>
                  </button>
              </div>

          </div>
          <form action="saveData">
          @csrf
          <div class=" overflow-auto">
            <!-- Student Table -->
            <div class="mt-4 overflow-auto">
                <table class="w-full min-w-[600px] border border-black rounded-lg text-sm text-center">
                    <thead>
                        <tr class="bg-green-700 text-white border border-black">
                            <th class="p-2 border border-black">ID NUMBER</th>
                            <th class="p-2 border border-black">FIRSTNAME</th>
                            <th class="p-2 border border-black">LASTNAME</th>
                            <th class="p-2 border border-black">YEAR AND BLOCK</th>
                            <th class="p-2 border border-black">ROLE</th>
                            <th class="p-2 border border-black">BALANCE</th>
                        </tr>
                    </thead>
                    <tbody id="usersTableBody">
                        @php
                            $grandTotalBalance = 0; 
                        @endphp
                        @foreach ($students as $student)
                            @php
                                $totalBalance = $payables->where('student', $student->id)->sum('amount');
                                $grandTotalBalance += $totalBalance; 
                            @endphp
                            <tr class="border border-black cursor-pointer hover:bg-gray-200" 
                                onclick="handleRowClick(
                                    '{{ $student->id }}', 
                                    '{{ strtoupper($student->firstname) }} {{ strtoupper($student->lastname) }}', 
                                    '{{ strtoupper($student->yearLevel) }} - {{ strtoupper($student->block) }}'
                                )">
                                <td class="p-2 border border-black">{{ $student->id }}</td>
                                <td class="p-2 border border-black">{{ strtoupper($student->firstname) }}</td>
                                <td class="p-2 border border-black">{{ strtoupper($student->lastname) }}</td>
                                <td class="p-2 border border-black">{{ strtoupper($student->yearLevel) }} - {{ strtoupper($student->block) }}</td>
                                <td class="p-2 border border-black">{{ strtoupper($student->role) }}</td>
                                <td class="p-2 border border-black">
                                    {{ $totalBalance > 0 ? '₱' . number_format($totalBalance, 2) : '' }} 
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="font-bold">
                            <td colspan="5" class="p-2 border border-black text-center">TOTAL BALANCE:</td>
                            <td class="p-2 border border-black">{{ $grandTotalBalance > 0 ? '₱' . number_format($grandTotalBalance, 2) : 'N/A' }}</td>
                        </tr>
                    </tfoot>
                </table>
                

            
          </div>
        </div>

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
                                        <input type="number" name="amount_paid[]" class=" rounded-md p-1 w-20 amount-paid" min="0" step="0.01" oninput="updateTotals()">
                                        <input type="hidden" name="payable_id[]" value="${payable.id}">
                                        <input type="hidden" class="original-balance" value="${formattedAmount}">
                                    </td>
                                </tr>
                            `;
                            tbody.innerHTML += row;
                        });
            
                        updateTotals(); 
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
            
                const formData = new FormData(document.getElementById("paymentForm"));
            
                fetch("/save-payment", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Payment saved successfully!");
                        closeModal();
                        location.reload(); 
                    } else {
                        alert("Error: " + data.error);
                    }
                })
                .catch(error => console.error("Error saving payment:", error));
            });
            </script>
          </div>

        
      </form>

          
      </div>
      </div>
  </div>
           
     
            
    
    </div>



    <script>
      const sidebar = document.querySelector('.sidebar');
      const content = document.querySelector('.content-center');
    
      document.addEventListener('mousemove', function (event) {
        if (event.clientX <= 5) {
          sidebar.classList.add('open');
          content.classList.add('content-with-sidebar');
        }
      });
    
      sidebar.addEventListener('mouseleave', function () {
        sidebar.classList.remove('open');
        content.classList.remove('content-with-sidebar');
      });
    </script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.querySelector("input[type='text']");
            const table = document.querySelector("table");
            const tbody = table.querySelector("tbody");
            const rows = Array.from(tbody.querySelectorAll("tr"));
        
            searchInput.addEventListener("keyup", function () {
                const filter = searchInput.value.toLowerCase().trim();
                
                rows.forEach(row => {
                    let textContent = "";
                    
                    for (let i = 1; i < row.children.length - 1; i++) {
                        textContent += row.children[i].textContent.toLowerCase() + " ";
                    }
        
                    if (textContent.includes(filter)) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            });
        
        });
    </script>

 <!-- PAYMENT MODAL -->
 <div id="paymentModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
  <div class="bg-white p-6 rounded-lg shadow-lg w-[90%] max-w-4xl">
      
      <form action="/save-payment" method="POST">
          @csrf
          <input type="hidden" name="student_id" id="studentId">

          <!-- Header -->
          <div class="flex justify-between items-center pb-2">
              <h2 class="text-[25px] font-bold text-green-700">PAYMENT</h2>
              <button type="button" onclick="closeModal()" class="text-red-500 font-bold text-2xl">&times;</button>
          </div>

          <!-- User Info -->
          <div class="mt-2">
              <p id="studentName" class="text-[25px] font-bold text-green-700">SELECT A STUDENT</p>
              <p id="studentYearBlock" class="text-[19px] font-bold text-gray-600"></p>
          </div>

          <!-- Payment Table -->
          <div class="flex items-center space-x-2 mt-4">
            <input type="date" id="schoolYearFilter" class="border border-black rounded-md px-3 py-1 text-sm focus:ring-2 focus:ring-green-500">
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
                  <tbody id="payablesTableBody">
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

          <!-- Submit Button -->
          <div class="mt-4 text-center">
            <button id="submitPayment" class="px-6 py-3 bg-green-700 text-white rounded-lg font-bold">
                RECEIVE
            </button>
        </div>
      </form>

  </div>
</div>



</body>
</html>
