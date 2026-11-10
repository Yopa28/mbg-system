
<script setup>
import { Head } from '@inertiajs/vue3';
import AdminLayout from '../Layouts/AdminLayout.vue';

defineProps({
    statistics: {
        type: Object,
        required: true,
    },
    todayMenu: {
        type: Object,
        default: null,
    },
    recentActivities: {
        type: Array,
        default: () => [],
    },
    sppgProfile: {
        type: Object,
        default: null,
    },
});
</script>

<template>
    <Head title="Ringkasan Admin" />

    <AdminLayout>
        <div class="flex flex-col gap-1">
            <h1 class="text-2xl font-bold text-slate-900">
                Ringkasan
            </h1>
            <p class="text-sm text-slate-500">
                Ikhtisar operasional distribusi menu dan status publikasi gizi MBG.
            </p>
        </div>

        <!-- Konten dashboard akan ditambahkan pada tahap berikutnya -->

        <!-- Statistik Dashboard -->
        <section class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">

            <!-- Total Menu -->
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-slate-500">
                        Total Menu
                    </p>
                    <span class="material-symbols-outlined rounded-lg bg-blue-50 p-2 text-blue-600">
                        restaurant_menu
                    </span>
                </div>

                <div class="mt-4">
                    <p class="text-3xl font-bold text-slate-900">
                        {{ statistics.total_menus }}
                    </p>
                    <p class="mt-1 text-xs text-slate-500">
                        Seluruh menu terdaftar
                    </p>
                </div>
            </div>

            <!-- Menu Dipublikasikan -->
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-slate-500">
                        Dipublikasikan
                    </p>
                    <span class="material-symbols-outlined rounded-lg bg-emerald-50 p-2 text-emerald-600">
                        check_circle
                    </span>
                </div>

                <div class="mt-4">
                    <p class="text-3xl font-bold text-slate-900">
                        {{ statistics.published_menus }}
                    </p>
                    <p class="mt-1 text-xs text-emerald-600">
                        {{ statistics.publication_percentage }}% dari total menu
                    </p>
                </div>
            </div>

            <!-- Draf dan Terjadwal -->
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-slate-500">
                        Draf & Terjadwal
                    </p>
                    <span class="material-symbols-outlined rounded-lg bg-amber-50 p-2 text-amber-600">
                        edit_note
                    </span>
                </div>

                <div class="mt-4">
                    <p class="text-3xl font-bold text-slate-900">
                        {{ statistics.draft_menus }}
                    </p>
                    <p class="mt-1 text-xs text-slate-500">
                        Menunggu publikasi
                    </p>
                </div>
            </div>

        </section>

    </AdminLayout>
</template>
