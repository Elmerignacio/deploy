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
<div class="p-[50px] flex flex-col items-center bg-[url('https://scontent.fcgy1-3.fna.fbcdn.net/v/t1.15752-9/476576892_648669014486867_3927621611615304678_n.png?_nc_cat=107&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeFItCpz8qmXnuup9gAOpSYUzZTtUua-yWrNlO1S5r7JaiVl8xtM4UqThCpkdz0MTSGAA0f9ieExtk10B8KKfVXa&_nc_ohc=2UtHA-UnI08Q7kNvgGpTMTv&_nc_oc=Adl8rjmaAbiCOJKlj9iPHqpUP3QmbtahCLqIMwzgn5XwMSVP-81Z5ULUQyzx08H46nxQhDj7wqdpo7CJdAEnbg2H&_nc_zt=23&_nc_ht=scontent.fcgy1-3.fna&oh=03_Q7cD1wFur8UdpohB6NESdevD8qBfvbh8X_0X24oJ7JtlH--tCg&oe=6804D618')] bg-cover bg-center bg-no-repeat w-full col-start-1 col-end-13 row-start-2 row-end-13">

  <div class="bg-green-900 mt-[50px] text-white w-full max-w-2xl p-8 rounded-lg shadow-lg">

      <div class="flex justify-between items-center mb-4">
          <h3 class="text-lg font-bold text-center flex-1 ml-[30px]">CREATE PAYABLE</h3>
          <a href="/payableManagement" class="text-lg ml-auto">
              <i class="fas text-1xl fa-times hover:text-red-600"></i> 
          </a>
      </div>

      @if(session('success'))
      <p>{{session('success')}}</p>
      @endif


      <form action="savePayable" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block mb-1 text-sm font-semibold">DESCRIPTION:</label>
            <input type="text" name="description" class="w-full p-2 rounded-md text-black border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500" required style="text-transform: uppercase;">
        </div>
        <div>
            <label class="block mb-1 text-sm font-semibold">AMOUNT:</label>
            <input type="number" name="amount" step="0.01" class="w-full p-2 rounded-md text-black border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500" required>
        </div>
        <div>
            <label class="block mb-1 text-sm font-semibold">DUE DATE:</label>
            <input type="date" name="dueDate" class="w-full p-2 rounded-md text-black border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500" required>
        </div>
        <div>
            <label class="block mb-1 text-sm font-semibold">YEAR LEVEL:</label>
            <select id="yearLevel" name="yearLevel" class="w-full p-2 rounded-md text-black border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                <option value="">SELECT YEAR LEVEL</option>
                <option value="all">ALL YEAR LEVEL</option>
                @foreach($yearLevels as $yearLevel)
                    <option value="{{ $yearLevel->yearLevel }}">{{ strtoupper($yearLevel->yearLevel) }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block mb-1 text-sm font-semibold">BLOCK:</label>
            <select id="block" name="block" class="w-full p-2 rounded-md text-black border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                <option value="">SELECT BLOCK</option>
                <option value="all">ALL BLOCK</option>
            </select>
        </div>
        <div>
            <label class="block mb-1 text-sm font-semibold">STUDENT:</label>
            <select id="student" name="student" class="w-full p-2 rounded-md text-black border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                <option value="">SELECT STUDENT</option>
                <option value="all">ALL STUDENTS</option>
            </select>
        </div>
        <div class="text-center mt-5">
            <button type="submit" class="bg-green-700 px-4 py-2 rounded-md hover:bg-green-600 text-white font-bold">ADD PAYABLE</button>
        </div>
    </form>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let yearLevelDropdown = document.getElementById("yearLevel");
            let blockDropdown = document.getElementById("block");
            let studentDropdown = document.getElementById("student");
    
            yearLevelDropdown.addEventListener("change", function () {
                let yearLevel = this.value;
    
                if (yearLevel) {
                    fetch(`/get-students-and-blocks?yearLevel=${yearLevel}`)
                        .then(response => response.json())
                        .then(data => {
                            blockDropdown.innerHTML = '<option value="all">ALL BLOCK</option>';
                            data.blocks.forEach(block => {
                                blockDropdown.innerHTML += `<option value="${block.block}">${block.block.toUpperCase()}</option>`;
                            });
                            blockDropdown.dataset.students = JSON.stringify(data.students);
    
                            studentDropdown.innerHTML = '<option value="all">ALL STUDENTS</option>';
                        })
                        .catch(error => console.error("ERROR FETCHING DATA:", error));
                } else {
                    blockDropdown.innerHTML = '<option value="all">ALL BLOCK</option>';
                    studentDropdown.innerHTML = '<option value="all">ALL STUDENTS</option>';
                }
            });
    
            blockDropdown.addEventListener("change", function () {
                let selectedBlock = this.value;
                let allStudents = JSON.parse(blockDropdown.dataset.students || "[]");
    
                studentDropdown.innerHTML = '<option value="all">ALL STUDENTS</option>';
    
                let filteredStudents = selectedBlock === "all"
                    ? allStudents 
                    : allStudents.filter(student => student.block === selectedBlock);
    
                filteredStudents.forEach(student => {
                    studentDropdown.innerHTML += `<option value="${student.id}">${student.firstname.toUpperCase()} ${student.lastname.toUpperCase()}</option>`;
                });
            });
        });
    </script>
    

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



<!----->
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

      
</body>
</html>
