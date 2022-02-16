<template>
  <Head title="Log in" />

  <ValidationErrors class="mb-4" />

  <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
    {{ status }}
  </div>

  <a
    :href="route('socialite.redirect')"
    class="underline text-sm text-gray-600 hover:text-gray-900"
    >Login with google</a
  >
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';

import GuestLayout from '@core/layout/guest';
import ValidationErrors from '@/shared/base/validation-errors';

export default {
  layout: GuestLayout,

  components: {
    ValidationErrors,
    Head
  },
  props: {
    status: String,
  }
};
</script>
