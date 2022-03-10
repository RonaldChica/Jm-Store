+
<template>
  <div class="relative border rounded p-5 mb-5">
    <div class="flex items-center mb-5">
      <div class="flex w-10 h-10">
        <img
          v-if="question?.user?.avatar"
          class="rounded-full"
          :src="question.user.avatar"
        />
        <div
          v-else
          class="p-5 shadow-sm bg-purple-500 rounded-full text-xl font-bold text-white flex items-center justify-center"
        />
      </div>
      <span class="text-xl ml-2">{{
        question.user ? question.user.name : 'Anonymous'
      }}</span>
    </div>
    <p class="text-2xl mb-2 text-2xl">
      {{ question.question }}
    </p>
    <span
      v-role:any="'super|admin'"
      v-if="!question.readed"
      class="absolute right-3 top-3 flex cursor-pointer underline font-extrabold"
      @click="removeAction(topic.id)"
    >
      Mark as read <CheckIcon class="ml-2 text-green-500" style="width: 20px" />
    </span>
    <div class="flex border-t mt-5 pt-5">
      <span>{{ question.created_at }}</span>
    </div>
  </div>
</template>

<script>
import { CheckIcon } from '@heroicons/vue/solid';

export default {
  components: {
    CheckIcon,
  },
  props: {
    question: Object,
  },
  methods: {
    markAsRead() {
      this.$inertia.delete(this.route('questions.destroy', this.question.id));
    },
  },
};
</script>
