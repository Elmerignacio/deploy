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
        const tbody = document.querySelector("#usersTableBody");
        const rows = Array.from(tbody.querySelectorAll("tr"));
        const noStudentsRow = document.getElementById("noStudentsRow");

        searchInput.addEventListener("keyup", function () {
            const searchTerms = searchInput.value.toLowerCase().trim().split(/\s+/);
            let matchFound = false;

            rows.forEach(row => {
                if (row.id === "noStudentsRow") return;

                const idNumber = row.children[0]?.textContent.toLowerCase().trim() || "";
                const lastName = row.children[1]?.textContent.toLowerCase().trim() || "";
                const firstName = row.children[2]?.textContent.toLowerCase().trim() || "";
                const yearLevel = (row.getAttribute("data-yearlevel") || "").toLowerCase().trim();
                const block = (row.getAttribute("data-block") || "").toLowerCase().trim();

                const combinedText = `${idNumber} ${firstName} ${lastName} ${yearLevel} ${block}`;

                const isMatch = searchTerms.every(term => combinedText.includes(term));

                if (isMatch) {
                    row.style.display = "";
                    matchFound = true;
                } else {
                    row.style.display = "none";
                }
            });

            if (noStudentsRow) {
                noStudentsRow.style.display = matchFound ? "none" : "";
            }
        });
    });
</script>

