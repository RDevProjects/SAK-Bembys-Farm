<!DOCTYPE html>
<html lang="en">
@include('layout.include.head')

<body class="bg-white">
    <main>
        <div id="main-wrapper" class="flex">
            @include('layout.include.aside')
            <div class="w-full page-wrapper overflow-hidden">
                @include('layout.include.header')
                <main class="h-full overflow-y-auto max-w-full pt-4">
                    <div class="container full-container py-5 flex flex-col gap-6">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>
    </main>
    @include('layout.include.script')
</body>

</html>
