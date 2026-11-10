
<script setup>
import { ref } from 'vue';
import Sidebar from '../Components/Admin/Sidebar.vue';
import Topbar from '../Components/Admin/Topbar.vue';

const sidebarOpen = ref(false);
</script>

<template>
    <div class="min-h-screen bg-slate-50">
        <!-- Sidebar -->
        <Sidebar
            :open="sidebarOpen"
            @close="sidebarOpen = false"
        />

        <!-- Topbar -->
        <Topbar @toggle-sidebar="sidebarOpen = !sidebarOpen" />

        <!-- Main Content -->
        <div class="min-h-screen pt-16 lg:pl-[260px]">
            <main class="mx-auto min-h-[calc(100vh-64px)] max-w-[1440px] p-4 sm:p-6 lg:p-10">
                <slot />
            </main>
        </div>
    </div>
</template>
