@extends('layouts.master')
@section('title', 'Role List')

@section('content')
    <div class="antialiased bg-gray-50 dark:bg-gray-900">

        <main class="p-4 h-auto pt-20 md:ml-64 ">
            <h1 class="font-bold text-xl">Role List</h1>
            <div class="mx-auto max-w-screen-xl md:p-6 lg:px-12">
                <!-- Start coding here -->
                <div class=" bg-white dark:bg-gray-800 relative shadow-md md:rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        @if (showContent('Role', 'create'))
                            <div
                                class="w-full p-2 md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center  md:space-x-3 flex-shrink-0">

                                <a href="{{ route('roles.create') }}"
                                    class="flex items-center justify-center  text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2 text-center mr-2"><svg
                                        class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                    </svg>Add Role</a>
                            </div>
                        @endif


                    </div>
                    {{-- Table --}}
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                            <thead class="text-xs  text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-4">Role Name</th>
                                    <th scope="col" class="px-6 py-4">Permission</th>
                                    <th scope="col" class="px-6 py-4">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            @foreach ($roles as $role)
                                <tbody>
                                    <tr class="border-b dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $role->name }}
                                        </th>

                                        <td class="px-6 py-4 flex flex-wrap">
                                            @foreach ($features as $feature)
                                                <div class="flex items-center me-4 ">
                                                    <h2>{{ $feature->name }}</h2>
                                                    @foreach ($role->permissions as $permission)
                                                        @if ($permission->feature_id == $feature->id)
                                                            <div class="px-2 m-1 text-white bg-blue-300 rounded-full">
                                                                {{ $permission->name }}
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class=" rounded-md inline-flex  shadow-sm ">
                                                @if (showContent('Role', 'edit'))
                                                    <a href="
                                                {{ route('roles.edit', $role->id) }}
                                                "
                                                        class="px-3 py-2  text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 rounded-l-lg hover:bg-green-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-green-400 dark:focus:ring-blue-500 dark:focus:text-white">
                                                        Edit
                                                    </a>
                                                @endif
                                                @if (showContent('Role', 'delete'))
                                                    <div
                                                        class=" px-3 py-2  text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-red-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-red-500 dark:focus:ring-blue-500 dark:focus:text-white">
                                                        <form action="{{ route('roles.destroy', $role->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="submit" value="Delete">
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            @endforeach

                        </table>
                    </div>
                </div>
        </main>
    </div>
@endsection
