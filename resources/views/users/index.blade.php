<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <div>
                        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                                <table class="min-w-full leading-normal">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Nombre
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Tipo
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Servicios
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Creado el
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <div class="flex items-center">
                                                            <div class="ml-3">
                                                                <p class="text-gray-900 whitespace-no-wrap">
                                                                    {{$user->name}}
                                                                </p>
                                                                <p class="block text-xs text-green-900">{{ $user->email }}</p>
                                                            </div>
                                                        </div>
                                                </td>
                                                <td class="max-w-[10rem] px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    @foreach ($user->roles as $role)
                                                        <span class="relative inline-block mb-1 px-3 py-1 font-semibold text-green-900 leading-tight">
                                                            <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                            <span class="relative">
                                                                @if ($role->name == "personal")
                                                                    Staff
                                                                @else
                                                                    {{ $role->name }}
                                                                @endif
                                                            </span>
                                                        </span>
                                                    @endforeach
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    @foreach ($user->services as $service)
                                                        <p class="text-gray-900 whitespace-no-wrap border-green-300 border-l-2 mt-1">
                                                                {{$service->name}}
                                                        </p>
                                                        
                                                    @endforeach
                                                </td>
                                                
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <span
                                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                        <span aria-hidden
                                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                    <span class="relative">{{$user->created_at->isoFormat('dddd Do MMMM YYYY')}}</span>
                                                    </span>
                                                </td>
                                                
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <x-link href="{{ route('users.edit', ['user' => $user]) }}">Editar</x-link>
                                                    @if ($user->roles[0]->name !== 'cliente')
                                                        <x-link href="{{ route('users-services.edit', ['user' => $user]) }}">Servicios</x-link>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div
                                    {!! $users->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>