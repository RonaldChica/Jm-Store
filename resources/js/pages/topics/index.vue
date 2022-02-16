<template>
  <Head title="Topic" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Topics</h2>
    </template>
    <Topics :data="data" :errors="errors" :topics="topics" />
  </AuthenticatedLayout>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';

import AuthenticatedLayout from '@core/layout/authenticated';

import Topics from '@modules/topics';

const channel = 'topics';
const events = [
  {
    name: 'Topic\\TopicUpdatedEvent',
    callback: (scope, topic) => {
      scope.topics = scope.topics.map((_topic) => {
        if (topic.id === _topic.id) {
          return topic;
        }

        return _topic;
      });
    },
  },
  {
    name: 'Topic\\TopicRemovedEvent',
    callback: (scope, topic) => {
      scope.topics = scope.topics.filter((_topic) => topic.id !== _topic.id);
    },
  },
];

export default {
  components: {
    AuthenticatedLayout,
    Head,
    Topics,
  },
  props: {
    data: Object,
    errors: {
      type: Object,
      required: false,
    },
  },
  data(props) {
    const { data } = props.data;

    return {
      topics: data,
    };
  },
  mounted() {
    events.forEach((event) => {
      window.Echo.private(channel).listen(event.name, ({ topic }) =>
        event.callback(this, topic)
      );
    });
  },
  unmounted() {
    events.forEach((event) => {
      window.Echo.private(channel).stopListening(event.name);
    });
  },
};
</script>
