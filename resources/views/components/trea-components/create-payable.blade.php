
<div id="createUserModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="flex flex-col items-center">
        <div class="bg-green-900 text-white w-full max-w-[90%] md:w-[600px] lg:w-[800px] xl:w-[600px] rounded-lg shadow-lg mt-10">


            <div class="p-6 rounded-lg w-full max-w-4xl relative"> 
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-center flex-1 ml-[30px]">CREATE PAYABLE</h3>
                    <x-trea-components.exit-btn-modal/>
                </div>
                    
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

                   {{$slot}}
                   
                    <div>
                        <label class="block mb-1 text-sm font-semibold">BLOCK:</label>
                        <select id="block" name="block" class="w-full p-2 rounded-md text-black border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                            <option value="">SELECT BLOCK</option>
                            <option value="all">ALL BLOCK</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-semibold">STUDENT:</label>
                        <select id="student" name="IDNumber" class="w-full p-2 rounded-md text-black border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                            <option value="">SELECT STUDENT</option>
                            <option value="all">ALL STUDENTS</option>
                        </select>
                    </div>
                    <div class="text-center mt-5">
                        <button type="submit" class="bg-green-700 px-4 py-2 rounded-md hover:bg-green-600 text-white font-bold">ADD PAYABLE</button>
                    </div>
               
                
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
                                    studentDropdown.innerHTML += `<option value="${student.IDNumber}">${student.firstname.toUpperCase()} ${student.lastname.toUpperCase()}</option>`;
                                });
                            });
                        });
                    </script>

                </form>
            </div>
        </div>
    </div>
</div>
