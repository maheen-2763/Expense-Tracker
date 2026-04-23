<form 
    method="GET" 
    action="{{ $action }}"
    x-data="{ query: '{{ request('search') }}' }"
    x-init="$watch('query', value => {
        if (value === '') {
            window.location = '{{ $action }}';
        }
    })"
    @submit.prevent="$el.submit()"
    {{ $attributes->merge(['class' => 'flex-1 max-w-lg mx-6 hidden md:block']) }}
>
    <div class="relative">

        <!-- Icon -->
        <span class="absolute inset-y-0 left-3 flex items-center text-gray-400 text-sm pointer-events-none">
            🔍
        </span>

        <!-- Input -->
        <input
            type="text"
            name="search"
            x-model="query"
            @input.debounce.500ms="$el.form.submit()"
            placeholder="{{ $placeholder }}"
            class="w-full pl-9 pr-8 py-2 text-sm
                   bg-gray-50 border border-gray-200 rounded-lg
                   focus:bg-white focus:border-gray-300 focus:ring-1 focus:ring-gray-200
                   transition outline-none"
        >

        <!-- Clear button -->
        <button 
            type="button"
            x-show="query.length > 0"
            @click="query='';"
            class="absolute inset-y-0 right-3 flex items-center text-gray-400 text-xs"
        >
            ✕
        </button>

    </div>
</form>