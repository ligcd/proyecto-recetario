@props(['for'])

@error($for)
<<<<<<< HEAD
    <p {{ $attributes->merge(['class' => 'text-sm text-red-600']) }}>{{ $message }}</p>
=======
    <p {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-400']) }}>{{ $message }}</p>
>>>>>>> origin/main
@enderror
