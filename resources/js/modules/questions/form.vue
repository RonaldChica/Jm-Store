<template>
  <form @submit.prevent="submit">
    <div class="flex">
      <div class="form-control mr-5 h-10">
        <Input
          id="question"
          type="text"
          name="question"
          v-model="form.question"
          autofocus
          placeholder="Question"
        />
        <InputError :message="errors?.question" />
      </div>
      <div class="form-control flex items-center mr-5">
        <Checkbox name="anonymous" v-model:checked="form.anonymous" />
        <span class="ml-4">Ask a anonymous user</span>
      </div>
    </div>
    <Button class="mt-10" type="submit">Ask</Button>
  </form>
</template>

<script>
import Checkbox from '@/shared/base/checkbox';
import Input from '@/shared/base/input';
import InputError from '@/shared/base/input-error';
import Button from '@/shared/base/button';

export default {
  components: {
    Checkbox,
    Input,
    InputError,
    Button,
  },
  props: {
    topic: Object,
    errors: {
      type: Object,
      required: false,
    },
  },
  data() {
    return {
      form: this.$inertia.form({
        question: '',
        anonymous: true,
        topicId: this.topic.id,
      }),
    };
  },
  methods: {
    submit() {
      this.form.post('/questions', {
        preserveState: false,
        onFinish: () => this.form.reset('question'),
      });
    },
  },
};
</script>
