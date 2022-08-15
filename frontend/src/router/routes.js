import authGuard from "src/router/guards/authGuard";
import guestGuard from "src/router/guards/guestGuard";
import profileCreatedGuard from "src/router/guards/profileCreatedGuard";
import profileNotCreatedGuard from "src/router/guards/profileNotCreatedGuard";

export default [
  {
    name: 'auth',
    path: '/auth',

    children: [
      {
        name: 'auth.signin',
        path: 'signin',
        beforeEnter: [guestGuard],
        meta: {
          guards: ['guest'],
        },
        component: () => import('pages/Auth/LoginPage.vue'),
      },
      {
        name: 'auth.signup',
        path: 'signup',
        beforeEnter: [guestGuard],
        meta: {
          guards: ['guest'],
        },
        component: () => import('pages/Auth/RegisterPage.vue'),
      },
      {
        name: 'auth.profile',
        path: 'profile',
        beforeEnter: [authGuard, profileCreatedGuard],
        component: () => import('pages/Auth/ProfilePage.vue'),
      },
    ],
    component: () => import('layouts/AuthLayout.vue'),
  },

  // CABINET
  {
    path: '/cabinet',
    component: () => import('layouts/CabinetLayout.vue'),
    children: [
      {
        name: 'cabinet',
        path: '',
        component: () => import('pages/Cabinet/DashboardPage.vue'),
      },
      {
        name: 'cabinet.profile',
        path: 'profile',
        component: () => import('pages/Cabinet/ProfilePage.vue'),
      },
      {
        name: 'cabinet.services',
        path: 'services',
        component: () => import('pages/Cabinet/ServicesPage.vue'),
      },
      {
        name: 'cabinet.schedule',
        path: 'schedule',
        component: () => import('pages/Cabinet/SchedulePage.vue'),
      },
    ],
    beforeEnter: [authGuard, profileNotCreatedGuard],
    meta: {
      guards: ['auth'],
    },
  },

  // MAIN
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      {
        name: 'main',
        path: '/',
        component: () => import('pages/MainPage.vue'),
      },

      {
        name: 'masters',
        path: '/masters',
        component: () => import('pages/Catalog/MastersPage.vue'),
      },

      {
        name: 'services',
        path: '/services',
        component: () => import('pages/Catalog/ServicesPage.vue'),
      }
    ],
  },

  // NOT FOUND
  {
    name: '404',
    path: '/:catchAll(.*)*',
    component: () => import('pages/NotFoundPage.vue')
  }
]
