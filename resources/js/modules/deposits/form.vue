<template>
  <form @submit.prevent="submit">
    <div class="w-full flex">
      <div class="form-control mr-5 h-10 w-1/3">
        <Input
          id="valor"
          type="number"
          name="valor"
          v-model.number="form.valor"
          autofocus
          placeholder="Valor del depósito"
          min="0.00"
          max="1000.00"
          step="any"
        />
        <InputError :message="errors?.valor" />
      </div>
      <div class="form-control mr-5 h-10 w-1/3">
        <Input
          id="comprobante"
          type="text"
          name="comprobante"
          v-model="form.comprobante"
          autofocus
          placeholder="Número del comprobante"
        />
        <InputError :message="errors?.comprobante" />
      </div>
      <div class="form-control mr-5 h-10 w-1/3">
        <select
          class="border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
          v-model="form.bank"
          placeholder="Banco"
        >
          <option value="">Seleccione un banco</option>
          <option v-for="item in banks" value="item.id" :key="item.id">
            {{ item.name }}
          </option>
        </select>
        <InputError :message="errors?.bank" />
      </div>
      <div class="form-control mr-5 h-10 w-1/3">
        <InputFile
          id="imagen"
          v-model="form.imagen"
        />
        <InputError :message="errors?.comprobante" />
      </div>
    </div>
    <Button class="mt-10" type="submit">Submit</Button>
  </form>
</template>

<script>
import Input from '@/shared/base/input';
import InputFile from '@/shared/base/input-file';
import Select from '@/shared/base/select';
import InputError from '@/shared/base/input-error';
import Button from '@/shared/base/button';

export default {
  components: {
    Input,
    InputFile,
    Select,
    InputError,
    Button,
  },
  props: {
    deposit: {
      type: Object,
      required: false,
    },
    banks: {
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
        valor: this.deposit?.valor || '',
        comprobante: this.deposit?.comprobante || '',
        bank: this.deposit?.bank || '',
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
