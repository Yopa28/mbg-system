<script setup>
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post('/login');
};
</script>

<template>
    <Head title="Login Admin" />

    <main class="flex min-h-screen items-center justify-center bg-slate-100 px-4">
        <div class="w-full max-w-md rounded-2xl bg-white p-8 shadow-sm">
            <div class="mb-8 text-center">
                <div class="mb-4 text-5xl">🍱</div>

                <h1 class="text-2xl font-bold text-slate-800">
                    MBG System
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Silakan login untuk mengakses dashboard admin.
                </p>
            </div>

            <form @submit.prevent="submit" class="space-y-5">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Email
                    </label>

                    <input
                        v-model="form.email"
                        type="email"
                        placeholder="admin@example.com"
                        autocomplete="username"
                        class="w-full rounded-lg border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    />

                    <p v-if="form.errors.email" class="mt-2 text-sm text-red-600">
                        {{ form.errors.email }}
                    </p>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Password
                    </label>

                    <input
                        v-model="form.password"
                        type="password"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        class="w-full rounded-lg border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    />

                    <p v-if="form.errors.password" class="mt-2 text-sm text-red-600">
                        {{ form.errors.password }}
                    </p>
                </div>

                <label class="flex items-center gap-2 text-sm text-slate-600">
                    <input
                        v-model="form.remember"
                        type="checkbox"
                        class="rounded border-slate-300"
                    />
                    Ingat saya
                </label>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full rounded-lg bg-blue-600 px-4 py-3 font-semibold text-white transition hover:bg-blue-700 disabled:opacity-50"
                >
                    {{ form.processing ? 'Memproses...' : 'Login' }}
                </button>
            </form>
        </div>
    </main>
</template>
