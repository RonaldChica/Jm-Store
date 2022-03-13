<template>
  <div class="border rounded p-5 mb-5">
    <div class="text-center">
      <Link class="underline" :href="route('topics.show', product.id)">
        {{ product.name }}
      </Link>
    </div>
    <div class="mt-5">
      {{ product.created_at }}
    </div>
    <div
      v-role:any="'super|admin'"
      class="flex gap-4 justify-end border-t mt-5 pt-5"
    >
      <Link
        class="font-extrabold underline"
        :href="route('topics.edit', product.id)"
      >
        Edit
      </Link>
      <span
        class="font-extrabold cursor-pointer underline"
        @click="removeAction(product.id)"
      >
        Remove
      </span>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
  components: {
    Link,
  },
  props: {
    product: Object,
    removeAction: Function,
  },
};
</script>
