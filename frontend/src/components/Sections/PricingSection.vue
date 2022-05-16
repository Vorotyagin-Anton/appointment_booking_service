<template>
  <app-section class="pricing-section">
    <app-section-header
      class="pricing-section__header"
      heading="Pick the plan for you"
      description="No hidden fees. Change or cancel any time. Custom pricing and discounts are available for qualifying businesses."
    />

    <div class="pricing-section__content">
      <div class="pricing-section__plans">
        <pricing-section-plan
          class="pricing-section__plan"
          v-for="plan in plans"
          :key="plan.id"
          :plan="plan"
        />
      </div>
    </div>

    <app-section-link
      class="pricing-section__link"
      label="Compare plan"
      :to="{name: 'main'}"
    />
  </app-section>
</template>

<script>
import AppSection from "components/Common/AppSection";
import AppSectionHeader from "components/Common/AppSectionHeader";
import AppSectionLink from "components/Common/AppSectionLink";
import PricingSectionPlan from "components/Sections/PricingSectionPlan";

const plans = [
  {
    name: 'Free',
    promo: 'The basics to run your own business while staying ahead of schedule.',
    price: 0,
    location: 'for a single location',
    transaction: '2.6% + 5¢',
    link: {name: 'main'},
    features: [
      'Unlimited staff accounts',
      'Custom booking website and social media integrations',
      'Integrated payments',
      'Automatic text and email reminders',
    ],
  },
  {
    name: 'Plus',
    promo: 'More advanced features for growing teams that offer top-notch service.',
    price: 20,
    location: 'per location',
    transaction: '2% + 5¢',
    link: {name: 'main'},
    features: [
      'Everything in Free',
      'Customer confirmation texts and emails',
      'Book with multiple staff',
      'No-show protection',
      'Processing time',
    ],
  },
  {
    name: 'Premium',
    promo: 'A complete plan that meets complex booking and staff management needs.',
    price: 50,
    location: 'per location',
    transaction: '2% + 5¢',
    link: {name: 'main'},
    features: [
      'Everything in Plus',
      'Team Plus',
      'Resource management',
      'Custom staff commissions',
      'Automated contracts',
    ],
  },
];

export default {
  name: "PricingSection",

  components: {
    PricingSectionPlan,
    AppSectionLink,
    AppSectionHeader,
    AppSection,
  },

  setup() {

    return {
      plans,
    }
  },
}
</script>

<style lang="scss">
.pricing-section {
  background-color: $grey-2;

  &__header {
    margin-bottom: 50px;
  }

  &__content {
    display: flex;
    justify-content: center;
  }

  &__plans {
    width: 1050px;
    display: flex;
    justify-content: center;
  }

  &__plan {
    margin: 0 15px;
  }

  &__link {
    margin: 35px 0 0;
  }
}
</style>
