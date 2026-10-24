<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar usuario</h2>
    </x-slot>

    <div class="py-6 max-w-lg mx-auto px-4">
        <form action="{{ route('usuarios.update', $usuario) }}" method="POST" class="bg-white p-6 shadow rounded">
            @csrf
            @method('PUT')

            <label class="block mb-1 font-medium">Nombre</label>
            <input type="text" name="name" value="{{ old('name', $usuario->name) }}" class="w-full border rounded p-2 mb-1">
            @error('name') <p class="text-red-600 text-sm mb-2">{{ $message }}</p> @enderror

            <label class="block mb-1 font-medium mt-3">Correo</label>
            <input type="email" name="email" value="{{ old('email', $usuario->email) }}" class="w-full border rounded p-2 mb-1">
            @error('email') <p class="text-red-600 text-sm mb-2">{{ $message }}</p> @enderror

            <label class="block mb-1 font-medium mt-3">Rol</label>
            <select name="rol" class="w-full border rounded p-2 mb-1">
                <option value="">-- Selecciona --</option>
                @foreach ($roles as $rol)
                    <option value="{{ $rol->name }}" @selected(old('rol', $usuario->roles->first()->name ?? '') == $rol->name)>
                        {{ $rol->name }}
                    </option>
                @endforeach
            </select>
            @error('rol') <p class="text-red-600 text-sm mb-2">{{ $message }}</p> @enderror

            <div class="mt-4 flex gap-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Actualizar</button>
                <a href="{{ route('usuarios.index') }}" class="px-4 py-2 bg-gray-200 rounded">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout>