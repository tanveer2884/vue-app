<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Pagination from '@/Components/pagination.vue';
import { computed } from 'vue';

 defineProps({
    products: {
        type: Object,
        default: () => ({}),
    },
});



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
                            <th class="p-4 px-6 text-xs text-left text-red-400 align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                <a href="#">Edit</a> |
                               <button >Delete</button>
                            </th>
                        </tr>
                        </tbody>
                    </table>
                </div>
                 <Pagination :data="products" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>