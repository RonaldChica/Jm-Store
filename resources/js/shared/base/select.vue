<template>
  <select
    class="
      border
      border-gray-300
      focus:border-indigo-300
      focus:ring
      focus:ring-indigo-200
      focus:ring-opacity-50
      rounded-md
      shadow-sm
      w-full
    "
    :value="modelValue"
    @select="$emit('update:modelValue', $event.target.value)"
    ref="select"
  />
</template>

<script>
export default {
  props: ['modelValue'],

  emits: ['update:modelValue'],

  methods: {
    focus() {
      this.$refs.select.focus();
    },
  },
};
</script>
