<x-empty-layout>
    <section class="flex flex-col items-center gap-8">
        <x-application-logo class="w-24 h-24 fill-current text-gray-500" />
    <div class="flex gap-4">
        <a class="px-6 py-2 bg-blue-500 rounded-md text-white" href="{{ route('login') }}">Đăng nhập</a>
        <a class="px-8 py-2 bg-gray-500 rounded-md text-white" href="{{ route('register') }}">Đăng ký</a>
    </div>
    </section>
</x-empty-layout>
