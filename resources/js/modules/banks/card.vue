<template>
  <div class="border rounded p-5 mb-5">
    <div class="text-center">
      {{ bank.price }}
    </div>
    <div class="text-center">
      {{ bank.diamantes }}
    </div>
    <div class="text-center">
      {{ bank.bonus }}
    </div>
    <div class="mt-5">
      {{ bank.created_at }}
    </div>
    <div
      v-role:any="'super|admin'"
      class="flex gap-4 justify-end border-t mt-5 pt-5"
    >
      <Link
        class="font-extrabold underline"
        :href="route('topics.edit', bank.id)"
      >
        Edit
      </Link>
      <span
        class="font-extrabold cursor-pointer underline"
        @click="removeAction(bank.id)"
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
    bank: Object,
    removeAction: Function,
  },
};
</script>
