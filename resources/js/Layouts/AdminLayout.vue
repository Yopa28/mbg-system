<script setup>
import Sidebar from '../Components/Admin/Sidebar.vue';
import Topbar from '../Components/Admin/Topbar.vue';
</script>

<template>
    <div class="min-h-screen bg-slate-50">
        <!-- Sidebar -->
        <Sidebar />

        <!-- Topbar -->
        <Topbar />

        <!-- Main Content -->
        <div class="min-h-screen pl-[260px] pt-16">
            <main class="mx-auto min-h-[calc(100vh-64px)] max-w-[1440px] p-6 lg:p-10">
                <slot />
            </main>
        </div>
    </div>
</template>
