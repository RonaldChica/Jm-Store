<template>
  <Head title="Users" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
    </template>
    <Users :data="data" :errors="errors" :users="users" />
  </AuthenticatedLayout>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';

import AuthenticatedLayout from '@core/layout/authenticated';

import Users from '@modules/users';

const channel = 'users';
const events = [
  {
    name: 'User\\UserUpdatedEvent',
    callback: (scope, user) => {
      scope.users = scope.users.map((_user) => {
        if (user.id === _user.id) {
          return user;
        }

        return _user;
      });
    },
  }
];

export default {
  components: {
    AuthenticatedLayout,
    Head,
    Users
  },
  props: {
    data: Object,
    errors: {
      type: Object,
      required: false
    },
  },
  data(props) {
    const { data } = props.data;

    return {
      users: data
    };
  },
  mounted() {
    events.forEach((event) => {
      window.Echo.private(channel).listen(event.name, ({ user }) =>
        event.callback(this, user)
      );
    });
  },
  unmounted() {
    events.forEach((event) => {
      window.Echo.private(channel).stopListening(event.name);
    });
  }
};
</script>
