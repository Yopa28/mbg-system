cat > resources/js/Components/Admin/Topbar.vue <<'EOF'
<script setup>
import { ref } from 'vue';

const searchQuery = ref('');
</script>

<template>
    <header class="fixed left-[260px] right-0 top-0 z-40 flex h-16 items-center justify-between border-b border-slate-100 bg-white/95 px-6 backdrop-blur-xl">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-lg text-slate-400">
                home
            </span>

            <span class="text-sm text-slate-300">/</span>

            <span class="text-sm font-semibold text-slate-700">
                Panel Administrasi SPPG
            </span>
        </div>

        <!-- Right Actions -->
        <div class="flex items-center gap-4">
            <!-- Search -->
            <div class="flex w-64 items-center gap-2 rounded-lg bg-slate-50 px-3 py-2">
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
            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-600 text-white">
                <span class="material-symbols-outlined text-xl">
                    person
                </span>
            </div>
        </div>
    </header>
</template>
EOF
