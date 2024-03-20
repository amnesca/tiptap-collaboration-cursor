@pushOnce('scripts')
    <script src="//code.iconify.design/1/1.0.6/iconify.min.js"></script>
@endPushOnce

<div
  x-data="setupEditor(
    $wire.entangle('{{ $attributes->wire('model')->value() }}').defer,
    '{{ $attributes['user'] }}'
  )"
  x-init="() => init($refs.editor)"
  wire:ignore
  {{ $attributes->whereDoesntStartWith('wire:model') }}
>
    {{-- Controls --}}
    <template x-if="isLoaded()">
        <div class="menu flex items-center flex-wrap gap-x-3 border-t border-l border-r border-gray-300 p-4">
            {{-- Paragraph --}}
            <button @click="setParagraph()" :class="{ 'is-active' : isActive('paragraph', updatedAt) }" class="flex items-center p-2 rounded-md shadow-xs cursor-pointer hover:bg-gray-500 hover:text-gray-100">
                <span class="iconify" data-icon="mdi-format-paragraph" height="22"></span>
            </button>
            {{-- Bold --}}
            <button @click="toggleBold()" :class="{ 'is-active' : isActive('bold', updatedAt) }" class="flex items-center p-2 rounded-md shadow-xs cursor-pointer hover:bg-gray-500 hover:text-gray-100">
                <span class="iconify" data-icon="mdi-format-bold" height="22"></span>
            </button>
            {{-- Italic --}}
            <button @click="toggleItalic()" :class="{ 'is-active' : isActive('italic', updatedAt) }" class="flex items-center p-2 rounded-md shadow-xs cursor-pointer hover:bg-gray-500 hover:text-gray-100">
                <span class="iconify" data-icon="mdi-format-italic" height="22"></span>
            </button>
            {{-- H1 --}}
            <button @click="toggleHeading({ level: 1 })" :class="{ 'is-active': isActive('heading', { level: 1 }, updatedAt) }" class="flex items-center p-2 rounded-md shadow-xs cursor-pointer hover:bg-gray-500 hover:text-gray-100">
                <span class="iconify" data-icon="mdi-format-header-1" height="22"></span>
            </button>
            {{-- H2 --}}
            <button @click="toggleHeading({ level: 2 })" :class="{ 'is-active': isActive('heading', { level: 2 }, updatedAt) }" class="flex items-center p-2 rounded-md shadow-xs cursor-pointer hover:bg-gray-500 hover:text-gray-100">
                <span class="iconify" data-icon="mdi-format-header-2" height="22"></span>
            </button>
            {{-- H3 --}}
            <button @click="toggleHeading({ level: 3 })" :class="{ 'is-active': isActive('heading', { level: 3 }, updatedAt) }" class="flex items-center p-2 rounded-md shadow-xs cursor-pointer hover:bg-gray-500 hover:text-gray-100">
                <span class="iconify" data-icon="mdi-format-header-3" height="22"></span>
            </button>
            {{-- H4 --}}
            <button @click="toggleHeading({ level: 4 })" :class="{ 'is-active': isActive('heading', { level: 4 }, updatedAt) }" class="flex items-center p-2 rounded-md shadow-xs cursor-pointer hover:bg-gray-500 hover:text-gray-100">
                <span class="iconify" data-icon="mdi-format-header-4" height="22"></span>
            </button>
            {{-- Bullet List --}}
            <button @click="toggleBulletList()" :class="{ 'is-active' : isActive('bulletList', updatedAt) }" class="flex items-center p-2 rounded-md shadow-xs cursor-pointer hover:bg-gray-500 hover:text-gray-100">
                <span class="iconify" data-icon="mdi-format-list-bulleted" height="22"></span>
            </button>
            {{-- Ordered List --}}
            <button @click="toggleOrderedList()" :class="{ 'is-active' : isActive('orderedList', updatedAt) }" class="flex items-center p-2 rounded-md shadow-xs cursor-pointer hover:bg-gray-500 hover:text-gray-100">
                <span class="iconify" data-icon="mdi-format-list-numbered" height="22"></span>
            </button>

            {{-- Undo --}}
            <button @click="toggleUndo()" class="flex items-center p-2 rounded-md shadow-xs cursor-pointer hover:bg-gray-500 hover:text-gray-100">
                <span class="iconify" data-icon="mdi-undo" height="22"></span>
            </button>
            {{-- Redo --}}
            <button @click="toggleRedo()" class="flex items-center p-2 rounded-md shadow-xs cursor-pointer hover:bg-gray-500 hover:text-gray-100">
                <span class="iconify" data-icon="mdi-redo" height="22"></span>
            </button>
        </div>
    </template>

    {{-- Editor --}}
    <div x-ref="editor" class="prose max-w-full"></div>
</div>
