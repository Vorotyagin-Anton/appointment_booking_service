import authGuard from "src/router/guards/authGuard";
import guestGuard from "src/router/guards/guestGuard";

export default [
  // AUTH
  {
    name: 'auth',
    path: '/auth',

    children: [
      // SIGNIN
      {
        name: 'auth.signin',
        path: '/signin',

        beforeEnter: [guestGuard],

        meta: {
          guards: ['guest'],
        },

        component: () => import('pages/SignInPage.vue'),
      },

      // SIGNUP
      {
        name: 'auth.signup',
        path: '/signup',

        beforeEnter: [guestGuard],

        meta: {
          guards: ['guest'],
        },

        component: () => import('pages/SignUpPage.vue'),
      },

      // PROFILE
      {
        name: 'auth.profile',
        path: 'profile',

        beforeEnter: [authGuard],

        meta: {
          guards: ['auth'],
        },

        component: () => import('pages/Cabinet/ProfileCreationPage.vue'),
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
        name: 'cabinet.schedule',
        path: 'schedule',
        component: () => import('pages/Cabinet/SchedulePage.vue'),
      }
    ],
    beforeEnter: [authGuard],
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
        component: () => import('pages/MastersPage.vue'),
      },
    ],
  },

  // NOT FOUND
  {
    name: '404',
    path: '/:catchAll(.*)*',
    component: () => import('pages/NotFoundPage.vue')
  }
]
