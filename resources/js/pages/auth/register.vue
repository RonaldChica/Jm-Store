<template>
  <Head title="Register" />

  <ValidationErrors class="mb-4" />

  <form action="#" method="POST" @submit.prevent="recaptcha" id="registerForm">
    <input
      type="hidden"
      class="g-recaptcha"
      name="captcha_token"
      id="captcha_token"
    />
    <div>
      <Label for="name" value="Name" />
      <Input
        id="name"
        type="text"
        class="mt-1 block w-full"
        v-model="form.name"
        required
        autofocus
        autocomplete="name"
      />
    </div>

    <div class="mt-4">
      <Label for="email" value="Email" />
      <Input
        id="email"
        type="email"
        class="mt-1 block w-full"
        v-model="form.email"
        required
        autocomplete="username"
      />
    </div>

    <div class="mt-4">
      <Label for="password" value="Password" />
      <Input
        id="password"
        type="password"
        name="password"
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
        name="password_confirmation"
        class="mt-1 block w-full"
        v-model="form.password_confirmation"
        required
        autocomplete="new-password"
      />
    </div>

    <div class="flex items-center justify-end mt-4">
      <Link
        :href="route('login')"
        class="underline text-sm text-gray-600 hover:text-gray-900"
      >
        Already registered?
      </Link>

      <Button
        class="ml-4"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        Register
      </Button>
    </div>
  </form>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { useReCaptcha } from "vue-recaptcha-v3";

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
    Link,
  },

  data() {
     const form = this.$inertia.form({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        captcha_token: '',
        terms: false,
      });

    const { executeRecaptcha, recaptchaLoaded } = useReCaptcha();

    const recaptcha = async () => {
      await recaptchaLoaded();
      form.captcha_token = await executeRecaptcha('login');
      submit();
    }

    function submit() {
      form.post(route('register'), {
        preserveScroll: true,
        onSuccess: () => form.reset('password', 'password_confirmation'),
      });
    }

    return {
      form ,recaptcha, submit
    }
  },
};
</script>
