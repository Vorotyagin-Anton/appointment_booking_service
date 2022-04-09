
const routes = [
  {
    path: '/authorize',
    component: () => import('layouts/AuthLayout.vue'),
    children: [
      // {
      //   name: 'signin',
      //   path: '',
      //   component: () => import('pages/SignInPage.vue'),
      // },
      {
        name: 'signup',
        path: '/signup',
        component: () => import('pages/SignUpPage.vue'),
      }
    ],
  },

  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      {
        name: 'main',
        path: '',
        component: () => import('pages/MainPage.vue'),
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

export default routes
