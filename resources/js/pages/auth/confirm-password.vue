<template>
  <Head title="Confirm Password" />

  <div class="mb-4 text-sm text-gray-600">
    This is a secure area of the application. Please confirm your password
    before continuing.
  </div>

  <ValidationErrors class="mb-4" />

  <form @submit.prevent="submit">
    <div>
      <Label for="password" value="Password" />
      <Input
        id="password"
        type="password"
        class="mt-1 block w-full"
        v-model="form.password"
        required
        autocomplete="current-password"
        autofocus
      />
    </div>

    <div class="flex justify-end mt-4">
      <Button
        class="ml-4"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        Confirm
      </Button>
    </div>
  </form>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';

import GuestLayout from '@core/layout/guest';
import Button from '@/shared/base/button';
import Input from '@/shared/base/input';
import Label from '@/shared/base/label';
import ValidationErrors from '@/shared/base/validation-errors';

export default {
  layout: GuestLayout,

  components: {
    Button,
    Input,
    Label,
    ValidationErrors,
    Head,
  },

  data() {
    return {
      form: this.$inertia.form({
        password: '',
      }),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route('password.confirm'), {
        onFinish: () => this.form.reset(),
      });
    },
  },
};
</script>
