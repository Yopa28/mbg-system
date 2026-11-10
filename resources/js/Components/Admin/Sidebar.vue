

<script setup>
import { router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

defineProps({
    open: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(['close']);
const page = usePage();

const admin = computed(() => page.props.auth?.user);

const adminName = computed(() => admin.value?.name || 'Admin MBG');
const adminEmail = computed(() => admin.value?.email || 'Administrator');

const isActive = (path) => page.url === path;

const logout = () => {
    router.post('/logout');
};

const closeSidebar = () => {
    emit('close');
};
</script>


<template>
    <!-- Backdrop Mobile -->
    <Transition name="fade">
        <div
            v-if="open"
            class="fixed inset-0 z-40 bg-slate-900/40 lg:hidden"
            @click="closeSidebar"
        ></div>
    </Transition>

    <!-- Sidebar -->
    <aside
        class="fixed inset-y-0 left-0 z-50 flex w-[260px] flex-col justify-between border-r border-slate-100 bg-white transition-transform duration-300 ease-in-out"
        :class="open ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    >
        <div>
            <!-- Brand -->
            <div class="flex h-16 items-center justify-between border-b border-slate-100 px-5">
                <div class="flex min-w-0 items-center gap-3">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-600 text-white">
                        <span class="material-symbols-outlined">verified</span>
                    </div>

                    <div class="min-w-0">
                        <h1 class="truncate text-sm font-bold text-slate-900">
                            Informasi Gizi MBG
                        </h1>
                        <p class="truncate text-xs text-slate-500">
                            Panel Administrasi SPPG
                        </p>
                    </div>
                </div>

                <!-- Close Mobile -->
                <button
                    type="button"
                    class="rounded-lg p-2 text-slate-500 hover:bg-slate-100 lg:hidden"
                    aria-label="Tutup menu"
                    @click="closeSidebar"
                >
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <!-- Navigation Label -->
            <div class="px-5 pb-2 pt-7">
                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                    Navigasi Sistem
                </p>
            </div>

            <!-- Navigation -->
            <nav class="flex flex-col gap-1 px-3">
                <a
                    href="/admin/dashboard"
                    class="flex items-center gap-3 rounded-lg px-4 py-3 text-sm transition"
                    :class="isActive('/admin/dashboard')
                        ? 'bg-blue-50 font-semibold text-blue-700'
                        : 'text-slate-600 hover:bg-slate-50'"
                    @click="closeSidebar"
                >
                    <span class="material-symbols-outlined text-xl">dashboard</span>
                    Ringkasan
                </a>

                <div class="flex cursor-not-allowed items-center gap-3 rounded-lg px-4 py-3 text-sm text-slate-400">
                    <span class="material-symbols-outlined text-xl">restaurant_menu</span>
                    Kelola Menu
                </div>

                <div class="flex cursor-not-allowed items-center gap-3 rounded-lg px-4 py-3 text-sm text-slate-400">
                    <span class="material-symbols-outlined text-xl">add_circle</span>
                    Tambah Menu
                </div>

                <div class="flex cursor-not-allowed items-center gap-3 rounded-lg px-4 py-3 text-sm text-slate-400">
                    <span class="material-symbols-outlined text-xl">calendar_month</span>
                    Jadwal Menu
                </div>

                <div class="flex cursor-not-allowed items-center gap-3 rounded-lg px-4 py-3 text-sm text-slate-400">
                    <span class="material-symbols-outlined text-xl">settings</span>
                    Pengaturan
                </div>
            </nav>
        </div>

        <!-- Admin Profile -->
        <div class="border-t border-slate-100 p-4">
            <div class="mb-4 flex items-center justify-between rounded-lg bg-slate-50 p-3">
                <div class="flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                    <span class="text-xs text-slate-500">Sistem MBG</span>
                </div>
                <span class="text-xs font-semibold text-emerald-600">Online</span>
            </div>

            <div class="flex items-center justify-between gap-2">
                <div class="flex min-w-0 items-center gap-3">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-blue-600 text-white">
                        <span class="material-symbols-outlined text-xl">person</span>
                    </div>

                    <div class="min-w-0">
                        <p class="truncate text-sm font-semibold text-slate-800">
                            {{ adminName }}
                        </p>
                        <p class="truncate text-xs text-slate-500">
                            {{ adminEmail }}
                        </p>
                    </div>
                </div>

                <button
                    type="button"
                    @click="logout"
                    title="Logout"
                    class="rounded-lg p-2 text-slate-500 transition hover:bg-red-50 hover:text-red-600"
                >
                    <span class="material-symbols-outlined">logout</span>
                </button>
            </div>
        </div>
    </aside>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
