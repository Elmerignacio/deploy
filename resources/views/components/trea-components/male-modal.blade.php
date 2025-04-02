
@csrf
<div id="archiveModalMale" class="fixed inset-0 flex items-center justify-center  hidden">
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

<div id="successModalMale" class="fixed inset-0 flex items-center justify-center bg-opacity-50 hidden">
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
