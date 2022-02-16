<template>
  <div class="overflow-x-auto w-full">
    <table class="mx-auto w-full whitespace-nowrap divide-y divide-gray-400 overflow-hidden">
      <thead>
        <tr>
          <slot name="thead" />
        </tr>
      </thead>
      <tbody>
        <slot name="tbody" />
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    items: Array,
  },
  computed: {
    fields() {
      if (this.items.length <= 0) {
        return [];
      }

      const row = this.items[0];

      return Object.keys(row);
    },
  },
};
</script>
