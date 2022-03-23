<template>
  <Head title="Deposit" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Deposits</h2>
    </template>
    <Deposits :data="data" :errors="errors" :deposits="deposits" />
  </AuthenticatedLayout>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';

import AuthenticatedLayout from '@core/layout/authenticated';

import Deposits from '@modules/deposits';

const channel = 'deposits';
const events = [
  {
    name: 'Deposit\\DepositUpdatedEvent',
    callback: (scope, deposit) => {
      scope.deposits = scope.deposits.map((_deposit) => {
        if (deposit.id === _deposit.id) {
          return deposit;
        }

        return _deposit;
      });
    },
  },
  {
    name: 'Deposit\\DepositRemovedEvent',
    callback: (scope, deposit) => {
      scope.deposits = scope.deposits.filter((_deposit) => deposit.id !== _deposit.id);
    },
  },
];

export default {
  components: {
    AuthenticatedLayout,
    Head,
    Deposits,
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
      deposits: data,
    };
  },
  mounted() {
    events.forEach((event) => {
      window.Echo.private(channel).listen(event.name, ({ deposit }) =>
        event.callback(this, deposit)
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
