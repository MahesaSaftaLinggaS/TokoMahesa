<div class="bg-white p-4 rounded shadow">
    @if(isset($image))
        <img src="{{ $image }}" alt="{{ $title ?? '' }}" class="w-full h-40 object-cover rounded mb-3">
    @endif

    @if(isset($title))
        <h4 class="font-semibold text-md mb-1">{{ $title }}</h4>
    @endif

    @if(isset($description))
        <p class="text-sm text-gray-600 mb-2">{{ $description }}</p>
    @endif

    {{ $slot }}
</div>
