<template>
  <form @submit.prevent="submit">
    <div class="w-full flex">
      <div class="form-control mr-5 h-10 w-1/3">
        <Input
          id="name"
          type="text"
          name="name"
          v-model.number="form.name"
          autofocus
          placeholder="Nombre"
        />
        <InputError :message="errors?.name" />
      </div>
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
    bank: {
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
        name: this.bank?.name || ''
      }),
    };
  },
  methods: {
    submit() {
      const options = {
        preserveState: false,
        onFinish: () => this.form.reset(),
      };

      if (this.bank?.id) {
        this.form.put(`/banks/${this.bank.id}`, options);
      } else {
        this.form.post('/banks', options);
      }
    },
  },
};
</script>
