<template>
  <Head title="Email Verification" />

  <div class="mb-4 text-sm text-gray-600">
    Thanks for signing up! Before getting started, could you verify your email
    address by clicking on the link we just emailed to you? If you didn't
    receive the email, we will gladly send you another.
  </div>

  <div
    class="mb-4 font-medium text-sm text-green-600"
    v-if="verificationLinkSent"
  >
    A new verification link has been sent to the email address you provided
    during registration.
  </div>

  <form @submit.prevent="submit">
    <div class="mt-4 flex items-center justify-between">
      <Button
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        Resend Verification Email
      </Button>

      <Link
        :href="route('logout')"
        method="post"
        as="button"
        class="underline text-sm text-gray-600 hover:text-gray-900"
        >Log Out</Link
      >
    </div>
  </form>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3';

import GuestLayout from '@core/layout/guest';
import Button from '@/shared/base/button';

export default {
  layout: GuestLayout,

  components: {
    Button,
    Head,
    Link,
  },

  props: {
    status: String,
  },

  data() {
    return {
      form: this.$inertia.form(),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route('verification.send'));
    },
  },

  computed: {
    verificationLinkSent() {
      return this.status === 'verification-link-sent';
    },
  },
};
</script>
