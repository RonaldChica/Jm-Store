<template>
  <div class="flex flex-wrap justify-between">
    <Card v-for="item in topics" :key="item.id" :topic="item" :removeAction="removeAction" />
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

import Card from './card';

export default {
  components: {
    Link,
    Card
  },
  props: {
    topics: Array,
    removeAction: Function
  }
};
</script>
