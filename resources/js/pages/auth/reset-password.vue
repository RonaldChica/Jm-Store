<template>
  <Head title="Reset Password" />

  <ValidationErrors class="mb-4" />

  <form @submit.prevent="submit">
    <div>
      <Label for="email" value="Email" />
      <Input
        id="email"
        type="email"
        class="mt-1 block w-full"
        v-model="form.email"
        required
        autofocus
        autocomplete="username"
      />
    </div>

    <div class="mt-4">
      <Label for="password" value="Password" />
      <Input
        id="password"
        type="password"
        class="mt-1 block w-full"
        v-model="form.password"
        required
        autocomplete="new-password"
      />
    </div>

    <div class="mt-4">
      <Label for="password_confirmation" value="Confirm Password" />
      <Input
        id="password_confirmation"
        type="password"
        class="mt-1 block w-full"
        v-model="form.password_confirmation"
        required
        autocomplete="new-password"
      />
    </div>

    <div class="flex items-center justify-end mt-4">
      <Button
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        Reset Password
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

  props: {
    email: String,
    token: String,
  },

  data() {
    return {
      form: this.$inertia.form({
        token: this.token,
        email: this.email,
        password: '',
        password_confirmation: '',
      }),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route('password.update'), {
        onFinish: () => this.form.reset('password', 'password_confirmation'),
      });
    },
  },
};
</script>
