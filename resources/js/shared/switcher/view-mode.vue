<template>
  <ul role="list" :class="`flex w-full justify-${alignment}`">
    <li
      v-for="viewMode in viewModes"
      :class="{ 'font-bold': isActive(viewMode) }"
      class="cursor-pointer first:mr-2"
      :key="viewMode.key"
      @click="setViewMode(viewMode.key)"
    >
      <Button :active="isActive(viewMode)">
        <span className="h-5 w-5">
          <component :is="viewMode.icon" />
        </span>
      </Button>
    </li>
  </ul>
</template>

<script>
import { useCookies } from 'vue3-cookies';
import { Inertia } from '@inertiajs/inertia';
import { ViewListIcon, ViewGridIcon } from '@heroicons/vue/solid';

import Button from '@/shared/base/button';

const defaultViewMode = 'list';
const rememberKey = 'view_mode';

export default {
  setup() {
    const { cookies } = useCookies();
    return { cookies };
  },
  components: {
    Button,
    ViewListIcon,
    ViewGridIcon,
  },
  props: {
    alignment: {
      type: String,
      required: false,
      default: 'end',
    },
  },
  data() {
    return {
      viewModes: [
        {
          key: 'list',
          label: 'List',
          icon: ViewListIcon,
        },
        {
          key: 'grid',
          label: 'Grid',
          icon: ViewGridIcon,
        }
      ],
      // Intertia will return the value more fast than read the cookies
      currentViewMode: Inertia.restore(rememberKey) || this.cookies.get(rememberKey) || defaultViewMode,
    };
  },
  mounted() {
    this.disptachEvent();
  },
  methods: {
    setViewMode(viewMode) {
      this.currentViewMode = viewMode;
      this.disptachEvent();
    },
    disptachEvent() {
      this.saveSelection();
      this.$emit('onChange', this.currentViewMode);
    },
    isActive(viewMode) {
      return viewMode.key === this.currentViewMode;
    },
    saveSelection() {
      this.cookies.set(rememberKey, this.currentViewMode);
      Inertia.remember(this.currentViewMode, rememberKey);
    }
  }
};
</script>
