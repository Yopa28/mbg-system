
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

        <!-- Header Dashboard -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex flex-col gap-1">
                <h1 class="text-2xl font-bold text-slate-900">
                    Ringkasan
                </h1>
                <p class="text-sm text-slate-500">
                    Ikhtisar operasional distribusi menu dan status publikasi gizi MBG.
                </p>
            </div>

            <a
                href="/admin/menus/create"
                class="inline-flex w-fit items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700"
            >
                <span class="material-symbols-outlined text-lg">add</span>
                Tambah Menu
            </a>
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


        <!-- Menu Hari Ini -->
        <section class="mt-6 rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">
                        Menu Hari Ini
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Informasi menu dan distribusi makanan hari ini.
                    </p>
                </div>

                <span
                    v-if="todayMenu"
                    class="w-fit rounded-full px-3 py-1 text-xs font-semibold"
                    :class="{
                        'bg-emerald-100 text-emerald-700': todayMenu.status === 'published',
                        'bg-amber-100 text-amber-700': todayMenu.status === 'scheduled',
                        'bg-slate-100 text-slate-600': todayMenu.status === 'draft',
                        'bg-rose-100 text-rose-700': todayMenu.status === 'archived',
                    }"
                >
                    {{ todayMenu.status === 'published' ? 'Dipublikasikan' :
                       todayMenu.status === 'scheduled' ? 'Terjadwal' :
                       todayMenu.status === 'draft' ? 'Draf' : 'Diarsipkan' }}
                </span>
            </div>

            <div v-if="todayMenu" class="mt-6">
                <div class="border-b border-slate-100 pb-5">
                    <p class="text-sm text-slate-500">
                        {{ todayMenu.serving_date }}
                    </p>

                    <h3 class="mt-2 text-xl font-bold text-slate-900">
                        {{ todayMenu.title }}
                    </h3>

                    <p v-if="todayMenu.description" class="mt-2 text-sm leading-relaxed text-slate-600">
                        {{ todayMenu.description }}
                    </p>

                    <p v-if="todayMenu.sppg" class="mt-3 text-sm text-slate-500">
                        <span class="material-symbols-outlined mr-1 inline-block align-middle text-base">
                            location_on
                        </span>
                        {{ todayMenu.sppg.name }}
                    </p>
                </div>

                <!-- Dua Jenis Porsi -->
                <div class="mt-5 grid grid-cols-1 gap-5 xl:grid-cols-2">
                    <article
                        v-for="portion in todayMenu.portions || []"
                        :key="portion.id"
                        class="overflow-hidden rounded-xl border border-slate-200"
                    >
                        <div class="flex items-center justify-between border-b border-slate-100 bg-slate-50 px-4 py-3">
                            <h4 class="font-semibold text-slate-800">
                                {{ portion.portion_type === 'large' ? 'Porsi Besar' : 'Porsi Kecil' }}
                            </h4>

                            <span class="text-xs text-slate-500">
                                {{ portion.total_weight_grams ?? '-' }} gram
                            </span>
                        </div>

                        <div class="p-4">
                            <img
                                v-if="portion.photo_path"
                                :src="`/storage/${portion.photo_path}`"
                                :alt="`Foto ${portion.portion_type === 'large' ? 'Porsi Besar' : 'Porsi Kecil'}`"
                                class="h-48 w-full rounded-lg object-cover"
                            />

                            <div
                                v-else
                                class="flex h-40 items-center justify-center rounded-lg bg-slate-100 text-slate-400"
                            >
                                <div class="text-center">
                                    <span class="material-symbols-outlined text-4xl">
                                        restaurant
                                    </span>
                                    <p class="mt-1 text-xs">Foto belum tersedia</p>
                                </div>
                            </div>

                            <p v-if="portion.description" class="mt-3 text-sm text-slate-600">
                                {{ portion.description }}
                            </p>

                            <div class="mt-4">
                                <h5 class="text-sm font-semibold text-slate-800">
                                    Komposisi Makanan
                                </h5>

                                <ul v-if="portion.food_components?.length" class="mt-2 space-y-2">
                                    <li
                                        v-for="component in portion.food_components"
                                        :key="component.id"
                                        class="rounded-lg bg-slate-50 px-3 py-2"
                                    >
                                        <p class="text-sm font-medium text-slate-700">
                                            {{ component.name }}
                                        </p>

                                        <p v-if="component.component_ingredients?.length" class="mt-1 text-xs text-slate-500">
                                            {{ component.component_ingredients
                                                .map(item => item.ingredient?.name)
                                                .filter(Boolean)
                                                .join(', ') }}
                                        </p>
                                    </li>
                                </ul>

                                <p v-else class="mt-2 text-xs text-slate-400">
                                    Komposisi belum tersedia.
                                </p>
                            </div>

                            <div class="mt-5 border-t border-slate-100 pt-4">
                                <h5 class="text-sm font-semibold text-slate-800">
                                    Informasi Gizi
                                </h5>

                                <div v-if="portion.nutrition" class="mt-3 grid grid-cols-2 gap-3 sm:grid-cols-4">
                                    <div class="rounded-lg bg-blue-50 p-3">
                                        <p class="text-xs text-slate-500">Energi</p>
                                        <p class="mt-1 font-bold text-blue-700">
                                            {{ portion.nutrition.energy_kcal ?? '-' }}
                                        </p>
                                        <p class="text-xs text-slate-500">kkal</p>
                                    </div>

                                    <div class="rounded-lg bg-slate-50 p-3">
                                        <p class="text-xs text-slate-500">Protein</p>
                                        <p class="mt-1 font-bold text-slate-800">
                                            {{ portion.nutrition.protein_g ?? '-' }}
                                        </p>
                                        <p class="text-xs text-slate-500">gram</p>
                                    </div>

                                    <div class="rounded-lg bg-slate-50 p-3">
                                        <p class="text-xs text-slate-500">Karbohidrat</p>
                                        <p class="mt-1 font-bold text-slate-800">
                                            {{ portion.nutrition.carbohydrate_g ?? '-' }}
                                        </p>
                                        <p class="text-xs text-slate-500">gram</p>
                                    </div>

                                    <div class="rounded-lg bg-slate-50 p-3">
                                        <p class="text-xs text-slate-500">Lemak</p>
                                        <p class="mt-1 font-bold text-slate-800">
                                            {{ portion.nutrition.fat_g ?? '-' }}
                                        </p>
                                        <p class="text-xs text-slate-500">gram</p>
                                    </div>
                                </div>

                                <p v-else class="mt-2 text-xs text-slate-400">
                                    Informasi gizi belum diinput.
                                </p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <div v-else class="mt-6 rounded-lg bg-slate-50 px-4 py-10 text-center">
                <span class="material-symbols-outlined text-4xl text-slate-400">
                    event_busy
                </span>
                <h3 class="mt-2 font-semibold text-slate-700">
                    Belum ada menu hari ini
                </h3>
                <p class="mt-1 text-sm text-slate-500">
                    Menu untuk tanggal hari ini belum tersedia.
                </p>
            </div>
        </section>


        <!-- Aktivitas Admin -->
        <section class="mt-6 rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex flex-col gap-1">
                <h2 class="text-lg font-bold text-slate-900">
                    Aktivitas Admin Terbaru
                </h2>
                <p class="text-sm text-slate-500">
                    Riwayat aktivitas pengelolaan dan publikasi menu.
                </p>
            </div>

            <div v-if="recentActivities.length" class="mt-5 divide-y divide-slate-100">
                <div
                    v-for="activity in recentActivities"
                    :key="activity.id"
                    class="flex items-start gap-3 py-4 first:pt-0 last:pb-0"
                >
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full"
                        :class="{
                            'bg-emerald-50 text-emerald-600': activity.action === 'published',
                            'bg-blue-50 text-blue-600': ['created', 'updated'].includes(activity.action),
                            'bg-amber-50 text-amber-600': activity.action === 'scheduled',
                            'bg-slate-100 text-slate-600': ['unpublished', 'archived', 'auto_deleted'].includes(activity.action),
                        }"
                    >
                        <span class="material-symbols-outlined">
                            {{
                                activity.action === 'published' ? 'check_circle' :
                                activity.action === 'created' ? 'add_circle' :
                                activity.action === 'updated' ? 'edit' :
                                activity.action === 'scheduled' ? 'schedule' :
                                activity.action === 'unpublished' ? 'visibility_off' :
                                activity.action === 'archived' ? 'archive' :
                                'delete'
                            }}
                        </span>
                    </div>

                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-semibold text-slate-800">
                            {{
                                activity.action === 'published' ? 'Menu dipublikasikan' :
                                activity.action === 'created' ? 'Menu dibuat' :
                                activity.action === 'updated' ? 'Menu diperbarui' :
                                activity.action === 'scheduled' ? 'Menu dijadwalkan' :
                                activity.action === 'unpublished' ? 'Publikasi dibatalkan' :
                                activity.action === 'archived' ? 'Menu diarsipkan' :
                                'Menu dihapus otomatis'
                            }}
                        </p>

                        <p class="mt-1 text-sm text-slate-600">
                            {{ activity.menu_title }}
                        </p>

                        <p v-if="activity.description" class="mt-1 text-xs text-slate-500">
                            {{ activity.description }}
                        </p>

                        <p class="mt-2 text-xs text-slate-400">
                            {{ activity.user?.name || 'Sistem' }}
                            <span class="mx-1">·</span>
                            {{ activity.created_at ? new Date(activity.created_at).toLocaleString('id-ID', {
                                dateStyle: 'medium',
                                timeStyle: 'short',
                            }) : '-' }}
                        </p>
                    </div>
                </div>
            </div>

            <div v-else class="mt-5 rounded-lg bg-slate-50 px-4 py-8 text-center">
                <span class="material-symbols-outlined text-3xl text-slate-400">
                    history
                </span>
                <p class="mt-2 text-sm text-slate-500">
                    Belum ada aktivitas admin.
                </p>
            </div>
        </section>

        <!-- Profil SPPG -->
        <section class="mt-6 rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                    <span class="material-symbols-outlined text-2xl">domain</span>
                </div>

                <div>
                    <h2 class="font-bold text-slate-900">
                        Profil SPPG
                    </h2>
                    <p class="text-xs text-slate-500">
                        Informasi satuan pelayanan pemenuhan gizi
                    </p>
                </div>
            </div>

            <div v-if="sppgProfile" class="mt-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <p class="text-xs text-slate-500">Nama SPPG</p>
                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ sppgProfile.name }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-slate-500">Kode SPPG</p>
                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ sppgProfile.code }}
                    </p>
                </div>

                <div class="sm:col-span-2">
                    <p class="text-xs text-slate-500">Alamat</p>
                    <p class="mt-1 text-sm text-slate-700">
                        {{ sppgProfile.address || 'Alamat belum diisi' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-slate-500">Nomor Telepon</p>
                    <p class="mt-1 text-sm text-slate-700">
                        {{ sppgProfile.phone || '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-slate-500">Email</p>
                    <p class="mt-1 text-sm text-slate-700">
                        {{ sppgProfile.email || '-' }}
                    </p>
                </div>
            </div>

            <div v-else class="mt-5 rounded-lg bg-slate-50 p-4">
                <p class="text-sm text-slate-500">
                    Profil SPPG belum tersedia.
                </p>
            </div>
        </section>




    </AdminLayout>
</template>
