@extends('layouts.master')

@section('title', 'Edit Role')

@section('content')

    <section class="bg-gray-50 dark:bg-gray-900 lg:h-full">
        <div class="md:ml-64 pt-20 h-auto p-2">
            <div class="rounded-lg p-2 bg-white dark:bg-gray-800 relative shadow-md overflow-hidden">
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 mb-4 sm:grid-cols-3">
                        <div>
                            <label for="role-name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="text" name="role-name" id="role-name" value="{{ $role->name }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type role name" required="">
                        </div>

                        <div class="flex pt-3">
                            <div class="flex items-center me-4">
                                <input id="create-user-checkbox" type="checkbox" name="permissions[]" value="view-any"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="create-user-checkbox"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">view</label>
                            </div>
                            <div class="flex items-center me-4">
                                <input id="create-user-checkbox" type="checkbox" name="permissions[]" value="create"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="create-user-checkbox"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">create</label>
                            </div>
                            <div class="flex items-center me-4">
                                <input id="edit-user-checkbox" type="checkbox" name="permissions[]" value="edit"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="edit-user-checkbox"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">edit</label>
                            </div>
                            <div class="flex items-center me-4">
                                <input id="delete-user-checkbox" type="checkbox" name="permissions[]" value="delete"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="delete-user-checkbox"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">delete</label>
                            </div>
                        </div>

                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Update Role
                    </button>
                </form>

            </div>
        </div>
    </section>

@endsection

@section('script')

@endsection
