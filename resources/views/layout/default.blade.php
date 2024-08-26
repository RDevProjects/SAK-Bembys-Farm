<!DOCTYPE html>
<html lang="en">
@include('layout.include.head')

<body class="bg-white">
    <main>
        <div id="main-wrapper" class="flex">
            <p class="hidden">Copyright 21230001 Balqis Batrisiya Santoso</p>
            @include('layout.include.aside')
            <div class="w-full overflow-hidden page-wrapper">
                @include('layout.include.header')
                <main class="h-full max-w-full pt-4 overflow-y-auto">
                    <div class="container flex flex-col gap-6 py-5 full-container">
                        @yield('content')
                    </div>
                    @include('layout.include.copyright')
                </main>
            </div>
        </div>
    </main>
    @include('layout.include.script')
</body>

</html>
