<div 
    x-data="toastSystem()"
    x-init="init()"
    class="fixed top-5 left-1/2 -translate-x-1/2 z-50 space-y-2"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div 
            x-text="toast.message"
            :class="toastClasses(toast.type)"
            x-show="toast.show"
            x-transition
            class="px-4 py-3 rounded-lg border shadow-sm text-sm"
        ></div>
    </template>
</div>

<script>
function toastSystem() {
    return {
        toasts: [],

        init() {

            @if(session('welcome'))
                this.addToast("{{ session('welcome') }}", "welcome");
            @endif
            @if(session('success'))
                this.addToast("{{ session('success') }}", "success");
            @endif

            @if(session('error'))
                this.addToast("{{ session('error') }}", "error");
            @endif

            @if(session('info'))
                this.addToast("{{ session('info') }}", "info");
            @endif
        },

        addToast(message, type = 'success') {
            const id = Date.now();

            this.toasts.push({
                id,
                message,
                type,
                show: true
            });

            setTimeout(() => {
                this.removeToast(id);
            }, 3000);
        },

        removeToast(id) {
            const toast = this.toasts.find(t => t.id === id);
            if (!toast) return;

            toast.show = false;

            setTimeout(() => {
                this.toasts = this.toasts.filter(t => t.id !== id);
            }, 300);
        },

        toastClasses(type) {
            return {
                'bg-emerald-50 border-emerald-200 text-emerald-700': type === 'success',
                'bg-red-50 border-red-200 text-red-700': type === 'error',
                'bg-blue-50 border-blue-200 text-blue-700': type === 'info',
                'bg-yellow-50 border-yellow-200 text-yellow-700': type === 'welcome'
            };
        }
    }
}
</script>