<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Modal from '@/Components/Modal.vue';
import Pagination from '@/Components/pagination.vue';
import { defineProps, ref, computed, onMounted } from 'vue';

const showModel = ref(false);
const postId = ref(null);
const searchTerm = ref('');

const { posts } = defineProps({
    posts: {
        type: Object,
        default: () => ({}),
    }

});

const filteredPosts = computed(() => {
  if (!searchTerm.value) {
    return posts.data; 
  }

  const term = searchTerm.value.toLowerCase();
  return posts.data.filter(post => post.title.toLowerCase().includes(term));
});

onMounted(() => {
  searchTerm.value.focus()
});

const form = useForm({

});

const openModel = (id) => {
    postId.value = id;
    showModel.value = true;
}

const destroy = () => {
    form.delete(route('posts.destroy', postId.value));
    showModel.value = false;
}

const closeModal = () => {
    showModel.value = false;
}
</script>

<template>
    <Head title="Posts" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Posts</h2>
        </template>
         <div class="w-full px-4 mx-auto mt-20 mb-12 xl:w-8/12 xl:mb-0">
            <div class="relative flex flex-col w-full min-w-0 mb-6 break-words bg-white rounded shadow-lg">
                <div class="px-4 py-3 mb-0 border-0 rounded-t">
                    <div class="flex flex-wrap items-center">
                        <div class="relative flex-1 flex-grow w-full max-w-full px-4">
                             <div v-if="$page.props.flash.message" class="mb-4 text-blue-600">
                                {{ $page.props.flash.message }}
                            </div>
                        <h3 class="text-base font-semibold text-blueGray-700">
                            Posts 
                        </h3>
                        </div>
                        <div class="relative flex-1 flex-grow w-full max-w-full px-4 text-right">
                            <Link :href="route('posts.create')" class="px-3 py-1 mb-1 mr-1 text-xs font-bold text-white uppercase transition-all duration-150 ease-linear bg-indigo-500 rounded outline-none active:bg-indigo-600 focus:outline-none">
                                Create
                            </Link>
                        </div>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto">
                    
                        <div class="mb-2">
                            <input
                                type="text"
                                v-model="searchTerm"
                                placeholder="Search..."   
                                @keyup="onKeyup"
                                ref="searchTerm"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-60 p-2.5 "
                            />
                        </div>
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
                        <tr v-for="post in filteredPosts" :key="post.id">
                            <th class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap text-blueGray-700">
                                {{ post.id }}
                            </th>
                            <th class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap text-blueGray-700">
                                {{ post.title }}
                            </th>
                            <th class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap text-blueGray-700">
                                {{ post.content }}
                            </th>
                            <th class="p-4 px-6 text-xs text-left text-red-400 align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                <Link :href="route('posts.edit', post.id)">Edit</Link> |
                               <button @click="openModel(post.id)">Delete</button>
                            </th>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <Pagination :data="posts"></Pagination>
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