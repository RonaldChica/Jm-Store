<template>
  <Table>
    <template v-slot:thead>
      <HeaderCell v-for="field in fields" :key="field">
        {{ field }}
      </HeaderCell>
      <HeaderCell v-role:any="'super|admin'"> actions </HeaderCell>
    </template>
    <template v-slot:tbody>
      <tr v-for="item in products" :key="item.id">
        <DataCell v-for="key in fields" :key="key">
          {{ item[key] }}
        </DataCell>
        <DataCell v-role:any="'super|admin'">
          <Link
            class="font-extrabold underline mr-2"
            :href="route('products.edit', item.id)"
          >
            Edit
          </Link>
          <span
            class="font-extrabold cursor-pointer underline"
            @click="removeAction(item.id)"
          >
            Remove
          </span>
        </DataCell>
      </tr>
    </template>
  </Table>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

import Table from '@/shared/table';
import DataCell from '@/shared/table/data-cell';
import HeaderCell from '@/shared/table/header-cell';

export default {
  components: {
    Link,
    Table,
    DataCell,
    HeaderCell,
  },
  props: {
    products: Array,
    removeAction: Function,
  },
  data() {
    return {
      excludeFields: ['id', 'name'],
    };
  },
  computed: {
    fields() {
      if (this.products.length <= 0) {
        return [];
      }

      const row = this.products[0];

      return Object.keys(row).filter(
        (key) => !this.excludeFields.includes(key)
      );
    },
  },
};
</script>
