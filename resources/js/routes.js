import Login from './components/admin/LoginComponent.vue'
import Dashboard from './components/admin/DashboardComponent.vue'
import User from './components/admin/UserComponent.vue'
import Shops from './components/admin/ShopsComponent.vue'
import Requests from './components/admin/RequestsComponent.vue'
import ShopMemberships from './components/admin/ShopMembershipsComponent.vue'
import ShopUsers from './components/admin/ShopUsersComponent.vue'
import Subsidiaries from './components/admin/SubsidiariesComponent.vue'
import SubsidiaryMenu from './components/admin/SubsidiaryMenuComponent.vue'
import SubsidiaryPromos from './components/admin/SubsidiaryPromosComponent.vue'
import SubsidiaryOrders from './components/admin/SubsidiaryOrdersComponent.vue'
import Product from './components/admin/ProductComponent.vue'
import Order from './components/admin/OrderComponent.vue'
import Rastreo from './components/Rastreo.vue'
import TerminosCondiciones from './components/TerminosCondiciones.vue'
import PoliticaPrivacidad from './components/PoliticaPrivacidad.vue'
import Directory from './components/Directorio.vue'
import Negocio from './components/Negocio.vue'
import Suscripcion from './components/Suscripcion.vue'
import Shop from './components/comenzar.vue'
import ShopDetail from './components/ShopDetailComponent.vue'
import CarritoCompras from './components/CarritoCompras.vue'
import Checkout from './components/CheckoutComponent.vue'

export const routes = [
    {
        path:'/administrar',
        component:Login,
        meta: {
          public: true,
          onlyLoggedOut: true,
          requiredCart: false
        }
    },
    { 
      path:'/panel/shops',
      component:Shops,
      meta: {
        public: false
      }
    },
    { 
      path:'/panel/requests',
      component:Requests,
      meta: {
        public: false
      }
    },
    { 
      path:'/panel/subsidiaries/:subsidiaryId/dashboard',
      component:Dashboard,
      meta: {
        public: false
      }
    },
    { 
      path:'/panel/shops/:slug/subsidiaries',
      component:Subsidiaries,
      meta: {
        public: false
      }
    },
    { 
      path:'/panel/shops/:slug/memberships',
      component: ShopMemberships,
      meta: {
        public: false
      }
    },
    { 
      path:'/panel/shops/:slug/users',
      component: ShopUsers,
      meta: {
        public: false
      }
    },
    { 
      path:'/panel/subsidiaries/:subsidiaryId/menu',
      component:SubsidiaryMenu,
      meta: {
        public: false
      }
    },
    { 
      path:'/panel/subsidiaries/:subsidiaryId/promos',
      component:SubsidiaryPromos,
      meta: {
        public: false
      }
    },
    { 
      path:'/panel/subsidiaries/:subsidiaryId/orders',
      component:SubsidiaryOrders,
      meta: {
        public: false
      }
    },
    { 
        path:'/panel/users',
        component:User,
        meta: {
          public: false
        }
    },
    { 
        path:'/panel/products',
        component:Product,
        meta: {
          public: false
        }
    },
    { 
        path:'/panel/orders',
        component:Order,
        meta: {
          public: false
        }
    },
    { 
      path:'/',
      component:Shop,
      meta: {
        public: true,
        requiredCart: false
      }
    },
    { 
      path:'/directorio',
      component: Directory,
      meta: {
        public: true,
        requiredCart: false
      }
    },
    { 
      path:'/rastreo',
      component: Rastreo,
      meta: {
        public: true,
        requiredCart: false
      }
    },
    { 
      path:'/terminos',
      component: TerminosCondiciones,
      meta: {
        public: true,
        requiredCart: false
      }
    },
    { 
      path:'/privacidad',
      component: PoliticaPrivacidad,
      meta: {
        public: true,
        requiredCart: false
      }
    },
    { 
      path:'/quiero-vender',
      component: Suscripcion,
      meta: {
        public: true,
        requiredCart: false
      }
    },
    { 
      path:'/establecimiento/:slug',
      component:Negocio,
      meta: {
        public: true,
        requiredCart: false
      }
    },
    { 
      path:'/:slug/detalle',
      component:ShopDetail,
      meta: {
        public: true,
        requiredCart: false
      }
    },
    { 
      path:'/carrito',
      component:CarritoCompras,
      meta: {
        public: true,
        requiredCart: false
      }
    },
    { 
      path:'/pago',
      component:Checkout,
      meta: {
        public: true,
        requiredCart: true
      }
    }
 
];