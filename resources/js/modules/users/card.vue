<template>
  <div class="border rounded p-5 mb-5">
    <div class="flex justify-center mb-2">
      <img class="rounded-full" :src="user.avatar" />
    </div>
    <div class="text-center mt-4">
      {{ user.name }}
    </div>
    <!-- <div class="flex justify-end border-t mt-5 pt-5">
      <Link class="underline" :href="route('users.show', user.id)">
        Show
      </Link>
    </div> -->
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
  components: {
    Link
  },
  props: {
    user: Object
  }
};
</script>
