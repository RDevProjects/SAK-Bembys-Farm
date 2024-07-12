@extends('layout.default')
@section('content')
    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-x-6 gap-x-0 lg:gap-y-0 gap-y-6">
        <div class="col-span-2">
            <div class="card">
                <div class="card-body">
                    <div class="sm:flex block justify-between mb-5">
                        <h4 class="text-gray-600 text-lg font-semibold sm:mb-0 mb-2">Sales Overview
                        </h4>
                    </div>
                    <div class="">
                        <div class="grid grid-cols-3 gap-4">
                            <a href="{{ route('laporan-jurnal-umum') }}" target="_blank"
                                class="bg-blue-700 text-white font-bold py-2 px-4 my-3 rounded">Laporan Jurnal Umum</a>
                            <a href="{{ route('laporan-buku-besar') }}" target="_blank"
                                class="bg-blue-700 text-white font-bold py-2 px-4 my-3 rounded">Laporan Buku Besar</a>
                            <a href="{{ route('laporan-neraca-saldo') }}" target="_blank"
                                class="bg-blue-700 text-white font-bold py-2 px-4 my-3 rounded">Laporan Neraca Saldo</a>
                            <a href="{{ route('laporan-laba-rugi') }}" target="_blank"
                                class="bg-blue-700 text-white font-bold py-2 px-4 my-3 rounded">Laporan Laba Rugi</a>
                            <a href="{{ route('laporan-perubahan-modal') }}" target="_blank"
                                class="bg-blue-700 text-white font-bold py-2 px-4 my-3 rounded">Laporan Perubahan Modal</a>
                            <a href="#" target="_blank"
                                class="bg-blue-700 text-white font-bold py-2 px-4 my-3 rounded">Laporan Neraca</a>
                            <a href="#" target="_blank"
                                class="bg-blue-700 text-white font-bold py-2 px-4 my-3 rounded">Laporan 7</a>
                            <a href="#" target="_blank"
                                class="bg-blue-700 text-white font-bold py-2 px-4 my-3 rounded">Laporan 8</a>
                            <a href="#" target="_blank"
                                class="bg-blue-700 text-white font-bold py-2 px-4 my-3 rounded">Laporan 9</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col gap-6">
        <div class="card">
            <div class="card-body">
                <h4 class="text-gray-600 text-lg font-semibold mb-5">Yearly Breakup</h4>
                <div class="flex gap-6 items-center justify-between">
                    <div class="flex flex-col gap-4">
                        <h3 class="text-[21px] font-semibold text-gray-600">$36,358</h3>
                        <div class="flex items-center gap-1">
                            <span class="flex items-center justify-center w-5 h-5 rounded-full bg-teal-400">
                                <i class="ti ti-arrow-up-left text-teal-500"></i>
                            </span>
                            <p class="text-gray-600 text-sm font-normal ">+9%</p>
                            <p class="text-gray-500 text-sm font-normal text-nowrap">last year
                            </p>
                        </div>
                        <div class="flex">
                            <div class="flex gap-2 items-center">
                                <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                                <p class="text-gray-500 font-normal text-xs">2023</p>
                            </div>
                            <div class="flex gap-2 items-center">
                                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                <p class="text-gray-500 font-normal text-xs">2023</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex  items-center">
                        <div id="breakup"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex gap-6 items-center justify-between">
                    <div class="flex flex-col gap-5">
                        <h4 class="text-gray-600 text-lg font-semibold">Monthly Earnings</h4>
                        <div class="flex flex-col gap-[18px]">
                            <h3 class="text-[21px] font-semibold text-gray-600">$6,820</h3>
                            <div class="flex items-center gap-1">
                                <span class="flex items-center justify-center w-5 h-5 rounded-full bg-red-400">
                                    <i class="ti ti-arrow-down-right text-red-500"></i>
                                </span>
                                <p class="text-gray-600 text-sm font-normal ">+9%</p>
                                <p class="text-gray-500 text-sm font-normal">last year</p>
                            </div>
                        </div>
                    </div>

                    <div class="w-11 h-11 flex justify-center items-center rounded-full bg-cyan-500 text-white self-start">
                        <i class="ti ti-currency-dollar text-xl"></i>
                    </div>

                </div>
            </div>
            <div id="earning"></div>
        </div>
    </div>


    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-x-6 gap-x-0 lg:gap-y-0 gap-y-6">
        <div class="card">
            <div class="card-body">
                <h4 class="text-gray-600 text-lg font-semibold mb-6">Recent Transactions</h4>
                <ul class="timeline-widget relative">
                    <li class="timeline-item flex relative overflow-hidden min-h-[70px]">
                        <div class="timeline-time text-gray-600 text-sm min-w-[90px] py-[6px] pr-4 text-end">
                            9:30 am
                        </div>
                        <div class="timeline-badge-wrap flex flex-col items-center ">
                            <div
                                class="timeline-badge w-3 h-3 rounded-full shrink-0 bg-transparent border-2 border-blue-600 my-[10px]">
                            </div>
                            <div class="timeline-badge-border block h-full w-[1px] bg-gray-100">
                            </div>
                        </div>
                        <div class="timeline-desc py-[6px] px-4">
                            <p class="text-gray-600 text-sm font-normal">Payment received from John
                                Doe of $385.90</p>
                        </div>
                    </li>
                    <li class="timeline-item flex relative overflow-hidden min-h-[70px]">
                        <div class="timeline-time text-gray-600 min-w-[90px] py-[6px] text-sm pr-4 text-end">
                            10:00 am
                        </div>
                        <div class="timeline-badge-wrap flex flex-col items-center ">
                            <div
                                class="timeline-badge w-3 h-3 rounded-full shrink-0 bg-transparent border-2 border-blue-300 my-[10px]">
                            </div>
                            <div class="timeline-badge-border block h-full w-[1px] bg-gray-100">
                            </div>
                        </div>
                        <div class="timeline-desc py-[6px] px-4 text-sm">
                            <p class="text-gray-600  font-semibold">New sale recorded</p>
                            <a href="javascript:void('')" class="text-blue-600">#ML-3467</a>
                        </div>
                    </li>

                    <li class="timeline-item flex relative overflow-hidden min-h-[70px]">
                        <div class="timeline-time text-gray-600 min-w-[90px] text-sm py-[6px] pr-4 text-end">
                            12:00 am
                        </div>
                        <div class="timeline-badge-wrap flex flex-col items-center ">
                            <div
                                class="timeline-badge w-3 h-3 rounded-full shrink-0 bg-transparent border-2 border-teal-500 my-[10px]">
                            </div>
                            <div class="timeline-badge-border block h-full w-[1px] bg-gray-100">
                            </div>
                        </div>
                        <div class="timeline-desc py-[6px] px-4">
                            <p class="text-gray-600 text-sm font-normal">Payment was made of $64.95
                                to Michael</p>
                        </div>
                    </li>

                    <li class="timeline-item flex relative overflow-hidden min-h-[70px]">
                        <div class="timeline-time text-gray-600 min-w-[90px] text-sm py-[6px] pr-4 text-end">
                            9:30 am
                        </div>
                        <div class="timeline-badge-wrap flex flex-col items-center ">
                            <div
                                class="timeline-badge w-3 h-3 rounded-full shrink-0 bg-transparent border-2 border-yellow-500 my-[10px]">
                            </div>
                            <div class="timeline-badge-border block h-full w-[1px] bg-gray-100">
                            </div>
                        </div>
                        <div class="timeline-desc py-[6px] px-4 text-sm">
                            <p class="text-gray-600 font-semibold">New sale recorded</p>
                            <a href="javascript:void('')" class="text-blue-600">#ML-3467</a>
                        </div>
                    </li>

                    <li class="timeline-item flex relative overflow-hidden min-h-[70px]">
                        <div class="timeline-time text-gray-600 text-sm min-w-[90px] py-[6px] pr-4 text-end">
                            9:30 am
                        </div>
                        <div class="timeline-badge-wrap flex flex-col items-center ">
                            <div
                                class="timeline-badge w-3 h-3 rounded-full shrink-0 bg-transparent border-2 border-red-500 my-[10px]">
                            </div>
                            <div class="timeline-badge-border block h-full w-[1px] bg-gray-100">
                            </div>
                        </div>
                        <div class="timeline-desc py-[6px] px-4">
                            <p class="text-gray-600 text-sm font-semibold">New arrival recorded</p>
                        </div>
                    </li>
                    <li class="timeline-item flex relative overflow-hidden">
                        <div class="timeline-time text-gray-600 text-sm min-w-[90px] py-[6px] pr-4 text-end">
                            12:00 am
                        </div>
                        <div class="timeline-badge-wrap flex flex-col items-center ">
                            <div
                                class="timeline-badge w-3 h-3 rounded-full shrink-0 bg-transparent border-2 border-teal-500 my-[10px]">
                            </div>
                            <div class="timeline-badge-border block h-full w-[1px] bg-gray-100">
                            </div>
                        </div>
                        <div class="timeline-desc py-[6px] px-4">
                            <p class="text-gray-600 text-sm font-normal">Payment Done</p>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
        <div class="col-span-2">
            <div class="card h-full">
                <div class="card-body">
                    <h4 class="text-gray-600 text-lg font-semibold mb-6">Recent Transaction</h4>
                    <div class="relative overflow-x-auto">
                        <!-- table -->
                        <table class="text-left w-full whitespace-nowrap text-sm">
                            <thead class="text-gray-700">
                                <tr class="font-semibold text-gray-600">
                                    <th scope="col" class="p-4">Id</th>
                                    <th scope="col" class="p-4">Assigned</th>
                                    <th scope="col" class="p-4">Name</th>
                                    <th scope="col" class="p-4">Priority</th>
                                    <th scope="col" class="p-4">Budget</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="p-4 font-semibold text-gray-600 ">1</td>
                                    <td class="p-4">
                                        <div class="flex flex-col gap-1">
                                            <h3 class=" font-semibold text-red-600">Sunil Joshi
                                            </h3>
                                            <span class="font-serif text-amber-900">Web
                                                Designer</span>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <span class="font-normal  text-gray-500">Elite Admin</span>
                                    </td>
                                    <td class="p-4">
                                        <span
                                            class="inline-flex items-center py-[3px] px-[10px] rounded-2xl font-semibold bg-blue-600 text-white">Low</span>
                                    </td>
                                    <td class="p-4">
                                        <span class="font-semibold text-base text-gray-600">$3.9</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-4 font-semibold text-gray-600 ">2</td>
                                    <td class="p-4">
                                        <div class="flex flex-col gap-1">
                                            <h3 class="font-semibold text-gray-600">Andrew
                                                McDownland</h3>
                                            <span class="font-normal text-gray-500">Project
                                                Manager</span>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <span class="font-normal text-gray-500">Real Homes WP
                                            Theme</span>
                                    </td>
                                    <td class="p-4">
                                        <span
                                            class="inline-flex items-center py-[3px] px-[10px] rounded-2xl font-semibold text-white bg-cyan-500">Medium</span>
                                    </td>
                                    <td class="p-4">
                                        <span class="font-semibold text-base text-gray-600">$24.5k</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-4 font-semibold text-gray-600 ">3</td>
                                    <td class="p-4">
                                        <div class="flex flex-col gap-1">
                                            <h3 class="font-semibold text-gray-600">Christopher
                                                Jamil</h3>
                                            <span class="font-normal text-sm text-gray-500">Project
                                                Manager</span>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <span class="font-normal text-gray-500">MedicalPro WP
                                            Theme</span>
                                    </td>
                                    <td class="p-4 ">
                                        <span
                                            class="inline-flex items-center py-[3px] px-[10px] rounded-2xl font-semibold text-white bg-red-500">High</span>
                                    </td>
                                    <td class="p-4">
                                        <span class="font-semibold text-base text-gray-600">$12.8k</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-4 font-semibold text-gray-600 ">4</td>
                                    <td class="p-4">
                                        <div class="flex flex-col gap-1">
                                            <h3 class="font-semibold text-gray-600">Nirav Joshi
                                            </h3>
                                            <span class="font-normal text-sm text-gray-500">Frontend
                                                Engineer</span>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <span class="font-normal text-sm text-gray-500">Hosting
                                            Press HTML</span>
                                    </td>
                                    <td class="p-4">
                                        <span
                                            class="inline-flex items-center py-[3px] px-[10px] rounded-2xl font-semibold text-white bg-teal-500">Critical</span>
                                    </td>
                                    <td class="p-4">
                                        <span class="font-semibold text-base text-gray-600">$2.4k</span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 xl:grid-cols-4 lg:grid-cols-2 gap-6">
        <div class="card overflow-hidden">
            <div class="relative">
                <a href="javascript:void(0)">
                    <img src="./assets/images/products/product-1.jpg" alt="product_img" class="w-full">
                </a>
                <a href="javascript:void(0)"
                    class="bg-blue-600 w-8 h-8 flex justify-center items-center text-white rounded-full absolute bottom-0 right-0 mr-4 -mb-3">
                    <i class="ti ti-basket text-base"></i>
                </a>
            </div>
            <div class="card-body">
                <h6 class="text-base font-semibold text-gray-600 mb-1">Boat Headphone</h6>
                <div class="flex justify-between">
                    <div class="flex gap-2 items-center">
                        <h6 class="text-base text-gray-600 font-semibold">$50</h6>
                        <span class="text-gray-500 text-sm">
                            <del>$65</del>
                        </span>
                    </div>
                    <ul class="list-none flex gap-1">
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-star text-yellow-500 text-sm"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-star text-yellow-500 text-sm"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-star text-yellow-500 text-sm"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-star text-yellow-500 text-sm"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-star text-yellow-500 text-sm"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card overflow-hidden">
            <div class="relative">
                <a href="javascript:void(0)">
                    <img src="./assets/images/products/product-2.jpg" alt="product_img" class="w-full">
                </a>
                <a href="javascript:void(0)"
                    class="bg-blue-600 w-8 h-8 flex justify-center items-center text-white rounded-full absolute bottom-0 right-0 mr-4 -mb-3">
                    <i class="ti ti-basket text-base"></i>
                </a>
            </div>
            <div class="card-body">
                <h6 class="text-base font-semibold text-gray-600 mb-1">MacBook Air Pro</h6>
                <div class="flex justify-between">
                    <div class="flex gap-2 items-center">
                        <h6 class="text-base text-gray-600 font-semibold">$650</h6>
                        <span class="text-gray-500 text-sm">
                            <del>$900</del>
                        </span>
                    </div>
                    <ul class="list-none flex gap-1">
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-star text-yellow-500 text-sm"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-star text-yellow-500 text-sm"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-star text-yellow-500 text-sm"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-star text-yellow-500 text-sm"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-star text-yellow-500 text-sm"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card overflow-hidden">
            <div class="relative">
                <a href="javascript:void(0)">
                    <img src="./assets/images/products/product-3.jpg" alt="product_img" class="w-full">
                </a>
                <a href="javascript:void(0)"
                    class="bg-blue-600 w-8 h-8 flex justify-center items-center text-white rounded-full absolute bottom-0 right-0 mr-4 -mb-3">
                    <i class="ti ti-basket text-base"></i>
                </a>
            </div>
            <div class="card-body">
                <h6 class="text-base font-semibold text-gray-600 mb-1">Red Valvet Dress</h6>
                <div class="flex justify-between">
                    <div class="flex gap-2 items-center">
                        <h6 class="text-base text-gray-600 font-semibold">$150</h6>
                        <span class="text-gray-500 text-sm">
                            <del>$200</del>
                        </span>
                    </div>
                    <ul class="list-none flex gap-1">
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-star text-yellow-500 text-sm"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-star text-yellow-500 text-sm"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-star text-yellow-500 text-sm"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-star text-yellow-500 text-sm"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-star text-yellow-500 text-sm"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card overflow-hidden">
            <div class="relative">
                <a href="javascript:void(0)">
                    <img src="./assets/images/products/product-4.jpg" alt="product_img" class="w-full">
                </a>
                <a href="javascript:void(0)"
                    class="bg-blue-600 w-8 h-8 flex justify-center items-center text-white rounded-full absolute bottom-0 right-0 mr-4 -mb-3">
                    <i class="ti ti-basket text-base"></i>
                </a>
            </div>
            <div class="card-body">
                <h6 class="text-base font-semibold text-gray-600 mb-1">Cute Soft Teddybear</h6>
                <div class="flex justify-between">
                    <div class="flex gap-2 items-center">
                        <h6 class="text-base text-gray-600 font-semibold">$285</h6>
                        <span class="text-gray-500 text-sm">
                            <del>$345</del>
                        </span>
                    </div>
                    <ul class="list-none flex gap-1">
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-star text-yellow-500 text-sm"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-star text-yellow-500 text-sm"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-star text-yellow-500 text-sm"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-star text-yellow-500 text-sm"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-star text-yellow-500 text-sm"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <p class="text-base text-gray-500 font-normal p-3 text-center">
            Design and Developed by <a href="https://adminmart.com/" target="_blank"
                class="text-blue-600 underline hover:text-blue-700">AdminMart.com</a>
        </p>
    </footer>
    <!-- Main Content End -->
@endsection
