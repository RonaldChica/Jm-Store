<template>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="sm:rounded-lg">
        <div class="p-6 shadow-sm bg-white border-b border-gray-200">
          <Form :topic="topic" :errors="errors" />
        </div>
        <div class="mt-6 p-6 shadow-sm bg-white border-b border-gray-200">
          <List :questions="unReadedQuestions" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Pagination from '@/shared/pagination';

import List from './list';
import Form from './form';

export default {
  components: {
    Pagination,
    List,
    Form,
  },
  props: {
    data: Object,
    topic: Object,
    questions: Array,
    errors: {
      type: Object,
      required: false
    }
  },
  computed: {
    unReadedQuestions() {
      return this.questions.filter((question) => !question.readed)
    }
  }
};
</script>
