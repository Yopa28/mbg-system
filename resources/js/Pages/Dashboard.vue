<script setup>
import { Head, router } from '@inertiajs/vue3';

defineProps({
    auth: Object,
});

const logout = () => {
    router.post('/logout');
};
</script>

<template>
    <Head title="Dashboard Admin" />

    <main class="min-h-screen bg-slate-50 p-8">
        <div class="mx-auto max-w-6xl">
            <header class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">
                        Dashboard MBG
                    </h1>

                    <p class="mt-1 text-sm text-slate-500">
                        Selamat datang di panel admin.
                    </p>
                </div>

                <button
                    @click="logout"
                    class="rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700"
                >
                    Logout
                </button>
            </header>

            <section class="mt-8 rounded-xl border border-slate-200 bg-white p-6">
                <h2 class="text-lg font-semibold text-slate-800">
                    Selamat datang!
                </h2>

                <p class="mt-2 text-slate-600">
                    Login berhasil. Dashboard admin MBG System siap dikembangkan.
                </p>
            </section>
        </div>
    </main>
</template>
