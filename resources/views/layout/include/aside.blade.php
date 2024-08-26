<aside id="application-sidebar-brand"
    class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full transform hidden xl:block xl:translate-x-0 xl:end-auto xl:bottom-0 fixed top-0 with-vertical h-screen z-[999] flex-shrink-0 border-r-[1px] w-[270px] border-gray-400  bg-white left-sidebar transition-all duration-300">
    <!-- ---------------------------------- -->
    <!-- Start Vertical Layout Sidebar -->
    <!-- ---------------------------------- -->
    <div class="p-5">

        <a href="../" class="flex text-nowrap">
            <img src="{{ asset('logo.png') }}" alt="Logo-Dark" class="w-1/5" />
            <span class="m-auto text-lg font-bold">Bemby's Farm</span>
        </a>

    </div>
    <div class="scroll-sidebar" data-simplebar="">
        <div class="px-6 mt-0">
            <nav class="flex flex-col w-full  sidebar-nav">
                <ul id="sidebarnav" class="text-sm text-gray-600">
                    <li class="pb-4 text-xs font-bold">
                        <i class="hidden text-lg text-center ti ti-dots nav-small-cap-icon"></i>
                        <span>HOME</span>
                    </li>

                    <li class="sidebar-item">
                        <a class="flex items-center w-full gap-3 px-3 py-2 rounded-md sidebar-link hover:text-blue-600 hover:bg-blue-500"
                            href="{{ route('home') }}">
                            <i class="text-xl ti ti-layout-dashboard"></i> <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="mt-8 mb-4 text-xs font-bold">
                        <i class="hidden text-lg text-center ti ti-dots nav-small-cap-icon"></i>
                        <span>File</span>
                    </li>

                    <li class="sidebar-item">
                        <a class="flex items-center w-full gap-3 px-3 py-2 rounded-md sidebar-link hover:text-blue-600 hover:bg-blue-500"
                            href="{{ route('data-rekening') }}">
                            <i class="text-xl ti ti-article"></i> <span>Data Rekening</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="flex items-center w-full gap-3 px-3 py-2 rounded-md sidebar-link hover:text-blue-600 hover:bg-blue-500"
                            href="{{ route('entry-jurnal.showNamaUnit') }}">
                            <i class="text-xl ti ti-building-community"></i> <span>Entry Unit</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="flex items-center w-full gap-3 px-3 py-2 rounded-md sidebar-link hover:text-blue-600 hover:bg-blue-500"
                            href="{{ route('entry-jurnal') }}">
                            <i class="text-xl ti ti-notes"></i> <span>Entry Jurnal</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <p class="hidden">Copyright 21230001 Balqis Batrisiya Santoso</p>
    <!-- Bottom Upgrade Option -->
    {{-- <div class="relative m-6">
    <div class="flex items-center justify-between p-5 bg-blue-500 rounded-md">
        <div>
            <h5 class="mb-3 text-base font-semibold text-gray-700">Upgrade to Pro</h5>
            <button
                class="px-4 py-2 text-xs font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700">Buy
                Pro</button>
        </div>
        <div class="-mt-12 -mr-2">
            <img src="./assets/images/profile/rocket.png" class="max-w-fit" alt="profile" />
        </div>
    </div>
</div> --}}
    <!-- </aside> -->
</aside>
