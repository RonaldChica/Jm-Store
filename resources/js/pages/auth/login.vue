<template>
  <Head title="Log in" />

  <ValidationErrors class="mb-4" />

  <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
    {{ status }}
  </div>

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
        autocomplete="current-password"
      />
    </div>

    <div class="block mt-4">
      <label class="flex items-center">
        <Checkbox name="remember" v-model:checked="form.remember" />
        <span class="ml-2 text-sm text-gray-600">Remember me</span>
      </label>
    </div>

    <div class="flex items-center justify-end mt-4">
      <Link
        v-if="canResetPassword"
        :href="route('password.request')"
        class="underline text-sm text-gray-600 hover:text-gray-900 ml-4"
      >
        Forgot your password?
      </Link>

      <Button
        class="ml-4"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        Log in
      </Button>
    </div>
  </form>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3';

import GuestLayout from '@core/layout/guest';
import Button from '@/shared/base/button';
import Checkbox from '@/shared/base/checkbox';
import Input from '@/shared/base/input';
import Label from '@/shared/base/label';
import ValidationErrors from '@/shared/base/validation-errors';

export default {
  layout: GuestLayout,

  components: {
    Button,
    Checkbox,
    Input,
    Label,
    ValidationErrors,
    Head,
    Link,
  },

  props: {
    canResetPassword: Boolean,
    status: String,
  },

  data() {
    return {
      form: this.$inertia.form({
        email: '',
        password: '',
        remember: false,
      }),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route('login'), {
        onFinish: () => this.form.reset('password'),
      });
    },
  },
};
</script>
