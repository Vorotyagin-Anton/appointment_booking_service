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
          label: 'Catalog',
          children: [
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
              route: 'main',
            },
          ],
          groups: [
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
          title: 'features',
          route: 'main',
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
          name: 'main',
        },
        {
          title: 'Square Point of Sale',
          name: 'main',
        },
        {
          title: 'Square for Restaurants',
          name: 'main',
        },
        {
          title: 'Square for Retail',
          name: 'main',
        },
        {
          title: 'Square Appointments',
          name: 'main',
        },
      ],
    },
    {
      group: 'Hardware',
      links: [
        {
          title: 'Reader for Magstripe',
          name: 'main',
        },
        {
          title: 'Contactless (NFC) & Chip Reader',
          name: 'main',
        },
        {
          title: 'Terminal',
          name: 'main',
        },
        {
          title: 'Stand',
          name: 'main',
        },
        {
          title: 'Register',
          name: 'main',
        },
        {
          title: 'By in Store',
          name: 'main',
        },
        {
          title: 'Compare Hardware',
          name: 'main',
        },
      ],
    },
    {
      group: 'Tools',
      links: [
        {
          title: 'Online Store',
          name: 'main',
        },
        {
          title: 'Online Checkout',
          name: 'main',
        },
        {
          title: 'Checking',
          name: 'main',
        },
        {
          title: 'Loans',
          name: 'main',
        },
        {
          title: 'Savings',
          name: 'main',
        },
        {
          title: 'Payroll',
          name: 'main',
        },
        {
          title: 'Team Management',
          name: 'main',
        },
        {
          title: 'Marketing',
          name: 'main',
        },
        {
          title: 'SMS Marketing',
          name: 'main',
        },
        {
          title: 'Messages',
          name: 'main',
        },
        {
          title: 'Loyalty',
          name: 'main',
        },
        {
          title: 'Dashboard',
          name: 'main',
        },
        {
          title: 'Gift Cards',
          name: 'main',
        },
        {
          title: 'Customer Directory',
          name: 'main',
        },
        {
          title: 'Inventory Management',
          name: 'main',
        },
        {
          title: 'Photo Studio',
          name: 'main',
        },
      ],
    },
    {
      group: 'Developers',
      links: [
        {
          title: 'Developer Platform',
          name: 'main',
        },
        {
          title: 'Reader SDK',
          name: 'main',
        },
        {
          title: 'In-App Payments SDK',
          name: 'main',
        },
        {
          title: 'Online Payments APIs',
          name: 'main',
        },
        {
          title: 'Documentation',
          name: 'main',
        },
        {
          title: 'Developer Dashboard',
          name: 'main',
        },
      ],
    },
    {
      group: 'Resources',
      links: [
        {
          title: 'Pricing',
          name: 'main',
        },
        {
          title: 'Contact Sales',
          name: 'main',
        },
        {
          title: 'Support Center',
          name: 'main',
        },
        {
          title: 'App Marketplace',
          name: 'main',
        },
        {
          title: 'Small Business Development',
          name: 'main',
        },
        {
          title: 'Blog',
          name: 'main',
        },
        {
          title: 'Guides',
          name: 'main',
        },
        {
          title: 'Seller Community',
          name: 'main',
        },
        {
          title: 'Event',
          name: 'main',
        },
        {
          title: 'Service Status',
          name: 'main',
        },
      ],
    },
    {
      group: 'Business Types',
      links: [
        {
          title: 'Large businesses',
          name: 'main',
        },
        {
          title: 'Retail',
          name: 'main',
        },
        {
          title: 'CBD Retail',
          name: 'main',
        },
        {
          title: 'Coffee Shops',
          name: 'main',
        },
        {
          title: 'Quick Service',
          name: 'main',
        },
        {
          title: 'Full Service',
          name: 'main',
        },
        {
          title: 'Bars & Breweries',
          name: 'main',
        },
        {
          title: 'Beauty Professionals',
          name: 'main',
        },
        {
          title: 'Health & Fitness',
          name: 'main',
        },
        {
          title: 'Home & Repair Services',
          name: 'main',
        },
        {
          title: 'Professional Services',
          name: 'main',
        },
      ],
    },
    {
      group: 'Square',
      links: [
        {
          title: 'Home',
          name: 'main',
        },
        {
          title: 'About',
          name: 'main',
        },
        {
          title: 'Press and Media',
          name: 'main',
        },
        {
          title: 'Investor Relations',
          name: 'main',
        },
        {
          title: 'Affiliate Program',
          name: 'main',
        },
        {
          title: 'Partner with Square',
          name: 'main',
        },
        {
          title: 'Careers',
          name: 'main',
        },
        {
          title: 'Developers',
          name: 'main',
        },
        {
          title: 'Employment Verification',
          name: 'main',
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
