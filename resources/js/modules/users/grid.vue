<template>
  <div class="grid grid-cols-5 gap-4">
    <Card v-for="item in users" :key="item.id" :user="item" />
  </div>
</template>

<script>
import Card from './card';

export default {
  components: {
    Card
  },
  props: {
    users: Array
  }
};
</script>
