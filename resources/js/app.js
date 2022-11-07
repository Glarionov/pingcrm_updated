import { createApp, h } from 'vue'
import { InertiaProgress } from '@inertiajs/progress'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import DefaultLayout from '@/Shared/DefaultLayout';
InertiaProgress.init()

createInertiaApp({
  resolve: name => {
      const page = require(`./Pages/${name}`);
      page.layout = page.layout || DefaultLayout;
      /*s*/console.log('page.layout=', page.layout); //todo r
      return page
  },
  title: title => title ? `${title} - Ping CRM` : 'Ping CRM',
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
})
