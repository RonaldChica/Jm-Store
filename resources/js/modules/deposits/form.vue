<template>
  <form @submit.prevent="submit">
    <div class="w-full flex">
      <div class="form-control mr-5 h-10 w-1/3">
        <Input
          id="price"
          type="number"
          name="price"
          v-model.number="form.price"
          autofocus
          placeholder="Precio"
          min="0.00"
          max="1000.00"
          step="any"
        />
        <InputError :message="errors?.price" />
      </div>
      <div class="form-control mr-5 h-10 w-1/3">
        <Input
          id="diamantes"
          type="text"
          name="diamantes"
          v-model="form.diamantes"
          autofocus
          placeholder="Diamantes"
        />
        <InputError :message="errors?.diamantes" />
      </div>
      <div class="form-control mr-5 h-10 w-1/3">
        <Input
          id="bonus"
          type="text"
          name="bonus"
          v-model="form.bonus"
          autofocus
          placeholder="Bonus"
        />
        <InputError :message="errors?.bonus" />
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
    deposit: {
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
        price: this.deposit?.price || '',
        diamantes: this.deposit?.diamantes || '',
        bonus: this.deposit?.bonus || '',
      }),
    };
  },
  methods: {
    submit() {
      const options = {
        preserveState: false,
        onFinish: () => this.form.reset(),
      };

      if (this.deposit?.id) {
        this.form.put(`/deposits/${this.deposit.id}`, options);
      } else {
        this.form.post('/deposits', options);
      }
    },
  },
};
</script>
