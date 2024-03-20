import { Editor } from '@tiptap/core';
import { StarterKit } from '@tiptap/starter-kit';
import Collaboration from '@tiptap/extension-collaboration';
import CollaborationCursor from '@tiptap/extension-collaboration-cursor';
import { HocuspocusProvider } from '@hocuspocus/provider';

const provider = new HocuspocusProvider({
    url: "ws://127.0.0.1:1234",
    name: "text-editor-document",
});

window.setupEditor = function (content, user) {
    let editor;

    return {
        updatedAt: Date.now(),
        content: content,

        init(element) {
            editor = new Editor({
                element: element,
                editorProps: {
                    attributes: {
                        class: 'prose border border-gray-300 p-4 max-w-full'
                    },
                },
                extensions: [
                    StarterKit.configure({
                        history: false,
                    }),
                    Collaboration.configure({
                        document: provider.document,
                    }),
                    CollaborationCursor.configure({
                        provider: provider,
                        user: {
                            name: user,
                            color: '#DDFD9B',
                        }
                    }),
                ],
                content: this.content,
                onUpdate: ({ editor }) => {
                    this.content = editor.getHTML();
                    this.updatedAt = Date.now();
                },
                onCreate: ({ editor }) => {
                    this.updatedAt = Date.now();
                },
                onSelectionUpdate: ({ editor }) => {
                    this.updatedAt = Date.now();
                },
            })

            this.$watch('content', (content) => {
                // If the new content matches TipTap's then we just skip.
                if (content === editor.getHTML()) return

                /*
                Otherwise, it means that a force external to TipTap
                is modifying the data on this Alpine component,
                which could be Livewire itself.
                In this case, we just need to update TipTap's
                content and we're good to do.
                For more information on the `setContent()` method, see:
                    https://www.tiptap.dev/api/commands/set-content
                */
                editor.commands.setContent(content, false)
            })
        },
        isLoaded() {
            return editor
        },
        isActive(type, opts = {}) {
            return editor.isActive(type, opts)
        },
        setParagraph() {
            editor.chain().setParagraph().focus().run()
        },
        toggleBold() {
            editor.chain().toggleBold().focus().run()
        },
        toggleItalic() {
            editor.chain().toggleItalic().focus().run()
        },
        toggleHeading(opts) {
            editor.chain().toggleHeading(opts).focus().run()
        },
        toggleBulletList() {
            editor.chain().toggleBulletList().focus().run()
        },
        toggleOrderedList() {
            editor.chain().toggleOrderedList().focus().run()
        },
        toggleUndo() {
            editor.chain().focus().undo().run()
        },
        toggleRedo() {
            editor.chain().focus().redo().run()
        },
    }
}



