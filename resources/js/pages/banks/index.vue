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

import { InertiaProgress } from '@inertiajs/progress'

InertiaProgress.init({
  // The delay after which the progress bar will
  // appear during navigation, in milliseconds.
  delay: 250,

  // The color of the progress bar.
  color: '#29d',

  // Whether to include the default NProgress styles.
  includeCSS: true,

  // Whether the NProgress spinner will be shown.
  showSpinner: true,
})

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
