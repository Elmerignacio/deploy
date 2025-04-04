<div class="flex h-screen overflow-auto md:overflow-hidden">
  <aside 
    v-show="window.innerWidth >= 1024 || sidebarOpen"
    @mouseover="if (window.innerWidth >= 1024) sidebarOpen = true" 
    @mouseleave="if (window.innerWidth >= 1024) sidebarOpen = false"
    :class="{
        'w-60 translate-x-0': sidebarOpen, 
        'w-0 overflow-hidden': !sidebarOpen, 
        'lg:w-64': sidebarOpen, 
        'lg:w-20': !sidebarOpen
    }"
    class="fixed lg:relative h-full bg-green-800 shadow-lg transform transition-all duration-300 ease-in-out lg:translate-x-0 z-50">
    
    <nav class="mt-10 ml-4 space-y-2 flex flex-col gap-4 justify-center text-[15px] text-bolds pr-5">
        
        <a href="userDetails" class="flex items-center text-white rounded-md mb-5">
            <input type="image" src="https://scontent.fmnl13-3.fna.fbcdn.net/v/t39.30808-6/471150402_1505096456828440_7358126298249955781_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=a5f93a&_nc_eui2=AeFtL6QwaJwr2S7PP8J6rE4sXNftBUmckMBc1-0FSZyQwDEivEK4MsJWzLqfD5x76UVcHRzaGrsM3CPmp3j-0q3r&_nc_ohc=MZ_9hPvY984Q7kNvgFE55nY&_nc_oc=Adl11F6GeFzLjpxCM9h8doJz24EPjJpxVgv2JQkhtl6xK9AGGs-KCq7XOW-a1lsRoBbpbkqIxhwshgqNUPSpICI2&_nc_zt=23&_nc_ht=scontent.fmnl13-3.fna&_nc_gid=zVSRPbEJY6TIu7AoeGDmfw&oh=00_AYFKittrZgyQG_mdgOqhBNYKPavfmJ9tyP79VgxYUq4RFg&oe=67EC842D" 
            alt="Profile" class="rounded-full w-10 h-10 border-2 border-white">
            
            <span :class="sidebarOpen ? 'inline-block ml-4 whitespace-nowrap overflow-hidden' : 'hidden'" 
                class="text-white text-[20px] font-bold transition-all duration-300" id="userFullName">
            </span>
        </a>
        
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                fetch('/get-user-info')
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('userFullName').textContent = data.firstname + " " + data.lastname;
                    })
                    .catch(error => console.error('Error fetching user info:', error));
            });
        </script>
        
        <a href="/dashboard" class="flex items-center p-2 text-white hover:bg-green-500 rounded-md">
            <i class="fas fa-home text-2xl flex-shrink-0"></i>
            <span :class="{'inline-block ml-4 whitespace-nowrap overflow-hidden': sidebarOpen, 'hidden': !sidebarOpen}" class="text-white transition-all duration-300">
                DASHBOARD
            </span>
        </a>
        <a href="/studentBalance" class="flex items-center p-2 text-white hover:bg-green-500 rounded-md">
            <i class="fas fa-user-graduate text-2xl flex-shrink-0"></i>
            <span :class="{'inline-block ml-4 whitespace-nowrap overflow-hidden': sidebarOpen, 'hidden': !sidebarOpen}" class="text-white transition-all duration-300">
                STUDENT BALANCES
            </span>
        </a>
        <a href="/collection" class="flex items-center p-2 text-white hover:bg-green-500 rounded-md">
            <i class="fas fa-wallet text-2xl flex-shrink-0"></i>
            <span :class="{'inline-block ml-4 whitespace-nowrap overflow-hidden': sidebarOpen, 'hidden': !sidebarOpen}" class="text-white transition-all duration-300">
                COLLECTIONS
            </span>
        </a>
        <a href="/payableManagement" class="flex items-center p-2 text-white hover:bg-green-500 rounded-md">
            <i class="fas fa-file-invoice-dollar text-2xl flex-shrink-0"></i>
            <span :class="{'inline-block ml-4 whitespace-nowrap overflow-hidden': sidebarOpen, 'hidden': !sidebarOpen}" class="text-white transition-all duration-300">
                PAYABLE MANAGEMENT
            </span>
        </a>
        <a href="/expense" class="flex items-center p-1 text-white hover:bg-green-500 rounded-md">
            <i class="fas fa-money-check-alt text-2xl flex-shrink-0"></i>
            <span :class="{'inline-block ml-4 whitespace-nowrap overflow-hidden': sidebarOpen, 'hidden': !sidebarOpen}" class="text-white transition-all duration-300">
                EXPENSES
            </span>
        </a>
        <a href="#" class="flex items-center p-2 text-white hover:bg-green-500 rounded-md">
            <i class="fas fa-chart-pie text-2xl flex-shrink-0"></i>
            <span :class="{'inline-block ml-4 whitespace-nowrap overflow-hidden': sidebarOpen, 'hidden': !sidebarOpen}" class="text-white transition-all duration-300">
                REPORTS
            </span>
        </a>
        <a href="/manageUser" class="flex items-center p-2 text-white hover:bg-green-500 rounded-md">
            <i class="fas fa-users-cog text-2xl flex-shrink-0"></i>
            <span :class="{'inline-block ml-4 whitespace-nowrap overflow-hidden': sidebarOpen, 'hidden': !sidebarOpen}" class="text-white transition-all duration-300">
                USER MANAGEMENT
            </span>
        </a>
        <a href="{{ route('logout') }}" class="flex items-center p-2 text-white hover:bg-red-600 rounded-md"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
         <i class="fas fa-sign-out-alt text-2xl flex-shrink-0"></i>
         <span :class="{'inline-block ml-4 whitespace-nowrap overflow-hidden': sidebarOpen, 'hidden': !sidebarOpen}" class="text-white transition-all duration-300">
             Logout
         </span>
     </a>
     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>
</aside>

<div class="flex flex-col p-4 sm:p-10 text-left w-full">
{{$slot}}
</div>

</div>