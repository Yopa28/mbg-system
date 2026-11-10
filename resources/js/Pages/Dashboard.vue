<script setup>
import { Head } from '@inertiajs/vue3';
import AdminLayout from '../Layouts/AdminLayout.vue';
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

        <section class="mt-6 rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-900">
                Selamat datang di Dashboard MBG
            </h2>
            <p class="mt-2 text-sm text-slate-500">
                Login berhasil. Dashboard admin siap dikembangkan.
            </p>
        </section>
    </AdminLayout>
</template>
