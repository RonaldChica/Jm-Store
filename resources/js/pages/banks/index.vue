<template>
  <Head title="Bank" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Banks</h2>
    </template>
    <Banks :data="data" :errors="errors" :banks="banks" />
  </AuthenticatedLayout>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';

import AuthenticatedLayout from '@core/layout/authenticated';

import Banks from '@modules/banks';

const channel = 'banks';
const events = [
  {
    name: 'Bank\\BankUpdatedEvent',
    callback: (scope, bank) => {
      scope.banks = scope.banks.map((_bank) => {
        if (bank.id === _bank.id) {
          return bank;
        }

        return _bank;
      });
    },
  },
  {
    name: 'Bank\\BankRemovedEvent',
    callback: (scope, bank) => {
      scope.banks = scope.banks.filter((_bank) => bank.id !== _bank.id);
    },
  },
];

export default {
  components: {
    AuthenticatedLayout,
    Head,
    Banks,
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
      banks: data,
    };
  },
  mounted() {
    events.forEach((event) => {
      window.Echo.private(channel).listen(event.name, ({ bank }) =>
        event.callback(this, bank)
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
