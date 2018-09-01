<div class="top-bar flex items-center py-4 bg-blue-custom">
    <div class="logo-container w-left pl-4">
        <a href="{{ url('/') }}" class="text-lg font-hairline text-grey-lightest no-underline">
            {{ config('app.name', 'Laravel') }}
        </a>
    </div>
    <div class="w-full pr-4">
        <input type="text" class="w-full py-4 px-4 pl-10 text-sm bg-grey-lighter border-blue-custom-dark outline-0" placeholder="Search ....">
        <div class="absolute pin-t flex items-center py-4 px-3 text-grey-darker"></div>
    </div>
</div>
















{{-- <nav class="flex items-center justify-between flex-wrap bg-teal p-4">
    <div class="flex items-center flex-no-shrink text-white mr-6">
        <a href="{{ url('/') }}" class="text-lg font-hairline text-teal-darker no-underline">
            {{ config('app.name', 'Laravel') }}
        </a>
    </div>
    <div class="block lg:hidden">
        <button class="flex items-center px-3 py-2 border rounded text-teal-lighter border-teal-light hover:text-white hover:border-white">
            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
        </button>
    </div>
    <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
        <div class="text-sm lg:flex-grow"></div>
        <div>
            @guest('web-admin')
                <a class="block mt-4 lg:inline-block lg:mt-0 text-teal-lighter hover:text-white mr-4" href="{{ url('/admin/login') }}">
                    Login
                </a>
            @else
                <span class="text-teal-darker text-sm pr-4">howdy, {{ auth('web-admin')->user()->name }}</span>

                <a href="{{ route('admin.logout') }}"
                    class="no-underline text-teal-darker text-sm"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="hidden">
                    {{ csrf_field() }}
                </form>
            @endguest
        </div>
    </div>
</nav> --}}
