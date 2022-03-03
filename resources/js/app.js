require('./bootstrap');
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { VueReCaptcha, useReCaptcha } from 'vue-recaptcha-v3'
import VueGates from 'vue-gates'

import Permissions from './core/plugins/permissions.ts';

const appName =
  window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) => require(`./pages/${name}.vue`),
  setup({ el, app, props, plugin }) {
    const captcheKey = props.initialPage.props.recaptcha_site_key;
    return createApp({ render: () => h(app, props) })
      .use(plugin)
      .use(VueReCaptcha, { siteKey: captcheKey } )
      .use(VueGates)
      .use(Permissions)
      .mixin({ methods: { route } })
      .mount(el);
  },
});

InertiaProgress.init({ color: '#4B5563' });
