<template>
  <div class="border rounded p-5 mb-5">
    <div class="text-center">
      <Link class="underline" :href="route('recargas.show', recarga.id)">
        {{ recarga.name }}
      </Link>
    </div>
    <div class="mt-5">
      {{ recarga.created_at }}
    </div>
    <div
      v-role:any="'super|admin'"
      class="flex gap-4 justify-end border-t mt-5 pt-5"
    >
      <Link
        class="font-extrabold underline"
        :href="route('recargas.edit', recarga.id)"
      >
        Edit
      </Link>
      <span
        class="font-extrabold cursor-pointer underline"
        @click="removeAction(recarga.id)"
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
    recarga: Object,
    removeAction: Function,
  },
};
</script>
