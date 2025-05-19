<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invoice') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{route('invoice.create')}}" class="text-blue-500 hover:text-blue-700">Add New Invoice</a>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200" id="invoiceTable">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice #</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script>
        function loadInvoice(page = 1) {
               fetch(`crud/invoice?page=${page}`)
                   .then(response => response.json())
                   .then(response => {
                       const tbody = document.querySelector('#invoiceTable tbody');
                       tbody.innerHTML = '';

                       response.data.forEach(invoice => {
                           tbody.innerHTML += `
                               <tr>
                                   <td class="px-6 py-4 whitespace-nowrap">${invoice.id}</td>
                                   <td class="px-6 py-4 whitespace-nowrap">${invoice.amount}</td>
                                   <td class="px-6 py-4 whitespace-nowrap">${invoice.date}</td>
                                   <td class="px-6 py-4 whitespace-nowrap">${invoice.customer.name}</td>
                                      <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="/invoice/${invoice.id}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                    </td>

                               </tr>
                           `;
                       });

                       // Add pagination
                       const paginationDiv = document.createElement('div');
                       paginationDiv.className = 'flex justify-center mt-4 space-x-2';
                       paginationDiv.innerHTML = response.links.map(link => `
                           <button class="px-3 py-1 border rounded ${link.active ? 'bg-blue-500 text-red' : 'bg-white text-blue-500'}"
                                   ${link.url ? `onclick="loadInvoice(${link.url.split('page=')[1]})"` : 'disabled'}
                                   ${!link.url ? 'style="opacity: 0.5;"' : ''}>
                               ${link.label.replace('&laquo;', '«').replace('&raquo;', '»')}
                           </button>
                       `).join('');

                       // Replace existing pagination if any
                       const existingPagination = document.querySelector('.pagination-container');
                       if (existingPagination) {
                           existingPagination.innerHTML = '';
                           existingPagination.appendChild(paginationDiv);
                       } else {
                           const container = document.createElement('div');
                           container.className = 'pagination-container';
                           container.appendChild(paginationDiv);
                           document.querySelector('#invoiceTable').after(container);
                       }
                   })
                   .catch(error => console.error('Error:', error));
           }

       document.addEventListener('DOMContentLoaded', function() {

        loadInvoice();
       });
   </script>


</x-app-layout>
