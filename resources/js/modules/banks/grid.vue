<template>
  <div class="grid grid-cols-4 gap-4">
    <Card v-for="item in banks" :key="item.id" :bank="item" :removeAction="removeAction" />
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
    banks: Array,
    removeAction: Function
  }
};
</script>
