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
        <div class=" p-[50px] bg-[url('https://scontent.fcgy1-3.fna.fbcdn.net/v/t1.15752-9/476576892_648669014486867_3927621611615304678_n.png?_nc_cat=107&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeFItCpz8qmXnuup9gAOpSYUzZTtUua-yWrNlO1S5r7JaiVl8xtM4UqThCpkdz0MTSGAA0f9ieExtk10B8KKfVXa&_nc_ohc=2UtHA-UnI08Q7kNvgGpTMTv&_nc_oc=Adl8rjmaAbiCOJKlj9iPHqpUP3QmbtahCLqIMwzgn5XwMSVP-81Z5ULUQyzx08H46nxQhDj7wqdpo7CJdAEnbg2H&_nc_zt=23&_nc_ht=scontent.fcgy1-3.fna&oh=03_Q7cD1wFur8UdpohB6NESdevD8qBfvbh8X_0X24oJ7JtlH--tCg&oe=6804D618')] bg-cover bg-center bg-no-repeat w-full col-start-1 col-end-13 row-start-2 row-end-13">
           <div class="content-center">
            
                <div>
                    <h2 class="text-lg font-bold">WELCOME! JUAN DELA CRUZ,</h2>
                    <p class="text-gray-600 text-sm">DEPARTMENT TREASURER</p>
                </div>
    
                <div class="grid lg:grid-cols-3 md:grid-cols-3 gap-4 mt-6">

                    <div class="bg-green-500 text-white p-6 rounded-lg shadow-lg text-center ">
                        <div class="flex justify-center mt-[15px]">
                            <img src="https://scontent.fmnl13-3.fna.fbcdn.net/v/t1.15752-9/478304506_657320803628371_1979724036374650860_n.png?_nc_cat=101&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeE_r0Cbp7WV8wxL_k3GCBkwUTyeHKcG5X1RPJ4cpwblfSPVz4wbtnbg2xQ_YYgpWF6BR00MCOWBimyVqK6wgdCY&_nc_ohc=Z93o9pQtEtkQ7kNvgFxVI7j&_nc_oc=AdlwGb6wkI2KJAYssdGJLidpwKjXVHHiOvFRl5KlR9N6ofIJ-tGOtC5yzbx7r-LNrc-UEQmDqch02nqMAtegPUM9&_nc_zt=23&_nc_ht=scontent.fmnl13-3.fna&oh=03_Q7cD1wFFzlRZ5DnAnK5RN5IQefnzA7u9DNrYGnbtR9Axj3c34Q&oe=6801FE4F"
                            class="w-[30%] h-[30%]" alt="Cash on Hand">
                          
                        <p class="font-bold text-[20px] flex place-items-center mt-2"  style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">CASH ON HAND</p> 
                        </div>
                        <p class="text-3xl font-bold"  style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">₱0.00</p>
                    </div>
    
                    <div class="bg-red-500 text-white p-6 rounded-lg shadow-lg text-center ">
                        <div class="flex justify-center mt-[15px]">
                            <img src="https://scontent.fcgy2-1.fna.fbcdn.net/v/t1.15752-9/481574582_3363874913752849_8300719159033548285_n.png?_nc_cat=100&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeFDBs97aEM9rUPsvJFytt_X5NjT8FOe5Uzk2NPwU57lTKdYes4ga_YQw_wx58snXLUcH-BFRaoiMnJGwxdr9UXt&_nc_ohc=zMarWMJf44sQ7kNvgHVH1Qu&_nc_oc=AdjibbLaUUT2Munq58lH065JcPmGFYfPULvpPFgMKVYmkGRGsimd4yAFrxuJJdUU3fzdkdpDNamTiLXirJblisal&_nc_zt=23&_nc_ht=scontent.fcgy2-1.fna&oh=03_Q7cD1gFyMDi1JpxobuG-v8oSdZ1bYzGDYq61ssofNYY7LIYJiw&oe=67EE0ADD"
                            class="w-[30%] h-[30%]" alt="Expenses">
                          
                        <p class="font-bold text-[20px] flex place-items-center mt-2"  style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">EXPENSES</p> 
                        </div>
                        <p class="text-3xl font-bold"  style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">₱0.00</p>
                    </div>
    
                    <div class="bg-yellow-500 text-white p-6 rounded-lg shadow-lg text-center ">
                    <div class="flex justify-center mt-[15px]">
                    <img src="https://scontent.fcgy1-3.fna.fbcdn.net/v/t1.15752-9/480440311_2015779438940893_3746088750876481447_n.png?_nc_cat=111&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeFvcMBuzZshz9vZxAqaA6xQ42Gw-PQi4PzjYbD49CLg_MFnX156d_Bz_J4H_NTdozmDqL3P5g64A4fkavZifE5N&_nc_ohc=9XmWzCJWq_4Q7kNvgH2TYxC&_nc_oc=AdnrNUWjY67-iAzWggnpJOwRSymfUWt284vjnWQWYCzP6HNIsXejdSOT5nncGjB2m7EyFPhElN_c9WWKeenwRSdE&_nc_zt=23&_nc_ht=scontent.fcgy1-3.fna&oh=03_Q7cD1wGNVIL8CgW3ZBMHxo4xnoNqc1mitkBJb3WAzaOsrdJKwg&oe=680220BA"
                    class="w-[20%] h-[20%]" alt="Receivables">
                    
                    <p class="font-bold text-[20px] flex place-items-center mt-2"  style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">RECEIVABLE</p> 
                    </div>
                    <p class="text-3xl font-bold"  style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">₱172,000,000</p>
                    </div>
                 
                    
                   
                </div>
    

            
            <!-- Payables Table -->
            <div class="mt-6 pb-5">
                <h3 class="text-lg font-bold mb-4">STUDENTS PAYABLES</h3>
                <table class="w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr class="text-left">
                            <th class="border border-gray-300 p-2">DESCRIPTION</th>
                            <th class="border border-gray-300 p-2">AMOUNT</th>
                            <th class="border border-gray-300 p-2">EXPECTED RECEIVABLE</th>
                            <th class="border border-gray-300 p-2">DUE DATE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-gray-300 p-2">SEMESTRAL DUE</td>
                            <td class="border border-gray-300 p-2">₱250.00</td>
                            <td class="border border-gray-300 p-2">₱75,000.00</td>
                            <td class="border border-gray-300 p-2">MAY 20, 2025</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 p-2">SINULOG FESTIVAL</td>
                            <td class="border border-gray-300 p-2">₱300.00</td>
                            <td class="border border-gray-300 p-2">₱90,000.00</td>
                            <td class="border border-gray-300 p-2">JANUARY 10, 2025</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 p-2">FINES</td>
                            <td class="border border-gray-300 p-2">₱25.00</td>
                            <td class="border border-gray-300 p-2">₱7,500.00</td>
                            <td class="border border-gray-300 p-2">MAY 20, 2025</td>
                        </tr>
                    </tbody>
                </table>
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
      

</body>
</html>
