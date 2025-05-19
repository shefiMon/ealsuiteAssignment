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
                    <form class="space-y-4" id="invoiceForm" onsubmit="submitForm(event)">
                        @csrf
                        <div>
                            <label for="customer_id" class="block text-sm font-medium text-gray-700">Customer</label>
                            <select id="customer_id" required name="customer_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Select Customer</option>
                               @php
                                    $customers = \App\Modules\Customers\Models\Customer::orderBy('id', 'desc')->get();
                               @endphp
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ $invoice->customer_id == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                            <input type="number" required step="0.01" name="amount" id="amount"
                                value="{{ $invoice->amount }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                            <input required type="date" name="date" id="date"
                                value="{{ $invoice->date }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="paid" {{ $invoice->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="unpaid" {{ $invoice->status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                <option value="cancelled" {{ $invoice->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>

                        <div class="flex justify-end">
                        <button class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Update Invoice
                        </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

        async function submitForm(event) {
            event.preventDefault();
            const form = document.getElementById('invoiceForm');
            const formData = new FormData(form);

            try {
            const response = await fetch('/crud/invoice/{{$invoice->id}}', {
                method: 'PUT',
                headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(Object.fromEntries(formData))
            });

            const result = await response.json();

            if (result.status === false) {
                alert(result.errorMsg);
                return;
            }
            alert('Invoice updated');
            window.location.reload();
            } catch (error) {
            console.error('Error:', error);
            alert('There was a problem creating the invoice');
            }
        }


    </script>

</x-app-layout>
