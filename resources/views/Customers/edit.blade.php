<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form class="space-y-4" id="customerForm" onsubmit="submitForm(event)">
                        @csrf

                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" value="{{ $customer->name }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ $customer->email }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div class="space-y-2">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="text" name="phone" id="phone" value="{{ $customer->phone }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label for="address1" class="block text-sm font-medium text-gray-700">Address 1</label>
                                <input type="text" name="address1" id="address1" value="{{ $customer->address }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div class="space-y-2">
                                <label for="address2" class="block text-sm font-medium text-gray-700">Address 2</label>
                                <input type="text" name="address2" id="address2" value="{{ $customer->address2 }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-4 gap-4">
                            <div class="space-y-2">
                                <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                <input type="text" name="city" id="city" value="{{ $customer->city }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div class="space-y-2">
                                <label for="state" class="block text-sm font-medium text-gray-700">State</label>
                                <input type="text" name="state" id="state" value="{{ $customer->state }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div class="space-y-2">
                                <label for="postal_code" class="block text-sm font-medium text-gray-700">Postal Code</label>
                                <input type="text" name="postal_code" id="postal_code" value="{{ $customer->postal_code }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div class="space-y-2">
                                <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                                <input type="text" name="country" id="country" value="{{ $customer->country }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        async function submitForm(event) {
            event.preventDefault();
            const form = document.getElementById('customerForm');
            const formData = new FormData(form);
            const csrfToken = document.querySelector('input[name="_token"]').value;

            try {
                const response = await fetch('/crud/customer/{{ $customer->id }}', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(Object.fromEntries(formData))
                });

                const result = await response.json();

                if (result.status === false) {
                    alert('Error: ' + result.errorMsg); // Show the specific error message
                    return;
                }

                alert('Updated!'); // Show success message
                window.location.reload();

            } catch (error) {
                console.error('Error:', error);
                alert('Error: ' + error.message); // Show the actual error message
            }
        }


    </script>

</x-app-layout>
