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
    #archiveMessage, #successMessage{
    z-index: 9999; /* Pinakataas nga layer */
}
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
                <h2 class="text-2xl sm:text-3xl font-semibold text-center md:text-left">MANAGE USER</h2>
                
                <!-- Navigation Links -->
                <div class="flex flex-col md:flex-row space-x-0 md:space-x-6 mt-4 border-b pb-2 text-sm text-center md:text-left">
                    <a href="manageUser" class="text-[17px] font-semibold text-green-700 border-b-2 border-green-700 pb-1">Active</a>
                    <a href="archiveUser" class="text-[17px] text-gray-600">Archieve</a>
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
                
                <a href="createUser" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-green-700">
                    Add Users <i class="fas fa-plus"></i>
                </a>
            </div>
            <form action="saveData">
            @csrf
            <div class="mt-4 overflow-auto">
                <table class="w-full min-w-[600px] border border-black rounded-lg text-sm text-center">
                    <thead>
                        <tr class="bg-green-700 text-white border border-black">
                            <th class="p-2 border border-black"><input type="checkbox" id="selectAll"></th>
                            <th class="p-2 border border-black">ID NUMBER</th>
                            <th class="p-2 border border-black">FIRSTNAME</th>
                            <th class="p-2 border border-black">LASTNAME</th>
                            <th class="p-2 border border-black">YEAR AND BLOCK</th>
                            <th class="p-2 border border-black">ROLE</th>
                            <th class="p-2 border border-black">STATUS</th>
                            <th class="p-2 border border-black notClickable">ACTION</th>
                        </tr>
                    </thead>
                    <tbody id="usersTableBody">
                        @foreach ($students as $student)
                        <tr class="border border-black cursor-pointer" onclick="toggleCheckbox(event, this)">
                            <td class="p-2 border border-black">
                                <input type="checkbox" name="students[]" value="{{ $student->id }}" class="rowCheckbox">
                            </td>
                            <td class="p-2 border border-black">{{ $student->id }}</td>
                            <td class="p-2 border border-black">{{ strtoupper($student->firstname) }}</td>
                            <td class="p-2 border border-black">{{ strtoupper($student->lastname) }}</td>
                            <td class="p-2 border border-black">{{ strtoupper($student->yearLevel) }} - {{ strtoupper($student->block) }}</td>
                            <td class="p-2 border border-black">{{ strtoupper($student->role) }}</td>
                            <td class="p-2 border border-black">ACTIVE</td>
                            <td class="p-2 border border-black notClickable">
                                <a href="#" class="edit-user-btn text-blue-700 px-2 py-1 rounded">EDIT</a>

                                <a href="#" class="text-red-700 px-2 py-1 rounded">DELETE</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4 flex space-x-3 justify-right">
                <button id="archiveBtn" class="bg-gray-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed" disabled title="Select at least one student to enable">
                    Archive
                </button>
                
            </div>  
        </form>

            
        </div>
        </div>
    </div>

 <!--script for disable button when no student selected--->  
<script>
        document.addEventListener("DOMContentLoaded", function () {
            const checkboxes = document.querySelectorAll(".rowCheckbox");
            const selectAll = document.getElementById("selectAll");
            const archiveBtn = document.getElementById("archiveBtn");
    
            function updateButtonState() {
                const anyChecked = [...checkboxes].some(checkbox => checkbox.checked);
                archiveBtn.disabled = !anyChecked;
            }
    
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener("change", updateButtonState);
            });
    
            selectAll.addEventListener("change", function () {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = selectAll.checked;
                });
                updateButtonState();
            });
    
            function toggleCheckbox(event, row) {
                if (!event.target.classList.contains("rowCheckbox")) {
                    const checkbox = row.querySelector(".rowCheckbox");
                    checkbox.checked = !checkbox.checked;
                    updateButtonState();
                }
            }
    
            window.toggleCheckbox = toggleCheckbox; // Ensure function is accessible globally
        });
</script>
     
 <!--script for checkbox--->  
<script>
        document.addEventListener("DOMContentLoaded", function () {
            const archiveForm = document.getElementById("archiveForm");
            const archiveModal = document.getElementById("archiveModal");
            const successModal = document.getElementById("successModal");
            const cancelBtn = document.getElementById("cancelBtn");
            const proceedBtn = archiveForm.querySelector("button[type='submit']");
            const continueBtn = document.getElementById("continueBtn");
    
            function showArchiveModal() {
                archiveModal.classList.remove("hidden");
            }
    
            cancelBtn.addEventListener("click", function () {
                archiveModal.classList.add("hidden");
            });

            proceedBtn.addEventListener("click", function (event) {
                event.preventDefault();
                archiveModal.classList.add("hidden");
                successModal.classList.remove("hidden");
            });

            continueBtn.addEventListener("click", function () {
                successModal.classList.add("hidden"); 
                archiveForm.submit();
            });
        });
    function toggleCheckbox(event, row) {
        if (event.target.closest('.notClickable') || event.target.type === 'checkbox') {
            return;
        }
        let checkbox = row.querySelector('.rowCheckbox');
        checkbox.checked = !checkbox.checked;
    }

    document.getElementById('selectAll').addEventListener('change', function () {
        let checkboxes = document.querySelectorAll('.rowCheckbox');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });
    document.getElementById('archiveBtn').addEventListener('click', function (event) {
        event.preventDefault();

        let selectedStudents = [];
        document.querySelectorAll('.rowCheckbox:checked').forEach(checkbox => {
            selectedStudents.push(checkbox.value);
        });

        if (selectedStudents.length === 0) {
            alert("Please select at least one student to archive.");
            return;
        }

        const archiveForm = document.getElementById('archiveForm');
        document.querySelectorAll('.studentInput').forEach(input => input.remove());

        selectedStudents.forEach(studentId => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'students[]';
            input.value = studentId;
            input.classList.add('studentInput');
            archiveForm.appendChild(input);
        });

        document.getElementById('archiveModal').classList.remove('hidden');
    });

    document.getElementById('cancelBtn').addEventListener('click', function () {
        document.getElementById('archiveModal').classList.add('hidden');
    });

    document.getElementById('proceedBtn').addEventListener('click', function () {
        document.getElementById('archiveModal').classList.add('hidden');
        document.getElementById('archiveForm').submit();
        setTimeout(() => {
            document.getElementById('successModal').classList.remove('hidden');
        }, 500);
    });

    document.getElementById('continueBtn').addEventListener('click', function () {
        document.getElementById('successModal').classList.add('hidden');
        location.reload();
    });

    document.querySelectorAll('#usersTableBody tr').forEach(row => {
        row.addEventListener('click', function (event) {
            toggleCheckbox(event, this);
        });
    });
</script>

<!--script for search--->
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
      
<!--script for sidebar--->
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
    


 

<!-- Archive Notification -->

<form action="{{ route('archive.users') }}" method="POST" id="archiveForm">
    @csrf

    <div id="archiveModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96 h-[40%] border-2 border-green-700 flex flex-col justify-center">
            <div class="flex flex-col items-center">
                <img class="w-[38%] h-[100%] mb-4 " src="https://scontent.fmnl13-4.fna.fbcdn.net/v/t1.15752-9/484109607_1006401184709585_8887677381926160098_n.png?stp=cp0_dst-png&_nc_cat=109&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeGZF4_VnJnVCdsq9CD0ZbKfPW9wfnHcCyY9b3B-cdwLJpXEWj0ZPW1hNSMpN3-wiOXZOQD86vxuqvdrh3e-Leo_&_nc_ohc=Y3xgaJJo7w4Q7kNvgFewM7B&_nc_oc=Adj_cHRFUystvAUYcEL73NefrMXG_sHtgZSxCkdH2FenOet5fjX5p_p5XDKHClo3liO96zsyi-2Ev5T2YgYym4K5&_nc_zt=23&_nc_ht=scontent.fmnl13-4.fna&oh=03_Q7cD1wHENZrVtHQbnJWIOkKsqr1i_djc1gct77mVH-wWB3ZoMg&oe=67FEFA89" 
                alt="Archive Box" class="w-16 h-16 mb-4">
                <p class="text-red-600 text-center font-semibold">Are you sure you want to archive this item?</p>
                <p class="text-gray-600 text-sm text-center mt-2">
                    Once archived, it will be moved to the archive list and will no longer be actively visible.
                </p>
                <div class="flex mt-4 space-x-4">
                    <button id="cancelBtn" type="button" class="bg-red-600 text-white px-4 py-2 rounded-lg shadow hover:bg-red-700 transition">
                        CANCEL
                    </button>
                    <button type="submit" class="bg-gray-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-gray-700">
                        PROCEED
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const archiveButtons = document.querySelectorAll("#archiveBTN");

    archiveButtons.forEach(button => {
        button.addEventListener("click", function () {
            const row = this.closest("tr");
            const userId = row.children[1].textContent.trim(); 

            document.getElementById("archiveUserId").value = userId;

            // Show archive modal
            document.getElementById("archiveModal").style.display = "flex";
        });
    });

    // Close modal functionality
    document.getElementById("cancelBtn").addEventListener("click", function () {
        document.getElementById("archiveModal").style.display = "none";
    });
});

</script>
<script>
    document.getElementById("archiveBtn").addEventListener("click", function () {
        document.getElementById("archiveModal").classList.remove("hidden");
    });

    document.getElementById("cancelBtn").addEventListener("click", function () {
        document.getElementById("archiveModal").classList.add("hidden");
    });
</script>

<div id="successModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="relative bg-white p-6 rounded-lg shadow-lg w-96 h-[40%] border-2 border-green-700 flex flex-col justify-center">
    <div class="flex flex-col items-center mt-[8px]">
        <img class="w-[38%] h-auto mb-4" src="https://scontent.fmnl13-4.fna.fbcdn.net/v/t1.15752-9/484109607_1006401184709585_8887677381926160098_n.png?stp=cp0_dst-png&_nc_cat=109&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeGZF4_VnJnVCdsq9CD0ZbKfPW9wfnHcCyY9b3B-cdwLJpXEWj0ZPW1hNSMpN3-wiOXZOQD86vxuqvdrh3e-Leo_&_nc_ohc=h2ARRaZj2PEQ7kNvgEHOkPu&_nc_oc=Adh-umMbzQ9XH9Ld7sjmZIckoPFezyPocTm0WHQQmLMObt6vZHWRO21WJ-w55FyCLuvc7v4YUDbqvvvBk55dpA_9&_nc_zt=23&_nc_ht=scontent.fmnl13-4.fna&oh=03_Q7cD1wEs8VOb4X6FD2uoSvhPjXJQSawfSoBCXDWdpW_IjofEMQ&oe=68004C09   "
         alt="Archive Box" class="w-16 h-16 mb-4">
        
        <!-- Checkmark SVG -->
        <div class="absolute mt-[77px]  transform -translate-x-1/2 checkmark-animate">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-20 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z" clip-rule="evenodd" />
            </svg>
        </div>

        <p class="text-green-600 text-center font-semibold">Item successfully archived. It is no longer actively visible and has been moved to the archive list.</p>   
        <div class="flex mt-6 space-x-4">
            <button id="continueBtn" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 transition">CONTINUE</button>
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

<div id="modifyUserModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 w-full p-4 hidden">
    <div class="bg-green-900 text-white p-6 md:p-8 rounded-lg shadow-lg w-full max-w-md md:max-w-lg lg:max-w-xl border-2 border-green-700 flex flex-col justify-center">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-center flex-1 ml-[30px]">MODIFY USER</h3>
            <a href="/manageUser" class="text-lg ml-auto">
                <i class="fas text-1xl fa-times hover:text-red-600"></i> 
            </a>
        </div>

        <form action="{{ route('archive.users') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="space-y-3">
                <label class="block">ID NUMBER:</label>
                <input type="text" name="students[]" value="ID" class="w-full p-2 text-black rounded-md">
                
                <label class="block">FIRSTNAME:</label>
                <input type="text" name="firstname" value="firstname" class="w-full p-2 text-black rounded-md">
                
                <label class="block">LASTNAME:</label>
                <input type="text" name="lastname" value="lastname" class="w-full p-2 text-black rounded-md">
                
                <label class="block">GENDER:</label>
                <div class="flex flex-wrap gap-4">
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="gender" value="Male" class="text-black"> <span>MALE</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="gender" value="Female" checked class="text-black"> <span>FEMALE</span>
                    </label>
                </div>

                <div class="flex flex-col md:flex-row gap-4">
                    <div class="w-full md:w-1/2">
                        <label class="block">YEAR LEVEL:</label>
                        <input type="text" name="yearLevel" value="yearLevel" class="w-full p-2 text-black rounded-md">
                    </div>
                    <div class="w-full md:w-1/2">
                        <label class="block">BLOCK:</label>
                        <input type="text" name="block" value="block" class="w-full p-2 text-black rounded-md">
                    </div>
                </div>

                <label class="block">USER ROLE:</label>
                <select name="role" class="w-full p-2 text-black rounded-md">
                    <option value="STUDENT">STUDENT</option>
                </select>
            </div>

            <div class="flex flex-col md:flex-row justify-center mt-6 gap-10">
                <button type="submit" id="archiveBTN" class="bg-red-600 px-4 py-2 rounded-md text-white font-bold w-full md:w-auto">ARCHIVE</button>
                <button type="Button" class="bg-green-600 px-4 py-2 rounded-md text-white font-bold w-full md:w-auto">MODIFY </button>
            </div>


                @csrf
                <div id="archiveMessage" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-96 h-[40%] border-2 border-green-700 flex flex-col justify-center">
                        <div class="flex flex-col items-center">
                            <img class="w-[38%] h-[100%] mb-4 " src="https://scontent.fmnl13-4.fna.fbcdn.net/v/t1.15752-9/484109607_1006401184709585_8887677381926160098_n.png?stp=cp0_dst-png&_nc_cat=109&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeGZF4_VnJnVCdsq9CD0ZbKfPW9wfnHcCyY9b3B-cdwLJpXEWj0ZPW1hNSMpN3-wiOXZOQD86vxuqvdrh3e-Leo_&_nc_ohc=Y3xgaJJo7w4Q7kNvgFewM7B&_nc_oc=Adj_cHRFUystvAUYcEL73NefrMXG_sHtgZSxCkdH2FenOet5fjX5p_p5XDKHClo3liO96zsyi-2Ev5T2YgYym4K5&_nc_zt=23&_nc_ht=scontent.fmnl13-4.fna&oh=03_Q7cD1wHENZrVtHQbnJWIOkKsqr1i_djc1gct77mVH-wWB3ZoMg&oe=67FEFA89" 
                            alt="Archive Box" class="w-16 h-16 mb-4">
                            <p class="text-red-600 text-center font-semibold">Are you sure you want to archive this item?</p>
                            <p class="text-gray-600 text-sm text-center mt-2">
                                Once archived, it will be moved to the archive list and will no longer be actively visible.
                            </p>
                            <div class="flex mt-4 space-x-4">
                                <button type="submit" id="CancelButton" class="bg-red-600 text-white px-4 py-2 rounded-lg shadow hover:bg-red-700 transition">CANCEL</button>
                          
                            </button>
                                <button type="submit" id="archiveButton" class="bg-green-600 px-4 py-2 rounded-md text-white font-bold w-full md:w-auto">PROCEED</button>
                            </div>
                        </div>
                    </div>
                </div>
                

                @csrf
                <div id="successMessage" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
                    <div class="relative bg-white p-6 rounded-lg shadow-lg w-96 h-[40%] border-2 border-green-700 flex flex-col justify-center">
                    <div class="flex flex-col items-center mt-[8px]">
                        <img class="w-[38%] h-auto mb-4" src="https://scontent.fmnl13-4.fna.fbcdn.net/v/t1.15752-9/484109607_1006401184709585_8887677381926160098_n.png?stp=cp0_dst-png&_nc_cat=109&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeGZF4_VnJnVCdsq9CD0ZbKfPW9wfnHcCyY9b3B-cdwLJpXEWj0ZPW1hNSMpN3-wiOXZOQD86vxuqvdrh3e-Leo_&_nc_ohc=h2ARRaZj2PEQ7kNvgEHOkPu&_nc_oc=Adh-umMbzQ9XH9Ld7sjmZIckoPFezyPocTm0WHQQmLMObt6vZHWRO21WJ-w55FyCLuvc7v4YUDbqvvvBk55dpA_9&_nc_zt=23&_nc_ht=scontent.fmnl13-4.fna&oh=03_Q7cD1wEs8VOb4X6FD2uoSvhPjXJQSawfSoBCXDWdpW_IjofEMQ&oe=68004C09   "
                         alt="Archive Box" class="w-16 h-16 mb-4">
                        
                        <!-- Checkmark SVG -->
                        <div class="absolute mt-[77px]  transform -translate-x-1/2 checkmark-animate">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-20 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                
                        <p class="text-green-600 text-center font-semibold">Item successfully archived. It is no longer actively visible and has been moved to the archive list.</p>   
                        <div class="flex mt-6 space-x-4">
                            <button id="continueBtn" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 transition">CONTINUE</button>
                        </div>
                    </div>
                </div>
                </div>
            </form>

    </div>
</div>

<script>
    document.getElementById('archiveBTN').addEventListener('click', function() {
        let idNumber = document.querySelector('input[value="ID"]').value;
        let firstname = document.querySelector('input[value="firstname"]').value;
        let lastname = document.querySelector('input[value="lastname"]').value;
        let yearLevel = document.querySelector('input[value="yearLevel"]').value;
        let block = document.querySelector('input[value="block"]').value;
        let gender = document.querySelector('input[name="gender"]:checked').nextElementSibling.innerText;
        let role = document.querySelector('select').value;
    
        fetch('/archiveUsers', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                id: idNumber,
                firstname: firstname,
                lastname: lastname,
                gender: gender,
                yearLevel: yearLevel,
                block: block,
                role: role
            })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            location.reload();
        })
        .catch(error => console.error('Error:', error));
    });
    </script>
<script>
    
    document.getElementById('archiveBTN').addEventListener('click', function(event) {
    event.preventDefault();
    let archiveMessage = document.getElementById('archiveMessage');
    archiveMessage.classList.remove('hidden');   
});

document.getElementById('CancelButton').addEventListener('click', function(event) {
    event.preventDefault();
    let successMessage = document.getElementById('successMessage');
    successMessage.classList.add('hidden');
    archiveMessage.classList.add('hidden');
});

document.getElementById('archiveButton').addEventListener('click', function(event) {
    event.preventDefault();
    let successMessage = document.getElementById('successMessage');
    successMessage.classList.remove('hidden');
    archiveMessage.classList.add('hidden');
});

</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        const editButtons = document.querySelectorAll(".edit-user-btn");
        
        editButtons.forEach(button => {
            button.addEventListener("click", function (event) {
                event.preventDefault(); 

                const row = this.closest("tr");
                
                const id = row.children[1].textContent.trim();
                const firstname = row.children[2].textContent.trim();
                const lastname = row.children[3].textContent.trim();
                const yearBlock = row.children[4].textContent.trim();
                const role = row.children[5].textContent.trim();

                const [yearLevel, block] = yearBlock.split(" - ");

                document.querySelector("#modifyUserModal input[type='text'][value='ID']").value = id;
                document.querySelector("#modifyUserModal input[type='text'][value='firstname']").value = firstname;
                document.querySelector("#modifyUserModal input[type='text'][value='lastname']").value = lastname;
                document.querySelector("#modifyUserModal input[type='text'][value='yearLevel']").value = yearLevel;
                document.querySelector("#modifyUserModal input[type='text'][value='block']").value = block;
                document.querySelector("#modifyUserModal select").value = role;

                // Show the modal
                document.querySelector("#modifyUserModal").style.display = "flex";
            });
        });

        // Close modal functionality
        document.querySelector("#closeModifyUserModal").addEventListener("click", function () {
            document.querySelector("#modifyUserModal").style.display = "none";

        });
    });
</script>

</body>
</html>
