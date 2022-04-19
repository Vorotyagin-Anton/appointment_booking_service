const state = {
  items: [
    {
      group: 'Menu',
      links: [
        {
          title: 'overview',
          route: 'main',
        },
        {
          title: 'catalog',
          select: [
            {
              title: 'categories',
              route: 'main',
            },
            {
              title: 'services',
              route: 'main',
            },
            {
              title: 'masters',
              route: 'masters',
            },
          ],
        },
        {
          title: 'features',
          route: 'main',
          groups: [
            'Catalog',
            'Payments',
            'Hardware',
            'Developers',
            'Resources',
            'Business Types',
            'Points of Sale',
            'Tools',
          ],
        },
        {
          title: 'pricing',
          route: 'main',
        },
        {
          title: 'faq',
          label: 'FAQ',
          route: {path: '/', hash: '#faq'},
        },
      ],
    },
    {
      group: 'Payments',
      links: [
        {
          title: 'Square Payments',
          route: 'main',
        },
        {
          title: 'In Person',
          route: 'main',
        },
        {
          title: 'On Your Computer',
          route: 'main',
        },
        {
          title: 'On Your Website',
          route: 'main',
        },
        {
          title: 'Risk Manager',
          route: 'main',
        },
        {
          title: 'Payment Platform',
          route: 'main',
        },
        {
          title: 'Payment Secure',
          route: 'main',
        },
        {
          title: 'Transfers',
          route: 'main',
        },
        {
          title: 'Merchant Services',
          route: 'main',
        },
      ],
    },
    {
      group: 'Point of Sale',
      links: [
        {
          title: 'Point of Sale Overview',
          route: 'main',
        },
        {
          title: 'Square Point of Sale',
          route: 'main',
        },
        {
          title: 'Square for Restaurants',
          route: 'main',
        },
        {
          title: 'Square for Retail',
          route: 'main',
        },
        {
          title: 'Square Appointments',
          route: 'main',
        },
      ],
    },
    {
      group: 'Hardware',
      links: [
        {
          title: 'Reader for Magstripe',
          route: 'main',
        },
        {
          title: 'Contactless (NFC) & Chip Reader',
          route: 'main',
        },
        {
          title: 'Terminal',
          route: 'main',
        },
        {
          title: 'Stand',
          route: 'main',
        },
        {
          title: 'Register',
          route: 'main',
        },
        {
          title: 'By in Store',
          route: 'main',
        },
        {
          title: 'Compare Hardware',
          route: 'main',
        },
      ],
    },
    {
      group: 'Tools',
      links: [
        {
          title: 'Online Store',
          route: 'main',
        },
        {
          title: 'Online Checkout',
          route: 'main',
        },
        {
          title: 'Team Management',
          route: 'main',
        },
        {
          title: 'Marketing',
          route: 'main',
        },
        {
          title: 'SMS Marketing',
          route: 'main',
        },
        {
          title: 'Messages',
          route: 'main',
        },
        {
          title: 'Loyalty',
          route: 'main',
        },
        {
          title: 'Dashboard',
          route: 'main',
        },
        {
          title: 'Gift Cards',
          route: 'main',
        },
        {
          title: 'Customer Directory',
          route: 'main',
        },
        {
          title: 'Inventory Management',
          route: 'main',
        },
        {
          title: 'Photo Studio',
          route: 'main',
        },
      ],
    },
    {
      group: 'Developers',
      links: [
        {
          title: 'Developer Platform',
          route: 'main',
        },
        {
          title: 'Reader SDK',
          route: 'main',
        },
        {
          title: 'In-App Payments SDK',
          route: 'main',
        },
        {
          title: 'Online Payments APIs',
          route: 'main',
        },
        {
          title: 'Documentation',
          route: 'main',
        },
        {
          title: 'Developer Dashboard',
          route: 'main',
        },
      ],
    },
    {
      group: 'Resources',
      links: [
        {
          title: 'Pricing',
          route: 'main',
        },
        {
          title: 'Contact Sales',
          route: 'main',
        },
        {
          title: 'Support Center',
          route: 'main',
        },
        {
          title: 'App Marketplace',
          route: 'main',
        },
        {
          title: 'Small Business Development',
          route: 'main',
        },
        {
          title: 'Blog',
          route: 'main',
        },
        {
          title: 'Guides',
          route: 'main',
        },
        {
          title: 'Seller Community',
          route: 'main',
        },
        {
          title: 'Event',
          route: 'main',
        },
        {
          title: 'Service Status',
          route: 'main',
        },
      ],
    },
    {
      group: 'Business Types',
      links: [
        {
          title: 'Large businesses',
          route: 'main',
        },
        {
          title: 'Retail',
          route: 'main',
        },
        {
          title: 'CBD Retail',
          route: 'main',
        },
        {
          title: 'Coffee Shops',
          route: 'main',
        },
        {
          title: 'Quick Service',
          route: 'main',
        },
        {
          title: 'Full Service',
          route: 'main',
        },
        {
          title: 'Bars & Breweries',
          route: 'main',
        },
        {
          title: 'Beauty Professionals',
          route: 'main',
        },
        {
          title: 'Health & Fitness',
          route: 'main',
        },
        {
          title: 'Home & Repair Services',
          route: 'main',
        },
        {
          title: 'Professional Services',
          route: 'main',
        },
      ],
    },
    {
      group: 'Square',
      links: [
        {
          title: 'Home',
          route: 'main',
        },
        {
          title: 'About',
          route: 'main',
        },
        {
          title: 'Press and Media',
          route: 'main',
        },
        {
          title: 'Investor Relations',
          route: 'main',
        },
        {
          title: 'Affiliate Program',
          route: 'main',
        },
        {
          title: 'Partner with Square',
          route: 'main',
        },
        {
          title: 'Careers',
          route: 'main',
        },
        {
          title: 'Developers',
          route: 'main',
        },
        {
          title: 'Employment Verification',
          route: 'main',
        },
      ],
    },
    {
      group: 'About Us',
      links: [
        {
          title: 'Licenses',
          route: 'main',
        },
        {
          title: 'Privacy Notice',
          route: 'main',
        },
        {
          title: 'Terms of Service',
          route: 'main',
        },
        {
          title: 'Block, Inc.',
          route: 'main',
        },
      ],
    },
  ],
};

const getters = {
  all(state) {
    return state.items;
  },
};

export default {
  namespaced: true,
  state,
  getters,
}
