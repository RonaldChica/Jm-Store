<template>
  <Head title="Recarga" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Recargas</h2>
    </template>
    <Recargas :data="data" :errors="errors" :recargas="recargas" />
  </AuthenticatedLayout>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';

import AuthenticatedLayout from '@core/layout/authenticated';

import Recargas from '@modules/recargas';

const channel = 'recargas';
const events = [
  {
    name: 'Recarga\\RecargaUpdatedEvent',
    callback: (scope, recarga) => {
      scope.recargas = scope.recargas.map((_recarga) => {
        if (recarga.id === _recarga.id) {
          return recarga;
        }

        return _recarga;
      });
    },
  },
  {
    name: 'Recarga\\RecargaRemovedEvent',
    callback: (scope, recarga) => {
      scope.recargas = scope.recargas.filter((_recarga) => recarga.id !== _recarga.id);
    },
  },
];

export default {
  components: {
    AuthenticatedLayout,
    Head,
    Recargas,
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
      recargas: data,
    };
  },
  mounted() {
    events.forEach((event) => {
      window.Echo.private(channel).listen(event.name, ({ recarga }) =>
        event.callback(this, recarga)
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
