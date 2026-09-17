<div {{ $attributes->merge([
    'class' => 'flex flex-col items-center justify-center rounded-lg border border-dashed border-gray-300 p-8 text-center'
]) }}>
    <h3 class="text-lg font-semibold text-gray-700">
        {{ $title ?? 'Tidak ada data' }}
    </h3>

    <p class="mt-2 text-sm text-gray-500">
        {{ $message ?? 'Belum ada data yang tersedia.' }}
    </p>

    @isset($action)
        <div class="mt-4">
            {{ $action }}
        </div>
    @endisset
</div>