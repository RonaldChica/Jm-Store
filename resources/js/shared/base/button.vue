<template>
  <button
    :type="type"
    :class="{ 'bg-gray-500': active, 'bg-gray-800': !active }"
    class="
      inline-flex
      items-center
      px-4
      py-2
      border border-transparent
      rounded-md
      font-semibold
      text-xs text-white
      uppercase
      tracking-widest
      hover:bg-gray-700
      active:bg-gray-900
      focus:outline-none focus:border-gray-900 focus:shadow-outline-gray
      transition
      ease-in-out
      duration-150
    "
  >
    <slot />
  </button>
</template>

<script>
export default {
  props: {
    type: {
      type: String,
      default: 'submit',
    },
    active: {
      type: Boolean,
      default: false,
    },
  },
};
</script>
