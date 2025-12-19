import './bootstrap';
import '../css/app.css';
import '@tailwindplus/elements'

import { createApp, h } from 'vue';
import { createInertiaApp, Link } from '@inertiajs/vue3';
import { createPinia } from 'pinia';
import { resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

//import Header from '@/components/layout/Header.vue';
//import Footer from '@/components/layout/Footer.vue';
//import AddToCartButton from "@/components/products/AddToCartButton.vue";
//import CartItems from "@/components/products/CartItems.vue";

const pinia = createPinia();

createInertiaApp({
  resolve: (name) => 
    resolvePageComponent(
      `./Pages/${name}.vue`,
      import.meta.glob("./Pages/**/*.vue")
    ),
  setup({ el, App, props, plugin}) {
    const app = createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .use(pinia)

    //app.component('Header', Header)
    //app.component('Footer', Footer)
    //app.component('add-to-cart', AddToCartButton)
    //app.component('cart-items', CartItems)
    //app.component('Link', Link)

    app.mount(el)
  },
});