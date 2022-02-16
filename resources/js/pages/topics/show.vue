<template>
  <Head :title="topic?.name" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ topic?.name }}
      </h2>
    </template>
    <Questions :topic="topic" :questions="topic.questions" :errors="errors" />
  </AuthenticatedLayout>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';

import AuthenticatedLayout from '@core/layout/authenticated';

import Questions from '@modules/questions';

const events = [
  {
    name: 'Question\\QuestionAddedEvent',
    callback: (scope, question) => {
      const questions = scope.topic.questions;
      questions.push(question);

      scope.topic = {
        ...scope.topic,
        questions,
      };
    },
  },
  {
    name: 'Question\\QuestionReadedEvent',
    callback: (scope, question) => {
      const questions = scope.topic.questions.map((_question) => {
        if (question.id === _question.id) {
          return question;
        }

        return _question;
      });

      scope.topic = {
        ...scope.topic,
        questions,
      };
    },
  },
];

export default {
  components: {
    AuthenticatedLayout,
    Head,
    Questions,
  },
  props: {
    data: Object,
    errors: {
      type: Object,
      required: false,
    },
  },
  data(props) {
    return {
      topic: props.data,
    };
  },
  computed: {
    questions() {
      return this.topic?.questions || [];
    },
    channel() {
      return `topics.${this.topic.id}.question`;
    },
  },
  mounted() {
    events.forEach((event) => {
      window.Echo.private(this.channel).listen(event.name, ({ question }) =>
        event.callback(this, question)
      );
    });
  },
  unmounted() {
    events.forEach((event) => {
      window.Echo.private(this.channel).stopListening(event.name);
    });
  },
};
</script>
