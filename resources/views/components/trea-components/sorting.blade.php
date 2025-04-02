<div class="flex flex-wrap md:flex-nowrap items-center justify-between mt-4 space-y-2 md:space-y-0">
    <div class="flex items-center border border-black rounded-lg p-2 w-full md:w-72">
        <input type="text" placeholder="Search..." class="w-full outline-none px-2"/>
        <button class="text-gray-500 hover:text-gray-700">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </div>

    {{$slot}}
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.querySelector("input[type='text']");
        const table = document.querySelector("table");
        const tbody = table.querySelector("tbody");
        const rows = Array.from(tbody.querySelectorAll("tr"));
    
        searchInput.addEventListener("keyup", function () {
            const filter = searchInput.value.toLowerCase().trim();
            
            rows.forEach(row => {
                let textContent = "";
                
                for (let i = 1; i < row.children.length - 1; i++) {
                    textContent += row.children[i].textContent.toLowerCase() + " ";
                }
    
                if (textContent.includes(filter)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    
    });
</script>
  