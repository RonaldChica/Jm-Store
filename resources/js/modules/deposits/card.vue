<template>
  <div class="border rounded p-5 mb-5">
    <div class="text-center">
      {{ deposit.price }}
    </div>
    <div class="text-center">
      {{ deposit.diamantes }}
    </div>
    <div class="text-center">
      {{ deposit.bonus }}
    </div>
    <div class="mt-5">
      {{ deposit.created_at }}
    </div>
    <div
      v-role:any="'super|admin'"
      class="flex gap-4 justify-end border-t mt-5 pt-5"
    >
      <Link
        class="font-extrabold underline"
        :href="route('topics.edit', deposit.id)"
      >
        Edit
      </Link>
      <span
        class="font-extrabold cursor-pointer underline"
        @click="removeAction(deposit.id)"
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
    deposit: Object,
    removeAction: Function,
  },
};
</script>
