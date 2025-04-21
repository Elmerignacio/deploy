<x-trea-components.layout/>
<x-trea-components.header/>
<x-trea-components.content>
    <x-Repre-components.sidebar :profile="$profile" :firstname="$firstname" :lastname="$lastname">

        <div class="flex mt-[100px] justify-center h-screen px-4">
            <div class="flex flex-col items-center w-full max-w-md md:max-w-lg lg:max-w-xl">
                <h1 class="text-2xl mb-[70px] text-green-600"><strong>USER ACCOUNT DETAILS</strong></h1>
                <div class="relative w-full bg-green-900 text-white p-12 rounded-xl shadow-2xl">
                    <a href="treasurer/dashboard">
                        <button class="absolute top-2 right-6 text-white text-3xl hover:text-red-500">&times;</button>
                    </a>
        
                    <div class="relative flex justify-center -mt-24">
                        <img id="previewImage" class="w-32 h-32 rounded-full border-4 border-white"
                            src="{{ asset('storage/' . ($profile ? $profile->profile : 'images/default.jpg')) }}"
                            alt="User Profile">
                        <label for="profileImage"
                            class="absolute bottom-1 right-2 bg-gray-800 text-white p-2 rounded-full cursor-pointer">
                            <i class="fas fa-camera"></i>
                        </label>
                    </div>
        
                    <div class="text-center mt-8">
                        <h2 class="text-3xl font-bold">{{ $firstname }} {{ $lastname }}</h2>
                        <p class="text-lg font-semibold">DEPARTMENT {{ $role }}</p>
                        <p class="text-lg">{{ $yearLevel }} - {{ $block }}</p>
                        <p class="text-lg">{{ strtoupper($gender) }}</p>

                    </div>
        
                    <div class="mt-8 text-lg flex flex-col items-center text-center">
                        <p class="font-semibold">
                            USERNAME: <span class="font-normal">{{ $username }}</span>
                        </p>
                    
                        <div class="font-semibold flex items-center justify-center mt-2 text-xl">
                            <span>PASSWORD:</span>
                            <input type="password"
                                class="ml-2 font-normal rounded px-1 py-0.5 text-white text-lg w-[20%] bg-green-900 border-none"
                                value="********" readonly>
                                <a href="#" id="openModalBtn">
                                    <i class="fas fa-edit ml-2 text-white cursor-pointer"></i>
                                  </a>

                        </div>
                    </div>
                    
        
                    <form id="imageUploadForm" action="{{ route('image.upload') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="file" id="profileImage" name="image" class="hidden" onchange="previewImage(event)">
                        <input type="hidden" name="student_id" value="{{ $id }}">

                        <button id="uploadBtn" type="button" class="bg-blue-500 text-white px-4 py-2 rounded-md hidden"
                            onclick="confirmUpload()">
                            Upload Image
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
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
                        document.getElementById("uploadBtn").classList.remove("hidden");
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
                document.getElementById("imageUploadForm").submit(); 
            }
        </script>



<div id="changePasswordModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    
    <div class="bg-green-900 text-white rounded-xl w-full max-w-md shadow-xl p-8 relative">
      
      <button id="closeModalBtn" class="absolute top-4 right-4 text-red-500 hover:text-red-600 text-xl font-bold">&times;</button>

      <h2 class="text-2xl font-bold text-center mb-6">CHANGE PASSWORD</h2>
  
      <div class="flex w-full h-full items-center justify-center ">
        <div class="w-full max-w-md p-6 rounded ">
            @if (session('success'))
                <div class="text-green-500 mb-4">{{ session('success') }}</div>
            @endif
    
            @if (session('error'))
                <div class="text-red-500 mb-4">{{ session('error') }}</div>
            @endif
    
            <form method="POST" action="{{ route('password.Repchange') }}">
                @csrf
                @method('PUT')
    
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold mb-1">Old Password:</label>
                        <input type="password" name="current_password" required
                            class="w-full px-4 py-2 rounded-md text-black border border-gray-300 focus:outline-none focus:ring-2" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1">New Password:</label>
                        <input type="password" name="new_password" required
                            class="w-full px-4 py-2 rounded-md text-black border border-gray-300 focus:outline-none focus:ring-2" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1">Confirm New Password:</label>
                        <input type="password" name="new_password_confirmation" required
                            class="w-full px-4 py-2 rounded-md text-black border border-gray-300 focus:outline-none focus:ring-2" />
                    </div>
                </div>
    
                <div class="mt-6 text-center">
                <button type="submit"
                    class="bg-white text-green-900 font-semibold px-6 py-2 rounded-full shadow-md hover:bg-gray-200">
                    Change Password
                </button>
                </div>
            </form>
        </div>
     </div>
    </div>
 </div>

  <script>
    const openBtn = document.getElementById('openModalBtn');
    const closeBtn = document.getElementById('closeModalBtn');
    const modal = document.getElementById('changePasswordModal');
  
    openBtn.addEventListener('click', function(event) {
      event.preventDefault();
      modal.style.display = 'flex';
    });
  
    closeBtn.addEventListener('click', function() {
      modal.style.display = 'none';
    });
  
    window.addEventListener('click', function(event) {
      if (event.target === modal) {
        modal.style.display = 'none';
      }
    });
  </script>
  
  
  
        

</x-Repre-components.sidebar>
</x-trea-components.content>


{{-- 
                @csrf
                <div id="archiveModalMale" class="fixed inset-0 flex items-center justify-center  hidden">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-96 h-[40%] border-2 border-green-700 flex flex-col justify-center">
                        <div class="flex flex-col items-center">
                            <img class="w-[38%] h-[100%] mb-5" src="{{ asset('images/changepass.PNG') }}"
                            alt="Male Image">
                            <p class="text-red-600 text-center font-semibold">
                                You have requested to change your password.
                                Are you sure you want to proceed?
                               Click "Confirm" to complete the change or "Cancel" to keep your current password.       
                            </p>   
                            <div class="flex mt-10 space-x-4">
                                <button type="button" class="cancelBtn bg-red-600 text-white px-4 py-2 rounded-lg shadow hover:bg-red-700 transition">CANCEL</button>
                                <button type="button" class="confirmBtn bg-gray-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-gray-700">CONFIRM</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="successModalMale" class="fixed inset-0 flex items-center justify-center bg-opacity-50 hidden">
                    <div class="relative bg-white p-6 rounded-lg shadow-lg w-96 h-[40%] border-2 border-green-700 flex flex-col justify-center">
                        <div class="flex flex-col items-center">
                            <img class="w-[38%] h-auto mb-[28%]" src="{{ asset('images/changepass.PNG') }}"
                             alt="Archive Box" class="w-16 h-16 mb-6">
                            
                         
                            <div class="absolute mt-[70px]  transform -translate-x-1/2 checkmark-animate">
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
            </form>
                
                <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const archiveModal = document.getElementById("archiveModalMale");
                    const successModal = document.getElementById("successModalMale");        
                    const confirmButton = archiveModal.querySelector(".confirmBtn");
                    const cancelButton = archiveModal.querySelector(".cancelBtn");
                    const changePasswordBtn = document.getElementById("changePasswordBtn");
                    const successConfirmButton = successModal.querySelector("button[type='submit']");
                    
                    changePasswordBtn.addEventListener("click", function () {
                    archiveModal.classList.remove("hidden");
                });
                            
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
                
        </div>
     </div>
    </div>
 </div>

  <script>
    const openBtn = document.getElementById('openModalBtn');
    const closeBtn = document.getElementById('closeModalBtn');
    const modal = document.getElementById('changePasswordModal');
  

    openBtn.addEventListener('click', function(event) {
      event.preventDefault();
      modal.style.display = 'flex';
    });
  
    closeBtn.addEventListener('click', function() {
      modal.style.display = 'none';
    });
  
    window.addEventListener('click', function(event) {
      if (event.target === modal) {
        modal.style.display = 'none';
      }
    });
  </script>

<script>
    function toggleSubmitButton() {
        const currentPassword = document.getElementById('current_password').value;
        const newPassword = document.getElementById('new_password').value;
        const confirmPassword = document.getElementById('new_password_confirmation').value;
        const button = document.getElementById('changePasswordBtn');

        if (currentPassword && newPassword && confirmPassword) {
            button.disabled = false;
        } else {
            button.disabled = true;
        }
    }

    function checkAndSubmitForm() {
        const newPassword = document.getElementById('new_password').value;
        const confirmPassword = document.getElementById('new_password_confirmation').value;

        if (newPassword !== confirmPassword) {
            alert("The new password and confirmation password do not match.");
        } else {
            document.getElementById('passwordChangeForm').submit();
        }
    }

    document.getElementById('current_password').addEventListener('input', toggleSubmitButton);
    document.getElementById('new_password').addEventListener('input', toggleSubmitButton);
    document.getElementById('new_password_confirmation').addEventListener('input', toggleSubmitButton);

    toggleSubmitButton();
</script>
   --}}
        
        
