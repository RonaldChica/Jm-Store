<template>
  <Table>
    <template v-slot:thead>
      <HeaderCell>
        Precio
      </HeaderCell>
      <HeaderCell>
        Diamantes
      </HeaderCell>
      <HeaderCell>
        Bonus
      </HeaderCell>
      <HeaderCell v-for="field in fields" :key="field">
        {{ field }}
      </HeaderCell>
      <HeaderCell v-role:any="'super|admin'">
        actions
      </HeaderCell>
    </template>
    <template v-slot:tbody>
      <tr v-for="item in recargas" :key="item.id">
        <DataCell>
          <Link class="underline mr-2" :href="route('recargas.show', item.id)">
            {{ item.price }}
          </Link>
        </DataCell>
        <DataCell>
          <Link class="underline mr-2" :href="route('recargas.show', item.id)">
            {{ item.diamantes }}
          </Link>
        </DataCell>
        <DataCell>
          <Link class="underline mr-2" :href="route('recargas.show', item.id)">
            {{ item.bonus }}
          </Link>
        </DataCell>
        <DataCell v-for="key in fields" :key="key">
          {{ item[key] }}
        </DataCell>
        <DataCell v-role:any="'super|admin'">
          <span class="font-extrabold cursor-pointer underline" @click="removeAction(item.id)">
            Recargar
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
    recargas: Array,
    removeAction: Function
  },
  data() {
    return {
      excludeFields: [
        'id',
        'name'
      ]
    }
  },
  computed: {
    fields() {
      if (this.recargas.length <= 0) {
        return [];
      }

      const row = this.recargas[0];

      return Object.keys(row).filter((key) => !this.excludeFields.includes(key));
    },
  }
};
</script>
