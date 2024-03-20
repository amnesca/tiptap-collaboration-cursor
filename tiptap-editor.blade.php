<div class="space-y-4">
    <x-tiptap.editor
        wire:model.defer="editing.content"
        user="{{ $authUser }}"
    ></x-tiptap.editor>

    <x-primary-button wire:click.prevent="$emitTo('tiptap-editor', 'save')">SAVE</x-primary-button>
</div>

