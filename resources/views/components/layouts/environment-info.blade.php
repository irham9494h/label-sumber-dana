@if (app()->environment() == 'development')
    <div class="flex justify-center items-center w-full p-2 border-b border-slate-200 bg-red-500 text-white">
        <p>
            Anda sedang berada di aplikasi versi DEVELOPMENT.
        </p>
    </div>
@endif
