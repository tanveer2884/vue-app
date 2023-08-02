<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Button from 'primevue/button';
import Toast from 'primevue/toast';
import { useToast } from 'primevue/usetoast';

const toast = useToast();
const show = () => {
     toast.add({ severity: 'success', summary: 'Success Message', detail: 'Message Content', life: 3000 });
};
</script>

<template>
    <Head title="About" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">About</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                   <h1>About us page</h1>
                </div>
            </div>
        </div>
        <div class="flex card justify-content-center">
            <Toast />
            <Button label="Show" @click="show()" />
        </div>
    </AuthenticatedLayout>
</template>
