

<script setup>
import { ref, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const emit = defineEmits(['toggle-sidebar']);

const searchQuery = ref('');
const page = usePage();

const adminInitial = computed(() => {
    const name = page.props.auth?.user?.name || 'Admin MBG';

    return name
        .split(' ')
        .filter(Boolean)
        .slice(0, 2)
        .map((word) => word.charAt(0).toUpperCase())
        .join('');
});
</script>


<template>
    <header
        class="fixed left-0 right-0 top-0 z-40 flex h-16 items-center justify-between border-b border-slate-100 bg-white/95 px-4 backdrop-blur-xl sm:px-6 lg:left-[260px]"
    >
        <!-- Left Section -->
        <div class="flex min-w-0 items-center gap-3">
            <!-- Hamburger Mobile -->
            <button
                type="button"
                @click="emit('toggle-sidebar')"
                aria-label="Buka menu navigasi"
                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg text-slate-600 transition hover:bg-slate-100 lg:hidden"
            >
                <span class="material-symbols-outlined text-2xl">
                    menu
                </span>
            </button>

            <!-- Breadcrumb -->
            <div class="flex min-w-0 items-center gap-2">
                <span class="material-symbols-outlined hidden text-lg text-slate-400 sm:block">
                    home
                </span>

                <span class="hidden text-sm text-slate-300 sm:block">/</span>

                <span class="truncate text-xs font-semibold text-slate-700 sm:text-sm">
                    Panel Administrasi SPPG
                </span>
            </div>
        </div>

        <!-- Right Actions -->
        <div class="flex shrink-0 items-center gap-2 sm:gap-4">
            <!-- Search Desktop -->
            <div class="hidden w-64 items-center gap-2 rounded-lg bg-slate-50 px-3 py-2 md:flex">
                <span class="material-symbols-outlined text-lg text-slate-400">
                    search
                </span>

                <input
                    v-model="searchQuery"
                    type="search"
                    placeholder="Cari data gizi, menu..."
                    class="w-full border-0 bg-transparent text-xs text-slate-700 outline-none placeholder:text-slate-400 focus:ring-0"
                />

                <kbd class="shrink-0 rounded bg-white px-1.5 py-0.5 text-[10px] text-slate-400">
                    ⌘K
                </kbd>
            </div>

            <!-- Notification -->
            <button
                type="button"
                title="Notifikasi"
                class="relative rounded-lg p-2 text-slate-500 transition hover:bg-slate-50 hover:text-slate-800"
            >
                <span class="material-symbols-outlined text-xl">
                    notifications
                </span>

                <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-red-500"></span>
            </button>

            <!-- Admin Avatar -->

<!-- Admin Avatar -->
            <div
                class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-600 text-sm font-semibold text-white"
                :title="page.props.auth?.user?.name || 'Admin MBG'"
            >
                {{ adminInitial }}
            </div>
        </div>
    </header>
</template>
