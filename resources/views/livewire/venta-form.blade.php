<div class="p-8 bg-gray-100 min-h-screen text-gray-900">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-xl border border-gray-300">
        
        @if (session()->has('message'))
            <div class="p-4 mb-6 text-white bg-green-600 rounded-md font-bold text-center">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="save">
            <div class="mb-8">
                <h3 class="text-2xl font-bold text-blue-700 mb-4 border-b-2 border-blue-500 pb-2">Datos del Cliente</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700">Nombre y Apellido</label>
                        <input type="text" wire:model="name" class="mt-1 block w-full bg-white text-gray-900 rounded-md border-2 border-gray-400 p-3 focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700">D.N.I.</label>
                        <input type="text" wire:model="dni" class="mt-1 block w-full bg-white text-gray-900 rounded-md border-2 border-gray-400 p-3 focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700">Teléfono</label>
                        <input type="text" wire:model="phone" class="mt-1 block w-full bg-white text-gray-900 rounded-md border-2 border-gray-400 p-3 focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700">Dirección</label>
                        <input type="text" wire:model="address" class="mt-1 block w-full bg-white text-gray-900 rounded-md border-2 border-gray-400 p-3 focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-2xl font-bold text-blue-700 mb-4 border-b-2 border-blue-500 pb-2">Datos de la Venta</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700">Artículo / Vehículo</label>
                        <input type="text" wire:model="article" class="mt-1 block w-full bg-white text-gray-900 rounded-md border-2 border-gray-400 p-3 focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700">Valor Total ($)</label>
                        <input type="number" wire:model="total_value" class="mt-1 block w-full bg-white text-gray-900 rounded-md border-2 border-gray-400 p-3 focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700">Entrega Inicial ($)</label>
                        <input type="number" wire:model="down_payment" class="mt-1 block w-full bg-white text-gray-900 rounded-md border-2 border-gray-400 p-3 focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700">Cantidad de Cuotas</label>
                        <input type="number" wire:model="installments_count" class="mt-1 block w-full bg-white text-gray-900 rounded-md border-2 border-gray-400 p-3 focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-800 text-white font-black py-4 px-6 rounded-lg shadow-lg uppercase tracking-widest text-lg transition duration-200">
                Guardar y Generar Cuotas
            </button>
        </form>
    </div>
</div>