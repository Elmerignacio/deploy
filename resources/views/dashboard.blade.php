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
        left: -320px; /* Sidebar hidden by default */
        width: 320px;
        height: 100%;
        transition: left 0.3s ease;
        z-index: 100;
    }

    /* When the sidebar is opened */
    .sidebar.open {
        left: 0;
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
    }

    /* Content with sidebar */
    .content-with-sidebar {
        margin-left: 320px;
    }

    /* Ensure responsive layout when screen size is smaller */
    @media (max-width: 1024px) {
        .sidebar {
            left: -240px;
            width: 240px;
        }

        .sidebar.open {
            left: 0;
        }
    }
</style>

<body class="bg-gray-100">

    <div class="grid grid-cols-[repeat(12,1fr)] grid-rows-[repeat(12,1fr)] h-[100vh] w-[100%]">
   
        <!-- Sidebar -->
        <aside class="sidebar col-start-1 col-end-3 row-start-2 row-end-13 mt-[85px] bg-green-900 text-white p-4">
            <!-- Profile Section -->
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 bg-[url('https://assets.rappler.com/2E744426792D49FBB61F8454EA4978B3/img/908E7DC94C264D7EBC29D394A80A8B69/coco-martin-ang-probinsiyano-001.jpg')] rounded-full bg-center bg-cover"></div>
                <div>
                    <p class="font-bold text-sm">JUAN DELA CRUZ</p>
                </div>
            </div>
            <!-- Sidebar Menu -->
            <nav class="space-y-10 text-[19px] pt-10 flex flex-col">
                <button class="w-full py-3 rounded text-left px-4 hover:bg-green-700">
                    <i class="fas fa-user-plus"></i> REGISTER
                </button>
                <button class="w-full py-3 rounded text-left px-4 hover:bg-green-700">
                    <i class="fas fa-clipboard-list"></i> CREATE PAYABLE
                </button>
                <button class="w-full py-3 rounded text-left px-4 hover:bg-green-700">
                    <i class="fas fa-credit-card"></i> RECEIVE PAYMENT
                </button>
                <button class="w-full py-3 rounded text-left px-4 hover:bg-green-700">
                    <i class="fas fa-file-invoice-dollar"></i> CREATE EXPENSES
                </button>
                <button class="w-full py-3 rounded text-left px-4 hover:bg-green-700">
                    <i class="fas fa-chart-line"></i> REPORTS
                </button>
                <button class="w-full py-3 rounded text-left px-4 hover:bg-red-700">
                    <i class="fas fa-sign-out-alt"></i> LOGOUT
                </button>
            </nav>
        </aside>

        <div class="sidebar-trigger"></div>

        <!-- Header -->
        <header class="flex justify-center items-center gap-2 text-white p-2 font-bold text-2xl col-start-1 col-end-13 row-start-1 row-end-1 
        bg-[url('https://scontent.fcgy1-3.fna.fbcdn.net/v/t1.15752-9/476890606_1033672748598390_7650911982562615150_n.png?_nc_cat=110&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeFy1_KZh_695itxUzt0_gY0RFZEy8vZy05EVkTLy9nLTlH7dbaWvxAzT7Gn6DYNsphQT9JNl5Psj4BAN--vJp2_&_nc_ohc=0sAAJGN1f_gQ7kNvgGNgl7J&_nc_oc=AdiVMgLmUMt543oHrlDNO9AfLGhV-PfZw_q1he346zFOvGEq2jXNRyVAQAtgCA1VzaJ5LfSsfrz3yb360VHLEiti&_nc_zt=23&_nc_ht=scontent.fcgy1-3.fna&oh=03_Q7cD1gF4A4cEXnqRVF_618WPKwYHh5b-kbDDLi6LyNnq454rsA&oe=67DA46F6')] 
        bg-cover bg-center bg-no-repeat w-full">
            
            <img class="w-[70px] h-[70px] rounded-full" src="https://scontent.fcgy1-2.fna.fbcdn.net/v/t1.15752-9/474751507_9312187378816358_8255926976147863753_n.png?_nc_cat=101&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeHNhfrQrWyumfGMaXg_vvGCmDUZr_XEvpWYNRmv9cS-ld-qxLvleocJ_LK1dDwuJsfKyOCF8IPf6xoJwz11hpXG&_nc_ohc=7ORH9B0-XXcQ7kNvgHb4ypV&_nc_oc=AdjkEqy9pfnO2_AKxEI5dWnQFeo2lYtGBQ7WXm30ESfWBE6oQmOzSPFhmAlkk-00Ox16LIFZZvD0s5Mn_-m2w2TM&_nc_zt=23&_nc_ht=scontent.fcgy1-2.fna&oh=03_Q7cD1gE9RyE3_ugsZ5U1JosN8jmFE2ifU_HLZ0jdSsj6GYvhLw&oe=67DA3FED" alt="">
            COLLEGE OF INFORMATION TECHNOLOGY FUND MANAGEMENT SYSTEM
        </header>
        
        <!-- Content Area -->
        <div class=" p-[50px] bg-[url('https://scontent.fcgy1-3.fna.fbcdn.net/v/t1.15752-9/476576892_648669014486867_3927621611615304678_n.png?_nc_cat=107&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeFItCpz8qmXnuup9gAOpSYUzZTtUua-yWrNlO1S5r7JaiVl8xtM4UqThCpkdz0MTSGAA0f9ieExtk10B8KKfVXa&_nc_ohc=xLOagArzb7QQ7kNvgEJnroi&_nc_oc=AdhjQj9y2mboNl6KzUsk9lrUe0KNLwrn4fmg5A9VtKMziNra6upezVMz7f_f8U4z0mAdX-eJ51GW4QApOiNxwu8d&_nc_zt=23&_nc_ht=scontent.fcgy1-3.fna&oh=03_Q7cD1gGe5DMkVYFrkSiGGVgoVGT0UzJVnAO7V8k_OfqW8KhnhA&oe=67DA6DD8')] bg-cover bg-center bg-no-repeat w-full col-start-1 col-end-13 row-start-2 row-end-13">
           <div class="content-center">
            
                <div>
                    <h2 class="text-lg font-bold">WELCOME! JUAN DELA CRUZ,</h2>
                    <p class="text-gray-600 text-sm">DEPARTMENT TREASURER</p>
                </div>
    
            <div class="grid grid-cols-3 gap-4 mt-6">
                <div class="bg-green-500 text-white p-6 rounded-lg shadow-lg text-center">
                    <div class="flex justify-center mb-2">
                        <img src="https://scontent.fcgy1-2.fna.fbcdn.net/v/t1.15752-9/478304506_657320803628371_1979724036374650860_n.png?_nc_cat=101&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeE_r0Cbp7WV8wxL_k3GCBkwUTyeHKcG5X1RPJ4cpwblfSPVz4wbtnbg2xQ_YYgpWF6BR00MCOWBimyVqK6wgdCY&_nc_ohc=FGxX-oFBmBkQ7kNvgFx08rl&_nc_oc=AdioXMLogQPTWLUg8eMB6R5SsDbwJ_OgGs-D3cIxKyi3r_yek5m0StXKhhFU8aoK7Jl7gTuUOFudR0Uhhwv9i2WK&_nc_zt=23&_nc_ht=scontent.fcgy1-2.fna&oh=03_Q7cD1gFoZHlqkJQ5DuNSISu6unMJXwIf1novf1034RzpPwu00Q&oe=67DA390F"
                         class="w-[30%] h-[30%]" alt="Cash on Hand">
                    </div>
                    <p class="font-bold text-lg">CASH ON HAND</p>
                    <p class="text-3xl font-bold">₱0.00</p>
                </div>
                <div class="bg-red-500 text-white p-6 rounded-lg shadow-lg text-center">
                    <div class="flex justify-center mb-2">
                        <img src="https://scontent.fcgy1-2.fna.fbcdn.net/v/t1.15752-9/476442385_1340529870434143_5545003427532863796_n.png?_nc_cat=111&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeE5qZ4S3qA_43mhUR1h3ZQ48bliPZfBqG3xuWI9l8GobZXoSEYazlGQNccz0sdn3mTxcMjw7WFvS9fQn6WO8bf0&_nc_ohc=VeOiYc8A_s4Q7kNvgFFrVcE&_nc_oc=AdjbLRkU91tuh0XFddY1YYT6DcwC4wX5LznMkiREGTMIWWRx22A-VmuSUm5BLDk2fhUwJx40iifSr6Dran9iBPjg&_nc_zt=23&_nc_ht=scontent.fcgy1-2.fna&oh=03_Q7cD1gFLPXXH3yD4LtSsRw2-6DcKWBTjkjGOvQBw5M7J5mZLcA&oe=67DA2122"
                         class="w-[20%] h-[20%]"  alt="Expenses">
                    </div>
                    <p class="font-bold text-lg">EXPENSES</p>
                    <p class="text-3xl font-bold">₱0.00</p>
                </div>
                <div class="bg-yellow-400 text-white p-6 rounded-lg shadow-lg text-center">
                    <div class="flex justify-center mb-2">
                        <img src="https://scontent.fcgy1-2.fna.fbcdn.net/v/t1.15752-9/480440311_2015779438940893_3746088750876481447_n.png?_nc_cat=111&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeFvcMBuzZshz9vZxAqaA6xQ42Gw-PQi4PzjYbD49CLg_MFnX156d_Bz_J4H_NTdozmDqL3P5g64A4fkavZifE5N&_nc_ohc=5nKqFTPzZPIQ7kNvgFp44YF&_nc_oc=AdgujOQpvfcVDq3iD3RtSN7C2f3NvjnZ_PqvU6ht6s8m_Ys1MdFOnv-BlXuHeqbTFA8A17AMNAnp2UWnVDzpEBNO&_nc_zt=23&_nc_ht=scontent.fcgy1-2.fna&oh=03_Q7cD1gHmy0e0FCkcTrwLXAu2kdrAIRSIEoF8CUJfza7TfEDD2A&oe=67DA233A"
                         class="w-[20%] h-[20%]" alt="Receivables">
                    </div>
                    <p class="font-bold text-lg">RECEIVABLES</p>
                    <p class="text-3xl font-bold">₱172,000.00</p>
                </div>
            </div>


            
            <!-- Payables Table -->
            <div class="mt-6 p-6">
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
           
       
    </div>

    <script>
        const sidebar = document.querySelector('.sidebar');
        const sidebarTrigger = document.querySelector('.sidebar-trigger');
        const content = document.querySelector('.content-center');

        // Toggle sidebar visibility
        sidebarTrigger.addEventListener('mouseenter', function () {
            sidebar.classList.add('open');
            content.classList.add('content-with-sidebar');
        });

        sidebar.addEventListener('mouseleave', function () {
            sidebar.classList.remove('open');
            content.classList.remove('content-with-sidebar');
        });
    </script>

</body>
</html>
