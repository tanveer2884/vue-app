<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Pagination from '@/Components/pagination.vue';
import { ref, onMounted, onUpdated, onActivated } from 'vue';
import Button from "primevue/button"
import Dialog from 'primevue/dialog';
import Toast from 'primevue/toast';
import { useToast } from 'primevue/usetoast';

const showModel = ref(false);
const product = ref(null);
const visible = ref(false);

const toast = useToast();

const { products, flash } = defineProps({
    products: {
        type: Object,
        default: () => ({}),
    },
    flash: {
        type: Object,
        default: () => ({})
    }
});


onMounted(() => {
    console.log('hereh');
    if (flash.message) {
        toast.add({ severity: 'success', summary: 'Success Message', detail: flash.message, life: 3000 });
    }
});

onUpdated(() => {
    if (flash.message) {
        toast.add({ severity: 'success', summary: 'Success Message', detail: flash.message, life: 3000 });
    }
});


const form = useForm({

});

const openModel = (id) => {
    product.value = id;
    visible.value = true;
}

const destroy = () => {
    form.delete(route('products.destroy', product.value));
    visible.value = false;
}

</script>

<template>
    <Toast />

    <Head title="Products" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Posts</h2>
        </template>
        <div class="w-full px-4 mx-auto mt-20 mb-12 xl:w-8/12 xl:mb-0">
            <div class="relative flex flex-col w-full min-w-0 mb-6 break-words bg-white rounded shadow-lg">
                <div class="px-4 py-3 mb-0 border-0 rounded-t">
                    <div class="flex flex-wrap items-center">
                        <div class="relative flex-1 flex-grow w-full max-w-full px-4">
                            <h3 class="text-base font-semibold text-blueGray-700">
                                Products
                            </h3>
                        </div>
                        <div class="relative flex-1 flex-grow w-full max-w-full px-4 text-right">
                            <Link :href="route('products.create')"
                                class="px-3 py-1 mb-1 mr-1 text-xs font-bold text-white uppercase transition-all duration-150 ease-linear bg-indigo-500 rounded outline-none active:bg-indigo-600 focus:outline-none">
                            Create
                            </Link>
                        </div>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto">
                    <table class="items-center w-full bg-transparent border-collapse">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">
                                    id
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">
                                    Title
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">
                                    Content
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">
                                    image
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="product in products.data" :key="product.id">
                                <th
                                    class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap text-blueGray-700">
                                    {{ product.id }}
                                </th>
                                <th
                                    class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap text-blueGray-700">
                                    {{ product.title }}
                                </th>
                                <th
                                    class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap text-blueGray-700">
                                    {{ product.des }}
                                </th>
                                <th v-for="images in product.media" :key="images"
                                    class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap text-blueGray-700">
                                    <img :src="images.original_url" :alt="product.title">
                                </th>
                                <th
                                    class="p-4 px-6 space-x-2 text-xs text-left text-red-400 align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                    <Link :href="route('products.edit', product.id)"
                                        class="p-button p-component p-button-icon-only p-button-info p-button-rounded"> <i
                                        class="pi pi-file-edit" style="font-size: 1.5rem"></i> </Link>

                                    <Button @click="openModel(product.id)" icon="pi pi-times" severity="danger" rounded
                                        aria-label="Cancel" />

                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <Pagination :data="products" />
                <div class="flex card justify-content-center">
                    <Dialog v-model:visible="visible" modal header="Warning" :style="{ width: '20vw' }">
                        <p>
                            Are you sure. You want to delete this record.
                        </p>
                        <template #footer>
                            <Button label="No" icon="pi pi-times" @click="visible = false" text />
                        <Button label="Yes" icon="pi pi-check" @click="destroy" severity="danger" autofocus />
                    </template>
                </Dialog>
            </div>
        </div>
    </div>
</AuthenticatedLayout></template>

<style>img {
    width: 30%;
}</style>