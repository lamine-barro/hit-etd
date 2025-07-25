@props([
    'label' => '',
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'value' => '',
    'class' => '',
])

<div class="{{ $class }}">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
        {{ $label }}
        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $name }}" 
        @if($required) required @endif
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        class="block w-full border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-200 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm transition-colors @error($name) border-red-500 dark:border-red-500 @enderror"
    >
    @error($name)
        <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
    @enderror
</div> 