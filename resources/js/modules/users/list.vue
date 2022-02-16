<template>
  <Table>
    <template v-slot:thead>
      <HeaderCell>

      </HeaderCell>
      <HeaderCell v-for="field in fields" :key="field">
        {{ field }}
      </HeaderCell>
      <HeaderCell>
        actions
      </HeaderCell>
    </template>
    <template v-slot:tbody>
      <tr v-for="item in users" :key="item.id">
        <DataCell>
          <img class="rounded-full" :src="item.avatar" />
        </DataCell>
        <DataCell v-for="key in fields" :key="key">
          {{ item[key] }}
        </DataCell>
        <DataCell>
          <Link class="underline mr-2" :href="route('users.show', item.id)">
            Show
          </Link>
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
    users: Array,
    removeAction: Function
  },
  data() {
    return {
      excludeFields: [
        'id',
        'avatar',
        'google_token',
        'google_refresh_token',
        'google_id',
        'email_verified_at'
      ]
    }
  },
  computed: {
    fields() {
      if (this.users.length <= 0) {
        return [];
      }

      const row = this.users[0];

      return Object.keys(row).filter((key) => !this.excludeFields.includes(key));
    },
  }
};
</script>
