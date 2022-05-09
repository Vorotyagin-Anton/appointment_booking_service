import authGuard from "src/router/guards/authGuard";
import guestGuard from "src/router/guards/guestGuard";

export default [
  {
    path: '/authorize',
    component: () => import('layouts/AuthLayout.vue'),
    children: [
      {
        name: 'signin',
        path: '',
        component: () => import('pages/SignInPage.vue'),
      },
      
      {
        name: 'signup',
        path: '/signup',
        component: () => import('pages/SignUpPage.vue'),
      },
    ],
    beforeEnter: [guestGuard],
  },

  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      {
        name: 'main',
        path: '',
        component: () => import('pages/MainPage.vue'),
      },
      
      {
        name: 'masters',
        path: 'masters',
        component: () => import('pages/MastersPage.vue'),
      },
      
      {
        name: 'profile',
        path: 'profile',
        component: () => import('pages/ProfilePage.vue'),
        beforeEnter: [authGuard],
      }
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]
