<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Pagination from '@/Components/pagination.vue';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';
import Button from "primevue/button"
import Checkbox from 'primevue/checkbox';


const showModel = ref(false);
const product = ref(null);
const checked = ref('')


 defineProps({
    products: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({

});

const openModel = (id) => {
    product.value = id;
    showModel.value = true;
}

const destroy = () => {
    form.delete(route('products.destroy', product.value));
    showModel.value = false;
}

const closeModal = () => {
    showModel.value = false;
}

</script>

<template>
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
                            <Link :href="route('products.create')" class="px-3 py-1 mb-1 mr-1 text-xs font-bold text-white uppercase transition-all duration-150 ease-linear bg-indigo-500 rounded outline-none active:bg-indigo-600 focus:outline-none">
                                Create
                            </Link>
                        </div>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto">
                    <table class="items-center w-full bg-transparent border-collapse">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">
                                    id
                                </th>
                                <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">
                                    Title
                                </th>
                                <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">
                                    Content
                                </th>
                                 <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">
                                        image
                                    </th>
                                <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-blueGray-50 text-blueGray-500 border-blueGray-100 whitespace-nowrap">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr  v-for="product in products.data" :key="product.id">
                            <th class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap text-blueGray-700">
                                {{ product.id }}
                            </th>
                            <th class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap text-blueGray-700">
                                {{ product.title }}
                            </th>
                            <th class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap text-blueGray-700">
                                {{ product.des }}
                            </th>
                            <th v-for="images in product.media" :key="images" class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap text-blueGray-700">
                                <img :src="images.original_url" :alt="product.title">
                            </th>
                            <th class="p-4 px-6 text-xs text-left text-red-400 align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                 <Link :href="route('products.edit', product.id)">Edit</Link> |
                               <button @click="openModel(product.id)">Delete</button>
                            </th>
                        </tr>
                        </tbody>
                    </table>
                </div>
                 <Pagination :data="products" />
                 <Modal :show="showModel" @close="closeModal">
                        <div class="p-6">
                            <h2 class="text-lg font-medium text-gray-900">
                                Are you sure you want to delete record?
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Once your record is deleted, all of its resources and data will be permanently deleted.
                            </p>
                            <div class="flex justify-end mt-6">
                                <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>
                                <DangerButton
                                    class="ml-3"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                    @click="destroy">
                                    Delete Post
                                </DangerButton>
                            </div>
                        </div>
                    </Modal>
            </div>
        </div>
    </AuthenticatedLayout>
</template>