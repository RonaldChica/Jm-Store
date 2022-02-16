<template>
  <div class="flex flex-wrap justify-between">
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
