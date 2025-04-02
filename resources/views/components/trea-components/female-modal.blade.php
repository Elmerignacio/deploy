

@csrf
<div id="archiveModalFemale" class="fixed inset-0 flex items-center justify-center  hidden">
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


<div id="successModalFemale" class="fixed inset-0 flex items-center justify-center  hidden">
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

        var selectedGender = document.querySelector('input[name="gender"]:checked');
    
        if (selectedGender) {
            var gender = selectedGender.value;
            
            if (gender === "MALE") {
                document.getElementById("archiveModalMale").classList.remove("hidden");
            } else if (gender === "FEMALE") {
                document.getElementById("archiveModalFemale").classList.remove("hidden");
            }
        }
    });
    
    document.querySelectorAll(".cancelBtn").forEach(button => {
        button.addEventListener("click", function () {
            document.getElementById("archiveModalMale").classList.add("hidden");
            document.getElementById("archiveModalFemale").classList.add("hidden");
        });
    });
    </script>
