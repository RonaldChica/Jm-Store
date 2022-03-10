<template>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="sm:rounded-lg">
        <div class="p-6 shadow-sm bg-white border-b border-gray-200">
          <Form :topic="topic" :errors="errors" />
        </div>
        <div class="mt-6 p-6 shadow-sm bg-white border-b border-gray-200">
          <div class="grid grid-cols-1">
            <Card
              v-for="question in unReadedQuestions"
              :key="question.id"
              :question="question"
            />
            <div v-if="noQuestions" class="text-lg">
              <h2 class="text-2xl mb-2">Ask something!</h2>
              By default all questions are under the anonymous user, in mark the
              checkbox if you want share your name
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Pagination from '@/shared/pagination';

import Card from './card';
import Form from './form';

export default {
  components: {
    Pagination,
    Card,
    Form,
  },
  props: {
    data: Object,
    topic: Object,
    questions: Array,
    errors: {
      type: Object,
      required: false,
    },
  },
  computed: {
    unReadedQuestions() {
      return this.questions.filter((question) => !question.readed);
    },
    noQuestions() {
      return this.unReadedQuestions.length === 0;
    },
  },
};
</script>
