@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
<<<<<<< HEAD
        <div class="text-lg font-medium text-gray-900">
            {{ $title }}
        </div>

        <div class="mt-4 text-sm text-gray-600">
=======
        <div class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ $title }}
        </div>

        <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
>>>>>>> origin/main
            {{ $content }}
        </div>
    </div>

<<<<<<< HEAD
    <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">
=======
    <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 dark:bg-gray-800 text-right">
>>>>>>> origin/main
        {{ $footer }}
    </div>
</x-modal>
