<template>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="sm:rounded-lg">
        <div class="mt-6 p-6 shadow-sm bg-white border-b border-gray-200">
          <Form :errors="errors" />
        </div>
        <div class="mt-6 p-6 shadow-sm bg-white border-b border-gray-200">
          <SwitcherViewMode class="mb-4" @on-change="onChangeViewMode" />
          <List v-if="viewMode === 'list'" :deposits="deposits" :removeAction="remove" />
          <Grid v-if="viewMode === 'grid'" :deposits="deposits" :removeAction="remove" />

          <div v-if="noDeposits" class="text-lg">
            <h2 class="text-2xl mb-2">
              There is no topic registered yet!
            </h2>
            Create a new topic to start with the program "Ask Away"
          </div>
        </div>
        <div
          v-if="showPagination"
          class="
            mt-6
            p-6
            shadow-sm
            bg-white
            border-b border-gray-200
            flex
            justify-center
          "
        >
          <Pagination :links="data.links" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SwitcherViewMode from '@/shared/switcher/view-mode';
import Pagination from '@/shared/pagination';

import List from './list';
import Grid from './grid';
import Form from './form';

export default {
  components: {
    SwitcherViewMode,
    Pagination,
    List,
    Grid,
    Form
  },
  props: {
    data: Object,
    deposits: Array,
    errors: {
      type: Object,
      required: false
    }
  },
  data() {
    return {
      viewMode: ''
    };
  },
  computed: {
    showPagination() {
      return this.data.total > this.data.per_page
    },
    noDeposits() {
      return this.deposits.length === 0
    }
  },
  methods: {
    onChangeViewMode(viewMode) {
      this.viewMode = viewMode;
    },
    remove (id) {
      this.$inertia.delete(this.route('deposits.destroy', id))
    }
  }
};
</script>
