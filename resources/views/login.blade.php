
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center relative">
    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center opacity-80" 
         style="background-image: url('https://scontent.fcgy1-3.fna.fbcdn.net/v/t1.15752-9/479437056_602138389292263_5335788662988085797_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeH4mxA09FO1aOgXcm6Q7yhiKc0Ikca0BPgpzQiRxrQE-Kddxy2zYDhRTWYqNakmA42kvBFEu1603CYMX_VaT1Od&_nc_ohc=Qid-HWJHHz8Q7kNvgHOXulv&_nc_oc=AdgLHZjE8cNhL0vVXYYqOK_phwGdJkJiu7mVle4Lam6AyuCkHAcItoLM3W4m76zJUu4J8u0maxmj_yMjpbIirxtO&_nc_zt=23&_nc_ht=scontent.fcgy1-3.fna&oh=03_Q7cD1gHv2aXHjk5dzvTPFw-HFk9XoReCfHAcZboAFu6CK208hA&oe=67DA1AF4');">
    </div>
    
    <!-- Login Form Container -->
    <div class="text-center bg-opacity-90 rounded-lg p-4 sm:p-6 md:p-8 w-full sm:w-[60%] md:w-[40%] lg:w-[30%] relative">
        <!-- Logo -->
        <img src="https://scontent.fcgy1-1.fna.fbcdn.net/v/t1.15752-9/476889465_1031220635502910_3824620861361377314_n.png?_nc_cat=104&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeHPP4FbblrxnnYMRv040LehbOzhgJBkiEls7OGAkGSISewLzQSLejFhLet4i_d-3rI7c0NqEGxqxvIA4Nqqq19i&_nc_ohc=U_5Ix_90_S8Q7kNvgEMJvrY&_nc_oc=AdgPUXzi1jYs3JAE8uTVXDKU5_txenQUfZhw49sL_JwTgQZplbLGP1lTuFeqFkPjr8hEXgsZabkHe4xZXiJ8_uit&_nc_zt=23&_nc_ht=scontent.fcgy1-1.fna&oh=03_Q7cD1gEiITVNcsQ8jhOnJZxVSHo0fkEn5vryRmZRFH5CjHpKVA&oe=67DA3248" 
             alt="Logo" class="mx-auto mb-4 logo object-contain w-[40%] h-[40%]">
        
        <!-- Title -->
        <h1 class="text-2xl font-bold text-green-800">
            College of Information Technology<br>
            Fund Management System
        </h1>

        <!-- Form Box -->
        <div class="mt-[5%] bg-green-800 p-8 sm:p-10 md:p-12 rounded-lg">
            <!-- Username Input -->
            <div class="mb-6">
                <label class="block text-white text-4 mb-2 font-bold text-left" for="username">Username</label>
                <input class="w-full px-6 py-3 rounded-lg border focus:outline-none focus:ring-2 focus:ring-green-400" 
                       type="text" id="username" placeholder="Username">
            </div>
            <!-- Password Input -->
            <div class="mb-6">
                <label class="block text-white text-4 mb-2 font-bold text-left" for="password">Password</label>
                <input class="w-full px-6 py-3 rounded-lg border focus:outline-none focus:ring-2 focus:ring-green-400" 
                       type="password" id="password" placeholder="Password">
            </div>

         
            <a class=" w-[100px] text-1xl bg-white text-green-800 font-bold px-9 py-3 rounded-lg hover:bg-green-400 transition duration-300" href="dashboard" >Login</a>
          
           
        </div>
        
</body>
</html>
