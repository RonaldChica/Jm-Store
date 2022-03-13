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
    product: {
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
        name: this.product?.name || '',
      }),
    };
  },
  methods: {
    submit() {
      const options = {
        preserveState: false,
        onFinish: () => this.form.reset(),
      };

      if (this.product?.id) {
        this.form.put(`/products/${this.product.id}`, options);
      } else {
        this.form.post('/products', options);
      }
    },
  },
};
</script>
