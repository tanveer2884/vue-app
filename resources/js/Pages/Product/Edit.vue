<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, usePage, Link, router } from "@inertiajs/vue3";
import Button from 'primevue/button';
import Textarea from 'primevue/textarea';
import InputText from 'primevue/inputtext';
import FileUpload from 'primevue/fileupload';
import Card from 'primevue/card';
import { computed, ref } from 'vue';

const show = ref(true);

defineProps({ errors: Object, product: Object })

const product = usePage().props.product;

const form = useForm({

  id: product.id,
  title: product.title,
  des: product.des,
  img: null
  
});

function updateProduct() {
  router.post(`/products/${product.id}`, {
    _method: 'put',
    title: form.title,
    des: form.des,
    img: form.img,
  })
}
computed: {
  if(!product.media[0]) {
    show.value = false
  }
}
</script>

<template>
  <Head title="Product Create" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Product Create
      </h2>
    </template>
    <br>
    <Card class="product-card">
      <template #title> Create Product </template>
      <template #content>
        <div class="flex justify-start">
          <div class="w-full mx-auto">
            <form @submit.prevent="updateProduct" class="mt-5">
              <div class="flex flex-col px-8 pt-6 pb-8 my-2 mb-4">
                <div class="mx-3 mb-6 ">
                  <span class="p-float-label">
                    <InputText id="username" v-model="form.title"
                      :class="errors.title ? 'username p-invalid' : 'username'" requried />
                    <label for="username">Title</label>
                  </span>
                  <div v-if="errors.title" class="text-red-600">
                    {{ errors.title }}
                  </div>
                </div>
                <div class="mx-3 mb-6" v-show="show">
                  <Button label="Change Image" class="float-right" @click="show = false" link />
                  <div class="flex justify-center card">
                    <img :src="product.media[0] ? product.media[0].original_url : ''" alt="">
                  </div>
                </div>
                <div class="mx-3 mb-6" v-show="!show">
                  <div class="card">
                    <FileUpload name="img" @input="form.img = $event.target.files[0]" @upload="onAdvancedUpload($event)"
                      :multiple="true" accept="image/*" :maxFileSize="1000000">
                      <template #empty>
                        <p>Drag and drop files to here to upload.</p>
                      </template>
                    </FileUpload>
                    
                  </div>
                </div>
                <div class="mx-3 mb-6">
                  <span class="p-float-label">
                    <Textarea v-model="form.des" rows="5" cols="30"
                      :class="errors.title ? 'username p-invalid' : 'username'" />
                    <label>Description</label>
                  </span>
                  <div v-if="errors.des" class="text-red-600">
                    {{ errors.des }}
                  </div>
                </div>
                <div class="float-right mx-3 ml-2 space-x-2">
                  <Link :href="route('products.index')" severity="warning" class="p-button p-component p-button-warning">
                  Cancle </Link>
                  <Button label="Submit" type="submit" />
                </div>
              </div>
            </form>
          </div>
        </div>
      </template>
    </Card>
  </AuthenticatedLayout>
</template>

<style>
.product-card {
  width: 50%;
  margin-left: 25%;
  margin-bottom: 30%;
}

.username {
  width: 100%;
}

img{
  height: 10% !important;
  width: 60% !important;
}

</style>