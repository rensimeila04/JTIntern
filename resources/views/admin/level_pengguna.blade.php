@extends('layout.template')
@section('content')
    <div class="container mx-auto bg-white rounded-xl p-4">
        {{-- sec1 --}}
        <div class="gap-4 flex justify-between w-full items-center">
            <div>
                <h2 class="text-xl font-medium items-center">Level Pengguna</h2>
            </div>
            <div class="flex gap-x-3 ">
                <div class="relative flex rounded-lg">
                    <input type="search"
                        class="w-96 py-1.5 sm:py-2 px-4 ps-10 block  border-gray-200 rounded-lg sm:text-sm disabled:opacity-50 bg-white gray:border-neutral-700"
                        placeholder="Cari level...">
                    <div class="absolute inset-y-0 flex left-3 items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m21 21-4.34-4.34" />
                            <circle cx="11" cy="11" r="8" />
                        </svg>
                    </div>
                </div>

                <div class="flex">
                    <button type="button"
                        class="w-30 py-2 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border bg-primary-500 text-white hover:bg-primary-600 focus:outline-hidden focus:bg-primary-600 disabled:opacity-50 disabled:pointer-events-none">
                        + Tambah Level
                    </button>
                </div>
            </div>

        </div>

        <div class="flex flex-col mt-6">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border border-gray-200 rounded-lg overflow-hidden gray:border-neutral-700">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 gray:bg-neutral-800">
                                <tr>
                                    <th scope="col" class="w-10 px-6 py-3 text-center text-xs font-medium text-gray-500">ID
                                    </th>
                                    <th scope="col" class="w-24 px-6 py-3 text-start text-xs font-medium text-gray-500">Kode
                                    </th>
                                    <th scope="col" class="w-auto px-6 py-3 text-start text-xs font-medium text-gray-500">
                                        Nama Level</th>
                                    <th scope="col" class="w-48 px-6 py-3 text-start text-xs font-medium text-gray-500">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr class="hover:bg-gray-100 gray:hover:bg-neutral-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-black">1
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-gray-200 bg-white text-gray-500 shadow-2xs">ADM</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black">Admin</td>
                                    <td class="gap-2 flex px-6 py-4 whitespace-nowrap text-sm font-medium text-black">
                                        <button type="button"
                                            class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-primary-500 hover:bg-gray-200 focus:outline-hidden border border-primary-500 disabled:opacity-50 disabled:pointer-events-none">
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M9.04165 1.16699H5.01665C4.78331 1.16699 4.54998 1.28366 4.37498 1.45866C4.19998 1.63366 4.08331 1.86699 4.08331 2.10033V9.56699C4.08331 9.80033 4.19998 10.0337 4.37498 10.2087C4.54998 10.3837 4.78331 10.5003 5.01665 10.5003H10.7333C10.9666 10.5003 11.2 10.3837 11.375 10.2087C11.55 10.0337 11.6666 9.80033 11.6666 9.56699V3.79199L9.04165 1.16699Z"
                                                    stroke="#4C956C" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M1.75 4.43359V11.9003C1.75 12.1336 1.86667 12.3669 2.04167 12.5419C2.21667 12.7169 2.45 12.8336 2.68333 12.8336H8.4"
                                                    stroke="#4C956C" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M8.75 1.16699V4.08366H11.6667" stroke="#4C956C"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                        <button type="button"
                                            class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-warning-500 hover:bg-gray-200 focus:outline-hidden border border-warning-500 disabled:opacity-50 disabled:pointer-events-none">
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M2.33331 7.87533V2.33366C2.33331 2.02424 2.45623 1.72749 2.67502 1.5087C2.89381 1.28991 3.19056 1.16699 3.49998 1.16699H8.45831L11.6666 4.37533V11.667C11.6666 11.9764 11.5437 12.2732 11.3249 12.4919C11.1061 12.7107 10.8094 12.8337 10.5 12.8337H7.29165"
                                                    stroke="#F2A10E" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M8.16669 1.16699V4.66699H11.6667" stroke="#F2A10E"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M6.07831 7.35588C6.19207 7.24212 6.32712 7.15189 6.47575 7.09032C6.62438 7.02876 6.78369 6.99707 6.94456 6.99707C7.10544 6.99707 7.26474 7.02876 7.41337 7.09032C7.56201 7.15189 7.69706 7.24212 7.81081 7.35588C7.92457 7.46964 8.01481 7.60469 8.07637 7.75332C8.13794 7.90195 8.16963 8.06126 8.16963 8.22213C8.16963 8.38301 8.13794 8.54231 8.07637 8.69094C8.01481 8.83958 7.92457 8.97463 7.81081 9.08838L4.63748 12.25L2.33331 12.8334L2.91081 10.5292L6.07831 7.35588Z"
                                                    stroke="#F2A10E" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                        <button type="button"
                                            class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-white text-error-500 hover:bg-gray-200 focus:outline-hidden border border-error-500 disabled:opacity-50 disabled:pointer-events-none">
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.75 3.5H12.25" stroke="#F44336" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M11.0834 3.5V11.6667C11.0834 12.25 10.5 12.8333 9.91669 12.8333H4.08335C3.50002 12.8333 2.91669 12.25 2.91669 11.6667V3.5"
                                                    stroke="#F44336" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M4.66669 3.50033V2.33366C4.66669 1.75033 5.25002 1.16699 5.83335 1.16699H8.16669C8.75002 1.16699 9.33335 1.75033 9.33335 2.33366V3.50033"
                                                    stroke="#F44336" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M5.83331 6.41699V9.91699" stroke="#F44336" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M8.16669 6.41699V9.91699" stroke="#F44336" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection