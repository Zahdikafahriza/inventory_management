<div
    x-data="toastStack()"
    x-init="init()"
    class="pointer-events-none fixed inset-x-0 top-4 z-[100] flex flex-col items-center gap-3 px-4 sm:items-end sm:px-6"
    aria-live="polite"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div
            x-show="toast.visible"
            x-transition:enter="transition ease-out duration-250"
            x-transition:enter-start="opacity-0 -translate-y-2 sm:translate-x-4 sm:translate-y-0"
            x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            :class="toast.type === 'success' ? 'toast-success' : 'toast-error'"
        >
            <svg x-show="toast.type === 'success'" class="mt-0.5 h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <svg x-show="toast.type !== 'success'" class="mt-0.5 h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
            </svg>
            <p class="flex-1 text-sm font-medium" x-text="toast.message"></p>
            <button @click="dismiss(toast.id)" class="shrink-0 rounded-lg p-1 text-current/60 transition hover:bg-black/5">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </template>
</div>

<script>
    function toastStack() {
        return {
            toasts: [],
            counter: 0,
            init() {
                (window.__flashMessages || []).forEach((f) => this.push(f.type, f.message));
            },
            push(type, message) {
                const id = ++this.counter;
                this.toasts.push({ id, type, message, visible: true });
                setTimeout(() => this.dismiss(id), 5000);
            },
            dismiss(id) {
                const item = this.toasts.find((t) => t.id === id);
                if (item) item.visible = false;
                setTimeout(() => {
                    this.toasts = this.toasts.filter((t) => t.id !== id);
                }, 250);
            },
        };
    }
</script>
