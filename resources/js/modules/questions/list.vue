<template>
  <Table v-if="questions.length > 0">
    <template v-slot:thead>
      <HeaderCell v-for="field in fields" :key="field">
        {{ field }}
      </HeaderCell>
      <HeaderCell>
        user
      </HeaderCell>
      <HeaderCell>
        actions
      </HeaderCell>
    </template>
    <template v-slot:tbody>
      <tr v-for="item in questions" :key="item.id">
        <DataCell v-for="key in fields" :key="key">
          {{ item[key] }}
        </DataCell>
        <DataCell>
          {{ item?.user?.name }}
        </DataCell>
        <DataCell>
          <span v-if="!item.readed" class="cursor-pointer underline" @click="markAsRead(item.id)">
            Mark as read
          </span>
        </DataCell>
      </tr>
    </template>
  </Table>
  <div v-else>
    No questions
  </div>
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
    questions: Array,
  },
  data() {
    return {
      excludeFields: [
        'readed',
        'user',
        'user_id',
        'topic',
        'topic_id'
      ]
    }
  },
  computed: {
    fields() {
      if (this.questions.length <= 0) {
        return [];
      }

      const row = this.questions[0];

      return Object.keys(row).filter((key) => !this.excludeFields.includes(key));
    },
  },
  methods: {
    markAsRead (id) {
      this.$inertia.delete(this.route('questions.destroy', id));
    }
  }
};
</script>
