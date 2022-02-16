<template>
  <Table>
    <template v-slot:thead>
      <HeaderCell v-for="field in fields" :key="field">
        {{ field }}
      </HeaderCell>
      <HeaderCell>
        actions
      </HeaderCell>
    </template>
    <template v-slot:tbody>
      <tr v-for="item in topics" :key="item.id">
        <DataCell v-for="key in fields" :key="key">
          {{ item[key] }}
        </DataCell>
        <DataCell>
          <Link class="underline mr-2" :href="route('topics.show', item.id)">
            Show
          </Link>
          <Link class="underline mr-2" :href="route('topics.edit', item.id)">
            Edit
          </Link>
          <span class="cursor-pointer underline" @click="removeAction(item.id)">
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
    topics: Array,
    removeAction: Function
  },
  computed: {
    fields() {
      if (this.topics.length <= 0) {
        return [];
      }

      const row = this.topics[0];

      return Object.keys(row);
    },
  }
};
</script>
