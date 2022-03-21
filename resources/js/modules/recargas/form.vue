<template>
  <div
    class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
    role="alert"
  >
    <span class="font-medium"> {{ error }}</span>
  </div>
  <form @submit.prevent="submit">
    <div class="form-control mr-5 h-10 w-1/2">
      <Input
        id="name"
        type="text"
        name="name"
        v-model="form.playerId"
        autofocus
        placeholder="Id de Jugador"
      />
      <InputError :message="errors?.playerId" />
    </div>
    <Button class="mt-10" type="submit">Recargar</Button>
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
    recarga: {
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
      error: '',
      form: this.$inertia.form({
        playerId: this.recarga?.playerId || '',
      }),
    };
  },
  methods: {
    submit() {
      const options = {
        preserveState: true,
        onFinish: () => this.form.reset(),
        onError: (errors) => this.error = errors.create,
      };

      if (this.recarga?.id) {
        this.form.put(`/recargas/${this.recarga.id}`, options);
      }
    },
  },
};
</script>
