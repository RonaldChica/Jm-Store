<template>
  <form @submit.prevent="submit">
    <div class="form-control mr-5 h-10 w-1/2">
      <Input
        id="name"
        type="text"
        name="name"
        v-model="form.name"
        autofocus
        placeholder="Name"
      />
      <InputError :message="errors?.name" />
    </div>
    <Button class="mt-10" type="submit">Submit</Button>
  </form>
</template>

<script>
import Input from '@/shared/base/input';
import InputError from '@/shared/base/input-error';
import Button from '@/shared/base/button';

export default {
  components: {
    Input,
    InputError,
    Button,
  },
  props: {
    topic: {
      type: Object,
      required: false,
    },
    errors: {
      type: Object,
      required: false,
    },
  },
  data() {
    return {
      form: this.$inertia.form({
        name: this.topic?.name || '',
      }),
    };
  },
  methods: {
    submit() {
      const options = {
        preserveState: false,
        onFinish: () => this.form.reset(),
      };

      if (this.topic?.id) {
        this.form.put(`/topics/${this.topic.id}`, options);
      } else {
        this.form.post('/topics', options);
      }
    },
  },
};
</script>
