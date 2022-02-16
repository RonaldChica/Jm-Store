<template>
  <div class="border rounded p-5 mb-5">
    <div class="text-center">
      {{ topic.name }}
    </div>
    <div class="mt-5">
      {{ topic.created_at }}
    </div>
    <div class="flex justify-between border-t mt-5 pt-5">
      <Link class="underline" :href="route('topics.show', topic.id)">
        Show
      </Link>
      <Link class="underline" :href="route('topics.edit', topic.id)">
        Edit
      </Link>
      <span class="cursor-pointer underline" @click="removeAction(topic.id)">
        Remove
      </span>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
  components: {
    Link
  },
  props: {
    topic: Object,
    removeAction: Function
  }
};
</script>
