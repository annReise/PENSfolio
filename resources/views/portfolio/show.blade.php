<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow">

        @if ($portfolio->image)
            <img src="{{ asset('storage/'.$portfolio->image) }}"
                 alt="{{ $portfolio->title }}"
                 class="rounded-xl mb-6 w-full">
        @else
            <img src="https://via.placeholder.com/800x400"
                 class="rounded-xl mb-6 w-full"
                 alt="Thumbnail">
        @endif

        <h1 class="text-3xl font-bold mb-3">
            {{ $portfolio->title }}
        </h1>

        <p class="text-gray-700 mb-6">
            {{ $portfolio->description }}
        </p>

        @if ($portfolio->link)
            <a href="{{ $portfolio->link }}" target="_blank"
               class="inline-block text-blue-600 underline mb-6">
                Kunjungi Proyek
            </a>
        @endif

        <div class="text-sm text-gray-500">
            Dibuat oleh: {{ $portfolio->user->name ?? 'Anonim' }}
        </div>

    </div>
</x-app-layout>
