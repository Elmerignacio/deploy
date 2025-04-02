
    <x-trea-components.login />


        <h1 class="text-2xl font-bold text-green-800">
            College of Information Technology<br>
            Fund Management System
        </h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mt-[5%] bg-green-800 p-8 sm:p-10 md:p-12 rounded-lg">
                <div class="mb-6">
                    <label class="block text-white text-4 mb-2 font-bold text-left" for="username">Username</label>
                    <input class="w-full px-6 py-3 rounded-lg border focus:outline-none focus:ring-2 focus:ring-green-400" 
                           type="text" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="mb-6">
                    <label class="block text-white text-4 mb-2 font-bold text-left" for="password">Password</label>
                    <input class="w-full px-6 py-3 rounded-lg border focus:outline-none focus:ring-2 focus:ring-green-400" 
                           type="password" id="password" name="password" placeholder="Password" required>
                </div>
        
                <button type="submit" class="text-1xl bg-white text-green-800 font-bold px-9 py-4 rounded-lg hover:bg-green-400 transition duration-300">
                    Login
                </button>
        
            </div>
        </form>
        