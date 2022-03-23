<template>
  <Head title="Bank" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Bank: {{ bank?.id }}</h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-6 p-6 shadow-sm bg-white border-b border-gray-200">
          <Form :bank="bank" :errors="errors" />
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';

import AuthenticatedLayout from '@core/layout/authenticated';

import Form from '@modules/products/form';

export default {
  components: {
    AuthenticatedLayout,
    Head,
    Form,
  },
  props: {
    data: Object,
    errors: {
      type: Object,
      required: false,
    },
  },
  data(props) {
    return {
      bank: props.data,
    };
  }
};
</script>
