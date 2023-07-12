<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";

defineProps({ errors: Object })
const form = useForm({
    title: '',
    content: '',
});
</script>

<template>
  <Head title="Post Create" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Post Create
      </h2>
    </template>

    <div class="flex items-center justify-start bg-white">
      <div class="mx-auto w-full max-w-lg">       
        <form @submit.prevent="form.post(route('posts.store'))" class="mt-5">
          <input type="hidden" name="access_key" value="YOUR_ACCESS_KEY_HERE" />
          <div class="grid gap-6 sm:grid-cols-2">
            <div class="relative z-0">
              <input
                type="text"
                v-model="form.title"
                class="peer block w-full appearance-none border-0 border-b border-gray-500 bg-transparent py-2.5 px-0 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0"
                placeholder=" "/>
              <label
                class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Title</label>
                 <div v-if="errors.title" class="text-red-600">
                {{ errors.title }}
            </div>
            </div>
           
            <div class="relative z-0 col-span-2">
              <textarea
                name="message"
                v-model="form.content"
                rows="5"
                class="peer block w-full appearance-none border-0 border-b border-gray-500 bg-transparent py-2.5 px-0 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0"
                placeholder=" "></textarea>
              <label class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:text-blue-600 peer-focus:dark:text-blue-500">
                Content
            </label>
            <div v-if="errors.content" class="text-red-600">
                {{ errors.content }}
            </div>
            </div>
          </div>
            <Link :href="route('posts.index')" class="mt-5 rounded-md bg-black mr-2 px-10 py-2 text-white">
                cancle
            </Link>
           <button type="submit" :disabled="form.processing" class="mt-5 rounded-md bg-black px-10 py-2 text-white">
                Submit
          </button>
        </form>
      </div>
    </div>
  </AuthenticatedLayout>
</template>