<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Usuarios y roles</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto px-4">
        @if (session('exito'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('exito') }}</div>
        @endif

        <a href="{{ route('usuarios.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded">
            Nuevo usuario
        </a>

        <table class="w-full bg-white shadow rounded">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-3">Nombre</th>
                    <th class="p-3">Correo</th>
                    <th class="p-3">Rol</th>
                    <th class="p-3 w-40">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr class="border-t">
                        <td class="p-3">{{ $usuario->name }}</td>
                        <td class="p-3">{{ $usuario->email }}</td>
                        <td class="p-3">{{ $usuario->roles->pluck('name')->join(', ') ?: 'Sin rol' }}</td>
                        <td class="p-3 space-x-2">
                            <a href="{{ route('usuarios.edit', $usuario) }}" class="text-blue-600">Editar</a>
                            <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" class="inline"
                                  onsubmit="return confirm('¿Eliminar este usuario?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">{{ $usuarios->links() }}</div>
    </div>
</x-app-layout>