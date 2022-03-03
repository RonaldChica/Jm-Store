<template>
  <div class="border rounded p-5 mb-5">
    <div class="text-center">
      {{ recarga.name }}
    </div>
    <div class="mt-5">
      {{ recarga.created_at }}
    </div>
    <div class="flex justify-between border-t mt-5 pt-5">
      <Link class="underline" :href="route('recargas.show', recarga.id)">
        Show
      </Link>
      <Link
        v-role:any="'super|admin'"
        class="underline"
        :href="route('recargas.edit', recarga.id)"
      >
        Edit
      </Link>
      <span
        v-role:any="'super|admin'"
        class="cursor-pointer underline"
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
