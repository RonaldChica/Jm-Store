<template>
  <Head title="Topic" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Topic: {{ topic?.id }}</h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-6 p-6 shadow-sm bg-white border-b border-gray-200">
          <Form :topic="topic" :errors="errors" />
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';

import AuthenticatedLayout from '@core/layout/authenticated';

import Form from '@modules/topics/form';

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
      topic: props.data,
    };
  }
};
</script>
