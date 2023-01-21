<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-auth-validation-errors></x-auth-validation-errors>
                    <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="grid grid-cols-2 gap-4">

                            <div>
                                <x-label for="name" :value="__('Nombre')" />

                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" autofocus placeholder="Nombre del usuario" />
                            </div>

                            <div>
                                <x-label for="roles_ids" :value="__('Tipo de usuario')" />

                                @foreach ($roles as $role)
                                    <label class="block"><input  name="roles_ids[]" type="checkbox" value="{{ $role->id }}" {{ (in_array($role->id, (array) old('roles_ids')) || $role->id == $user->roles->contains($role)) ? 'checked' : '' }}>
                                        @if ($role->name == "personal")
                                            Staff
                                        @else
                                            {{ ucfirst($role->name) }}
                                        @endif
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <x-button class="mt-4">Actualizar</x-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>