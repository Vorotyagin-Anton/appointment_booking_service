const state = {
  groups: [
    {
      name: 'Payments',
      links: [
        {title: 'Square Payments', to: {name: 'main'}},
        {title: 'In Person', to: {name: 'main'}},
        {title: 'On Your Computer', to: {name: 'main'}},
        {title: 'On Your Website', to: {name: 'main'}},
        {title: 'Risk Manager', to: {name: 'main'}},
        {title: 'Payment Platform', to: {name: 'main'}},
        {title: 'Payment Secure', to: {name: 'main'}},
        {title: 'Transfers', to: {name: 'main'}},
        {title: 'Merchant Services', to: {name: 'main'}},
      ],
    },
    {
      name: 'Point of Sale',
      links: [
        {title: 'Point of Sale Overview', to: {name: 'main'}},
        {title: 'Square Point of Sale', to: {name: 'main'}},
        {title: 'Square for Restaurants', to: {name: 'main'}},
        {title: 'Square for Retail', to: {name: 'main'}},
        {title: 'Square Appointments', to: {name: 'main'}},
      ],
    },
    {
      name: 'Hardware',
      links: [
        {title: 'Reader for Magstripe', to: {name: 'main'}},
        {title: 'Contactless (NFC) & Chip Reader', to: {name: 'main'}},
        {title: 'Terminal', to: {name: 'main'}},
        {title: 'Stand', to: {name: 'main'}},
        {title: 'Register', to: {name: 'main'}},
        {title: 'By in Store', to: {name: 'main'}},
        {title: 'Compare Hardware', to: {name: 'main'}},
      ],
    },
    {
      name: 'Tools',
      links: [
        {title: 'Online Store', to: {name: 'main'}},
        {title: 'Online Checkout', to: {name: 'main'}},
        {title: 'Team Management', to: {name: 'main'}},
        {title: 'Marketing', to: {name: 'main'}},
        {title: 'SMS Marketing', to: {name: 'main'}},
        {title: 'Messages', to: {name: 'main'}},
        {title: 'Loyalty', to: {name: 'main'}},
        {title: 'Dashboard', to: {name: 'main'}},
        {title: 'Gift Cards', to: {name: 'main'}},
        {title: 'Customer Directory', to: {name: 'main'}},
        {title: 'Inventory Management', to: {name: 'main'}},
        {title: 'Photo Studio', to: {name: 'main'}},
      ],
    },
    {
      name: 'Developers',
      links: [
        {title: 'Developer Platform', to: {name: 'main'}},
        {title: 'Reader SDK', to: {name: 'main'}},
        {title: 'In-App Payments SDK', to: {name: 'main'}},
        {title: 'Online Payments APIs', to: {name: 'main'}},
        {title: 'Documentation', to: {name: 'main'}},
        {title: 'Developer Dashboard', to: {name: 'main'}},
      ],
    },
    {
      name: 'Resources',
      links: [
        {title: 'Pricing', to: {name: 'main'}},
        {title: 'Contact Sales', to: {name: 'main'}},
        {title: 'Support Center', to: {name: 'main'}},
        {title: 'App Marketplace', to: {name: 'main'}},
        {title: 'Small Business Development', to: {name: 'main'}},
        {title: 'Blog', to: {name: 'main'}},
        {title: 'Guides', to: {name: 'main'}},
        {title: 'Seller Community', to: {name: 'main'}},
        {title: 'Event', to: {name: 'main'}},
        {title: 'Service Status', to: {name: 'main'}},
      ],
    },
    {
      name: 'Business Types',
      links: [
        {title: 'Large businesses', to: {name: 'main'}},
        {title: 'Retail', to: {name: 'main'}},
        {title: 'CBD Retail', to: {name: 'main'}},
        {title: 'Coffee Shops', to: {name: 'main'}},
        {title: 'Quick Service', to: {name: 'main'}},
        {title: 'Full Service', to: {name: 'main'}},
        {title: 'Bars & Breweries', to: {name: 'main'}},
        {title: 'Beauty Professionals', to: {name: 'main'}},
        {title: 'Health & Fitness', to: {name: 'main'}},
        {title: 'Home & Repair Services', to: {name: 'main'}},
        {title: 'Professional Services', to: {name: 'main'}},
      ],
    },
    {
      name: 'Square',
      links: [
        {title: 'Home', to: {name: 'main'}},
        {title: 'About', to: {name: 'main'}},
        {title: 'Press and Media', to: {name: 'main'}},
        {title: 'Investor Relations', to: {name: 'main'}},
        {title: 'Affiliate Program', to: {name: 'main'}},
        {title: 'Partner with Square', to: {name: 'main'}},
        {title: 'Careers', to: {name: 'main'}},
        {title: 'Developers', to: {name: 'main'}},
        {title: 'Employment Verification', to: {name: 'main'}},
      ],
    },
    {
      name: 'About Us',
      links: [
        {title: 'Licenses', to: {name: 'main'}},
        {title: 'Privacy Notice', to: {name: 'main'}},
        {title: 'Terms of Service', to: {name: 'main'}},
        {title: 'Block, Inc.', to: {name: 'main'}},
      ],
    },
  ],
};

const getters = {
  groups: (state) => state.groups,

  getGroup: (state) => (name) => {
    for (let group of state.groups) {
      if (group.name === name) {
        return group;
      }
    }
  },
};

export default {
  namespaced: true,
  state,
  getters,
}
