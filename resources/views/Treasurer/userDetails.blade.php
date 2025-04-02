<x-trea-components.layout/>
<x-trea-components.header/>
<x-trea-components.content>
    <x-trea-components.sidebar>

        <div class="flex mt-[100px] justify-center h-screen px-4">
            <div class="flex flex-col items-center w-full max-w-md md:max-w-lg lg:max-w-xl">
                <h1 class="text-2xl mb-[70px] text-green-600"><strong>USER ACCOUNT DETAILS</strong></h1>
                <div class="relative w-full bg-green-900 text-white p-12 rounded-xl shadow-2xl">
                    <a href="/dashboard">
                        <button class="absolute top-2 right-6 text-white text-3xl hover:text-red-500">&times;</button>
                    </a>
        
                    <!-- Profile Picture with Camera Icon -->
                    <div class="relative flex justify-center -mt-24">
                        <img id="previewImage" class="w-32 h-32 rounded-full border-4 border-white"
                            src="{{ asset('storage/user_images/' . ($user->profile_image ?? 'default.png')) }}" 
                            alt="User Profile">
                        <label for="profileImage" class="absolute bottom-1 right-2 bg-gray-800 text-white p-2 rounded-full cursor-pointer">
                            <i class="fas fa-camera"></i>
                        </label>
                    </div>
        
                    <div class="text-center mt-8">
                        <h2 class="text-3xl font-bold">{{ $firstname }} {{ $lastname }}</h2>
                        <p class="text-lg font-semibold">DEPARTMENT {{ $role }}</p>
                        <p class="text-lg">{{ $yearLevel }} - {{ $block }}</p>
                        <p class="text-lg">{{ $gender }}</p>
                    </div>
        
                    <div class="mt-8 text-lg">
                        <p class="font-semibold">USERNAME: <span class="font-normal">{{ $username }}</span></p>
                        <p class="font-semibold flex items-center mt-2 text-xl">
                            PASSWORD:
                            <input type="password" class="ml-2 font-normal rounded px-1 py-0.5 text-white text-lg w-[20%] bg-green-900 border-none" value="{{ $password }}" readonly>
                            <i class="fas fa-edit ml-2 text-white cursor-pointer" @click="openModal = true"></i>
                        </p>
                    </div>
        
                    <!-- Image Upload Form -->
                    <form id="imageUploadForm" action="{{ route('saveUserImage') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" id="profileImage" name="image" class="hidden" onchange="previewImage(event)">
                        <input type="hidden" name="IDNumber" value="{{ $user->IDNumber ?? '' }}">
                        
                        <!-- Upload button (hidden by default) -->
                        <button id="uploadBtn" type="button" class="bg-blue-500 text-white px-4 py-2 rounded-md hidden" onclick="confirmUpload()">
                            Upload Image
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Popup Modal -->
        <div id="popupModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-6 rounded-md shadow-md text-center">
                <p class="text-lg font-semibold mb-4">Are you sure you want to upload this image?</p>
                <button onclick="submitImage()" class="bg-green-500 text-white px-4 py-2 rounded-md">Yes</button>
                <button onclick="closePopup()" class="bg-red-500 text-white px-4 py-2 rounded-md ml-2">Cancel</button>
            </div>
        </div>
        
        <script>
            function previewImage(event) {
                let file = event.target.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById("previewImage").src = e.target.result;
                        document.getElementById("uploadBtn").classList.remove("hidden"); // Show upload button
                    };
                    reader.readAsDataURL(file);
                }
            }
        
            function confirmUpload() {
                document.getElementById("popupModal").classList.remove("hidden");
            }
        
            function closePopup() {
                document.getElementById("popupModal").classList.add("hidden");
            }
        
            function submitImage() {
                document.getElementById("imageUploadForm").submit(); // Submit the form
            }
        </script>
        
        

</x-trea-components.sidebar>
    
</x-trea-components.content>

