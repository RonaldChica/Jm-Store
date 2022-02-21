<template>
  <Head :title="recarga?.name" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ recarga?.name }}
      </h2>
    </template>
  </AuthenticatedLayout>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';

import AuthenticatedLayout from '@core/layout/authenticated';

export default {
  components: {
    AuthenticatedLayout,
    Head,
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
      recarga: props.data,
    };
  },
  computed: {
    questions() {
      return this.recarga?.questions || [];
    },
    channel() {
      return `recargas.${this.recarga.id}`;
    },
  },

  unmounted() {
    events.forEach((event) => {
      window.Echo.private(this.channel).stopListening(event.name);
    });
  },
};
</script>
