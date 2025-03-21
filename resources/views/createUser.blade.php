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
            <div class="w-10 h-10 bg-[url('https://assets.rappler.com/2E744426792D49FBB61F8454EA4978B3/img/908E7DC94C264D7EBC29D394A80A8B69/coco-martin-ang-probinsiyano-001.jpg')] rounded-full bg-center bg-cover"></div>
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
            <button id="CollectionsButton" class="w-full py-3 rounded text-left px-4 hover:bg-green-700 flex gap-4 items-center">
                <i class="fas fa-wallet"></i> COLLECTIONS
            </button>
            <div id="CollectionsMenu" class="absolute left-full top-0 w-48 bg-green-800 rounded shadow-md hidden z-10">
                <a href="#" class="block px-4 py-2 hover:bg-green-700">Payment</a>
                <a href="#" class="block px-4 py-2 hover:bg-green-700">Remittance</a>
                <a href="#" class="block px-4 py-2 hover:bg-green-700">Transaction History</a>
            </div>
        </div>

             <!--Payable-->
             <div class="relative">
                <button id="PayableButton" class="w-full py-3 rounded text-left px-4 hover:bg-green-700 flex gap-4 items-center">
                    <i class="fas fa-money-bill-wave"></i> PAYABLES
                </button>
                <div id="PayableMenu" class="absolute left-full top-0 w-48 bg-green-800 rounded shadow-md hidden z-10">
                    <a href="#" class="block px-4 py-2 hover:bg-green-700">Add Payable</a>
                    <a href="#" class="block px-4 py-2 hover:bg-green-700">Update Payable</a>
                </div>
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
                <a href="#" id="" class="w-full py-3 rounded text-left px-4 hover:bg-green-700 flex gap-4 items-center">
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
        <div class=" p-[50px] flex flex-col items-center bg-[url('https://scontent.fcgy1-3.fna.fbcdn.net/v/t1.15752-9/476576892_648669014486867_3927621611615304678_n.png?_nc_cat=107&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeFItCpz8qmXnuup9gAOpSYUzZTtUua-yWrNlO1S5r7JaiVl8xtM4UqThCpkdz0MTSGAA0f9ieExtk10B8KKfVXa&_nc_ohc=xLOagArzb7QQ7kNvgEJnroi&_nc_oc=AdhjQj9y2mboNl6KzUsk9lrUe0KNLwrn4fmg5A9VtKMziNra6upezVMz7f_f8U4z0mAdX-eJ51GW4QApOiNxwu8d&_nc_zt=23&_nc_ht=scontent.fcgy1-3.fna&oh=03_Q7cD1gGe5DMkVYFrkSiGGVgoVGT0UzJVnAO7V8k_OfqW8KhnhA&oe=67DA6DD8')] bg-cover bg-center bg-no-repeat w-full col-start-1 col-end-13 row-start-2 row-end-13">
        
            <div class="bg-green-900 text-white w-full max-w-2xl p-8 rounded-lg shadow-lg">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-center flex-1 ml-[30px]">CREATE USER</h3>
                    <a href="/manageUser" class="text-lg ml-auto">
                        <i class="fas text-1xl fa-times hover:text-red-600"></i> 
                    </a>
                </div>
    
                
    <form action="saveData" method="POST" id="userForm" class="space-y-4">
    @csrf 
    <div>
        <label class="block mb-1 text-sm font-semibold">ID NUMBER:</label>
        <input name="id" type="number" class="w-full p-2 rounded-md text-black uppercase" required id="idNumber" style="text-transform: uppercase;">
    </div>
    <div>
        <label class="block mb-1 text-sm font-semibold">FIRSTNAME:</label>
        <input name="firstname" type="text" class="w-full p-2 rounded-md text-black uppercase" required style="text-transform: uppercase;">
    </div>
    <div>
        <label class="block mb-1 text-sm font-semibold">LASTNAME:</label>
        <input name="lastname" type="text" class="w-full p-2 rounded-md text-black uppercase" required id="lastName" style="text-transform: uppercase;">
    </div>
    <div>
        <label class="block mb-1 text-sm font-semibold">GENDER:</label>
        <div class="flex items-center space-x-4">
            <label class="flex items-center space-x-1">
                <input type="radio" name="gender" value="MALE" class="accent-green-500" required>
                <span>MALE</span>
            </label>
            <label class="flex items-center space-x-1">
                <input type="radio" name="gender" value="FEMALE" class="accent-green-500" required>
                <span>FEMALE</span>
            </label>
        </div>
    </div>
    <div class="flex space-x-2">
        <div class="w-[50%]">
            <label class="block mb-1 text-sm font-semibold">YEAR LEVEL:</label>
            <select name="yearLevel" class="w-full p-2 rounded-md text-black uppercase" required style="text-transform: uppercase;">
                <option value="" disabled selected>SELECT YEAR LEVEL</option>
                <option value="1st Year">1ST YEAR</option>
                <option value="2nd Year">2ND YEAR</option>
                <option value="3rd Year">3RD YEAR</option>
                <option value="4th Year">4TH YEAR</option>
            </select>
        </div>
        <div class="w-[50%]">
            <label class="block mb-1 text-sm font-semibold">BLOCK:</label>
            <input name="block" type="text" class="w-full p-2 rounded-md text-black uppercase" required style="text-transform: uppercase;">
        </div>
    </div>
    <div>
        <label class="block mb-1 text-sm font-semibold">USER ROLE:</label>
        <select name="role" id="roleSelect" class="w-full p-2 rounded-md text-black uppercase" required>
            <option value="STUDENT" selected>STUDENT</option>
        </select>
    </div>
    <script>
        document.getElementById('roleSelect').addEventListener('mousedown', function(event) {
            event.preventDefault(); 
        });
    </script>
    <div>
        <label class="block mb-1 text-sm font-semibold">USERNAME:</label>
        <input name="username" type="text" class="w-full p-2 rounded-md text-black uppercase" required id="username" readonly style="text-transform: uppercase;">
    </div>
    <div>
        <label class="block mb-1 text-sm font-semibold">PASSWORD:</label>
        <input name="password" type="text" class="w-full p-2 rounded-md text-black uppercase" required id="password" style="text-transform: uppercase;">
    </div>
    <div class="text-center">
        <button type="button" id="addUserBtn" class="bg-green-700 px-4 py-2 rounded-md hover:bg-green-600">ADD USER</button>
    </div>

                
     <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const searchInput = document.querySelector("input[type='text']");
                        const table = document.querySelector("table");
                        const tbody = table.querySelector("tbody");
                        const rows = Array.from(tbody.querySelectorAll("tr"));
                    
                        // Search Function
                        searchInput.addEventListener("keyup", function () {
                            const filter = searchInput.value.toLowerCase();
                            rows.forEach(row => {
                                const description = row.children[1].textContent.toLowerCase(); 
                                if (description.includes(filter)) {
                                    row.style.display = "";
                                } else {
                                    row.style.display = "none";
                                }
                            });
                        });
                    
                        // Sorting Function
                        document.querySelectorAll("th").forEach((header, columnIndex) => {
                            header.addEventListener("click", function () {
                                const isNumeric = columnIndex > 1 && columnIndex < 4; // Amount, Receivable, Due Date columns
                                const direction = header.dataset.order === "asc" ? "desc" : "asc";
                                header.dataset.order = direction;
                    
                                const sortedRows = rows.sort((a, b) => {
                                    let valA = a.children[columnIndex].textContent.trim();
                                    let valB = b.children[columnIndex].textContent.trim();
                    
                                    if (isNumeric) {
                                        valA = parseFloat(valA.replace(/[₱,]/g, "")) || 0;
                                        valB = parseFloat(valB.replace(/[₱,]/g, "")) || 0;
                                    }
                    
                                    return direction === "asc" ? (valA > valB ? 1 : -1) : (valA < valB ? 1 : -1);
                                });
                    
                                tbody.innerHTML = "";
                                sortedRows.forEach(row => tbody.appendChild(row));
                            });
                        });
                    });
     </script>

     <script>
                    document.getElementById("idNumber").addEventListener("input", function() {
                        document.getElementById("username").value = this.value; // Set username = ID number
                    });
                
                    document.getElementById("lastName").addEventListener("input", function() {
                        document.getElementById("password").value = this.value; // Set password = Last Name
                    });
     </script>

    </div>
    </div>
    </div>

    <!--Script for sidebar-->
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



<!---Male User-->
    @csrf
    <div id="archiveModalMale" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96 h-[40%] border-2 border-green-700 flex flex-col justify-center">
            <div class="flex flex-col items-center">
                <img class="w-[38%] h-[100%] mb-10" src="https://scontent.fmnl13-3.fna.fbcdn.net/v/t1.15752-9/483860626_1828319857723075_667721797827619347_n.png?_nc_cat=100&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeGQ28kD1CFxfVEp1rdMtHp8P-jzcsu8cQE_6PNyy7xxAbInbSKwilFwhl7FwsuvTKnnlC432UQ4VUFlSo3ahh8N&_nc_ohc=cCXonyAZeDEQ7kNvgEOAaiQ&_nc_oc=AdgGF4XYH6RqviyAeonzTUU2WQD5Oq8qq0I1_mTzDlBATahAR8ToskOYtca5zNmuFwo0RtjnZfxzflS3UKgXk7YS&_nc_zt=23&_nc_ht=scontent.fmnl13-3.fna&oh=03_Q7cD1wGy_Y6zMtZoV08krifuxxFPJVz9FXIienKnXPuyKsSe4A&oe=68006A22"
                 alt="Male Image">
                <p class="text-red-600 text-center font-semibold">Are you sure you want to add this user?</p>   
                <div class="flex mt-10 space-x-4">
                    <button type="button" class="cancelBtn bg-red-600 text-white px-4 py-2 rounded-lg shadow hover:bg-red-700 transition">CANCEL</button>
                    <button type="button" class="confirmBtn bg-gray-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-gray-700">CONFIRM</button>
                </div>
            </div>
        </div>
    </div>

    <div id="successModalMale" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="relative bg-white p-6 rounded-lg shadow-lg w-96 h-[40%] border-2 border-green-700 flex flex-col justify-center">
            <div class="flex flex-col items-center">
                <img class="w-[38%] h-auto mb-10" src="https://scontent.fmnl13-3.fna.fbcdn.net/v/t1.15752-9/483860626_1828319857723075_667721797827619347_n.png?_nc_cat=100&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeGQ28kD1CFxfVEp1rdMtHp8P-jzcsu8cQE_6PNyy7xxAbInbSKwilFwhl7FwsuvTKnnlC432UQ4VUFlSo3ahh8N&_nc_ohc=cCXonyAZeDEQ7kNvgEOAaiQ&_nc_oc=AdgGF4XYH6RqviyAeonzTUU2WQD5Oq8qq0I1_mTzDlBATahAR8ToskOYtca5zNmuFwo0RtjnZfxzflS3UKgXk7YS&_nc_zt=23&_nc_ht=scontent.fmnl13-3.fna&oh=03_Q7cD1wFvRgdT3pkayPwyOcYC3Aw7_Uwhs1zMn2RYLbZWt6TCHQ&oe=680031E2" alt="Archive Box" class="w-16 h-16 mb-4">
                
                <!-- Checkmark SVG -->
                <div class="absolute mt-[85px]  transform -translate-x-1/2 checkmark-animate">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-20 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
    
                <p class="text-green-600 text-center font-semibold">New account has  been successfully added! </p>   
                <div class="flex mt-10 space-x-4">
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-gray-700">
                        CONFIRM
                    </button>
                </div>
            </div>
        </div>
    </div>
    
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


<!---Female User-->
@csrf
<div id="archiveModalFemale" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96 h-[40%] border-2 border-green-700 flex flex-col justify-center">
        <div class="flex flex-col items-center">
            <img class="w-[38%] h-[100%] mb-10" src="https://scontent.fmnl13-4.fna.fbcdn.net/v/t1.15752-9/485131031_1620795031902453_7027382849760185764_n.png?_nc_cat=103&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeH_zfiJQQNtFSeRNVIoF9MRcL-UDDSQx7Jwv5QMNJDHsuqdgIj7bvuxQBiB0yPVvom_4t5NdsgziOPX0SbJgQti&_nc_ohc=ZcA7UiK6QlUQ7kNvgE6V1kc&_nc_oc=Adi1vlF52Hz4Js5YGgqwnBE17Dzd6VbdDjd9KMme-87UhLOG9YMwieqbS5RfTZQf3iCxOOugo1Zq6MCV4wijH8NR&_nc_zt=23&_nc_ht=scontent.fmnl13-4.fna&oh=03_Q7cD1wEqrSa09FPNBglSlaxFBgB8msrNnbC7hFTnMHYp56Ee5A&oe=68006626"
             alt="Male Image">
            <p class="text-red-600 text-center font-semibold">Are you sure you want to add this user?</p>   
            <div class="flex mt-10 space-x-4">
                <button type="button" class="cancelBtn bg-red-600 text-white px-4 py-2 rounded-lg shadow hover:bg-red-700 transition">CANCEL</button>
                <button type="button" class="confirmBtn bg-gray-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-gray-700">CONFIRM</button>
            </div>
        </div>
    </div>
</div>


<div id="successModalFemale" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
 <div class="relative bg-white p-6 rounded-lg shadow-lg w-96 h-[40%] border-2 border-green-700 flex flex-col justify-center">
        <div class="flex flex-col items-center">
            <img class="w-[38%] h-auto mb-10" src="https://scontent.fmnl13-4.fna.fbcdn.net/v/t1.15752-9/485131031_1620795031902453_7027382849760185764_n.png?_nc_cat=103&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeH_zfiJQQNtFSeRNVIoF9MRcL-UDDSQx7Jwv5QMNJDHsuqdgIj7bvuxQBiB0yPVvom_4t5NdsgziOPX0SbJgQti&_nc_ohc=ZcA7UiK6QlUQ7kNvgE6V1kc&_nc_oc=Adi1vlF52Hz4Js5YGgqwnBE17Dzd6VbdDjd9KMme-87UhLOG9YMwieqbS5RfTZQf3iCxOOugo1Zq6MCV4wijH8NR&_nc_zt=23&_nc_ht=scontent.fmnl13-4.fna&oh=03_Q7cD1wEqrSa09FPNBglSlaxFBgB8msrNnbC7hFTnMHYp56Ee5A&oe=68006626"
            alt="Archive Box" class="w-16 h-16 mb-4">
            
            <!-- Checkmark SVG -->
            <div class="absolute mt-[85px]  transform -translate-x-1/2 checkmark-animate">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-20 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z" clip-rule="evenodd" />
                </svg>
            </div>

            <p class="text-green-600 text-center font-semibold">New account has  been successfully added! </p>   
            <div class="flex mt-10 space-x-4">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-gray-700">
                    CONFIRM
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const archiveModal = document.getElementById("archiveModalFemale");
        const successModal = document.getElementById("successModalFemale");        
        const confirmButton = archiveModal.querySelector(".confirmBtn");
        const cancelButton = archiveModal.querySelector(".cancelBtn");
        const successConfirmButton = successModal.querySelector("button[type='submit']");
    
   

        confirmButton.addEventListener("click", function () {
            successModalFemale.classList.add("hidden");
        });

        confirmButton.addEventListener("click", function () {
            archiveModalFemale.classList.add("hidden");
            successModalFemale.classList.remove("hidden");
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
    document.getElementById("addUserBtn").addEventListener("click", function () {
        // Kuhaa ang value sa gender
        var selectedGender = document.querySelector('input[name="gender"]:checked');
    
        if (selectedGender) {
            var gender = selectedGender.value;
            
            // Ipakita ang sakto nga modal base sa gender
            if (gender === "MALE") {
                document.getElementById("archiveModalMale").classList.remove("hidden");
            } else if (gender === "FEMALE") {
                document.getElementById("archiveModalFemale").classList.remove("hidden");
            }
        }
    });
    
    // Function para itago ang modal kung i-click ang CANCEL
    document.querySelectorAll(".cancelBtn").forEach(button => {
        button.addEventListener("click", function () {
            document.getElementById("archiveModalMale").classList.add("hidden");
            document.getElementById("archiveModalFemale").classList.add("hidden");
        });
    });
    </script>

</form>





</body>
</html>
