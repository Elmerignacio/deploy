<x-trea-components.layout/>
<x-trea-components.header/>
<x-trea-components.content>
<x-trea-components.sidebar>
    
    <div>
        <h2 class="text-3xl font-bold">{{$firstname}} {{$lastname}}</h2>
        <p class="text-gray-600 text-sm">DEPARTMENT {{$role}}</p>
    </div>

    <div class="grid lg:grid-cols-3 md:grid-cols-3 gap-4 mt-6">

        <div class="bg-green-500 text-white p-6 rounded-lg shadow-lg text-center ">
            <div class="flex justify-center mt-[15px]">
                <img src="https://scontent.fmnl13-3.fna.fbcdn.net/v/t1.15752-9/478304506_657320803628371_1979724036374650860_n.png?_nc_cat=101&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeE_r0Cbp7WV8wxL_k3GCBkwUTyeHKcG5X1RPJ4cpwblfSPVz4wbtnbg2xQ_YYgpWF6BR00MCOWBimyVqK6wgdCY&_nc_ohc=Z93o9pQtEtkQ7kNvgFxVI7j&_nc_oc=AdlwGb6wkI2KJAYssdGJLidpwKjXVHHiOvFRl5KlR9N6ofIJ-tGOtC5yzbx7r-LNrc-UEQmDqch02nqMAtegPUM9&_nc_zt=23&_nc_ht=scontent.fmnl13-3.fna&oh=03_Q7cD1wFFzlRZ5DnAnK5RN5IQefnzA7u9DNrYGnbtR9Axj3c34Q&oe=6801FE4F"
                class="w-[30%] h-[30%]" alt="Cash on Hand">
              
            <p class="font-bold text-[20px] flex place-items-center mt-2"  style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">CASH ON HAND</p> 
            </div>
            <p class="text-3xl font-bold"  style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">₱0.00</p>
        </div>

        <div class="bg-red-500 text-white p-6 rounded-lg shadow-lg text-center ">
            <div class="flex justify-center mt-[15px]">
                <img src="https://scontent.sfcgy2-1.fna.fbcdn.net/v/t1.15752-9/481574582_3363874913752849_8300719159033548285_n.png?_nc_cat=100&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeFDBs97aEM9rUPsvJFytt_X5NjT8FOe5Uzk2NPwU57lTKdYes4ga_YQw_wx58snXLUcH-BFRaoiMnJGwxdr9UXt&_nc_ohc=zMarWMJf44sQ7kNvgHVH1Qu&_nc_oc=AdjibbLaUUT2Munq58lH065JcPmGFYfPULvpPFgMKVYmkGRGsimd4yAFrxuJJdUU3fzdkdpDNamTiLXirJblisal&_nc_zt=23&_nc_ht=scontent.fcgy2-1.fna&oh=03_Q7cD1gFyMDi1JpxobuG-v8oSdZ1bYzGDYq61ssofNYY7LIYJiw&oe=67EE0ADD"
                class="w-[30%] h-[30%]" alt="Expenses">
              
            <p class="font-bold text-[20px] flex place-items-center mt-2"  style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">EXPENSES</p> 
            </div>
            <p class="text-3xl font-bold"  style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">₱0.00</p>
        </div>

        <div class="bg-yellow-500 text-white p-6 rounded-lg shadow-lg text-center ">
        <div class="flex justify-center mt-[15px]">
        <img src="https://scontent.fcgy1-3.fna.fbcdn.net/v/t1.15752-9/480440311_2015779438940893_3746088750876481447_n.png?_nc_cat=111&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeFvcMBuzZshz9vZxAqaA6xQ42Gw-PQi4PzjYbD49CLg_MFnX156d_Bz_J4H_NTdozmDqL3P5g64A4fkavZifE5N&_nc_ohc=9XmWzCJWq_4Q7kNvgH2TYxC&_nc_oc=AdnrNUWjY67-iAzWggnpJOwRSymfUWt284vjnWQWYCzP6HNIsXejdSOT5nncGjB2m7EyFPhElN_c9WWKeenwRSdE&_nc_zt=23&_nc_ht=scontent.fcgy1-3.fna&oh=03_Q7cD1wGNVIL8CgW3ZBMHxo4xnoNqc1mitkBJb3WAzaOsrdJKwg&oe=680220BA"
        class="w-[20%] h-[20%]" alt="Receivables">
        
        <p class="font-bold text-[20px] flex place-items-center mt-2"  style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">RECEIVABLE</p> 
        </div>
        <p class="text-3xl font-bold"  style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">₱172,000,000</p>
        </div>  
    </div>



<!-- Payables Table -->
<div class="mt-6 pb-5">
    <h3 class="text-lg font-bold mb-4">STUDENTS PAYABLES</h3>
    <table class="w-full border-collapse border border-gray-300">
        <thead class="bg-gray-200">
            <tr class="text-left">
                <th class="border border-gray-300 p-2">DESCRIPTION</th>
                <th class="border border-gray-300 p-2">AMOUNT</th>
                <th class="border border-gray-300 p-2">EXPECTED RECEIVABLE</th>
                <th class="border border-gray-300 p-2">DUE DATE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border border-gray-300 p-2">SEMESTRAL DUE</td>
                <td class="border border-gray-300 p-2">₱250.00</td>
                <td class="border border-gray-300 p-2">₱75,000.00</td>
                <td class="border border-gray-300 p-2">MAY 20, 2025</td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">SINULOG FESTIVAL</td>
                <td class="border border-gray-300 p-2">₱300.00</td>
                <td class="border border-gray-300 p-2">₱90,000.00</td>
                <td class="border border-gray-300 p-2">JANUARY 10, 2025</td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">FINES</td>
                <td class="border border-gray-300 p-2">₱25.00</td>
                <td class="border border-gray-300 p-2">₱7,500.00</td>
                <td class="border border-gray-300 p-2">MAY 20, 2025</td>
            </tr>
        </tbody>
    </table>
</div>	
</div>

</x-trea-components.sidebar>
</x-trea-components.content>
        
       
           
   
   
