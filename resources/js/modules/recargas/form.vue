<template>
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
      form: this.$inertia.form({
        playerId: this.recarga?.playerId || '',
      }),
    };
  },
  methods: {
    submit() {
      const options = {
        preserveState: false,
        onFinish: () => this.form.reset(),
      };

      if (this.recarga?.id) {
        this.form.put(`/recargas/${this.recarga.id}`, options);
      } else {
        this.form.post('/recargas', options);
      }
    },
  },
};
</script>
