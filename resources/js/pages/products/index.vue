<template>
  <Head title="Product" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Products</h2>
    </template>
    <Products :data="data" :errors="errors" :products="products" />
  </AuthenticatedLayout>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';

import AuthenticatedLayout from '@core/layout/authenticated';

import Products from '@modules/products';

const channel = 'products';
const events = [
  {
    name: 'Product\\ProductUpdatedEvent',
    callback: (scope, product) => {
      scope.products = scope.products.map((_product) => {
        if (product.id === _product.id) {
          return product;
        }

        return _product;
      });
    },
  },
  {
    name: 'Product\\ProductRemovedEvent',
    callback: (scope, product) => {
      scope.products = scope.products.filter((_product) => product.id !== _product.id);
    },
  },
];

export default {
  components: {
    AuthenticatedLayout,
    Head,
    Products,
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
      products: data,
    };
  },
  mounted() {
    events.forEach((event) => {
      window.Echo.private(channel).listen(event.name, ({ product }) =>
        event.callback(this, product)
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
