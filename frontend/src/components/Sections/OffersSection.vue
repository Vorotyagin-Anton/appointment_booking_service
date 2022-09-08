<template>
  <app-section class="offers-section">
    <app-section-header
      class="offers-section__header"
      heading="The all-in-one point of sale for booking, payments, and more"
      description="We handle the admin while you do more of what you love"
    />

    <div class="offers-section__content">
      <offers-section-item
        class="offers-section__card"
        v-for="offer in offers"
        :key="offer.id"
        :offer="offer"
        :selected="cardId"
        :class="{'offers-section__card_disabled': cardId && cardId !== offer.id}"
        @open="openCard"
        @close="closeCard"
        @click.stop
      />

      <app-section-link
        class="offers-section__link"
        label="See all features"
        :to="{name: 'main'}"
      />
    </div>

  </app-section>
</template>

<script>
import {onMounted, onUnmounted, ref} from "vue";
import AppSection from "components/Common/AppSection";
import AppSectionHeader from "components/Common/AppSectionHeader";
import OffersSectionItem from "components/Sections/OffersSectionItem";
import AppSectionLink from "components/Common/AppSectionLink";

const offers = [
  {
    id: 1,
    heading: 'Simplify scheduling',
    promo: 'Manage your availability from the app, let customers book online, and send reminders.',
    list: [
      'Mobile app for iOS and Android to manage appointments on the go',
      'Free customer booking website',
      'Automated email and SMS reminders with Square Assistant',
      'Recurring appointments',
      'Multi-location management',
      'Instagram and Google integration',
      'Cancellation and no-show fees',
      'Let clients book multiple services with different providers online',
    ],
    image: '/img/offer-feature-001.png',
  },
  {
    id: 2,
    heading: 'Maximize your POS',
    promo: 'Check out at the counter, keep a card on file, or send an invoice—our point of sale is flexible.',
    list: [
      'Contactless, in-person payments',
      'Card on File',
      'Prepayment before visits',
      'Unlimited items and item search',
      'Key in payments',
      'Professional invoices',
      'eGift Cards and plastic gift cards',
      'LData security (PCI) compliance',
    ],
    image: '/img/offer-feature-002.png',
  },
  {
    id: 3,
    heading: 'Put people first',
    promo: 'Prioritize your customers and your staff with client profiles and team management tools.',
    list: [
      'See all customer history, texts and emails in one place with Square Messages',
      'Time tracking',
      'Timecard reporting',
      'Payroll exports',
      'Auto-created customer profiles',
      'Customer notes and reminders',
      'Attach contracts and files with key information',
      'Customer loyalty program',
    ],
    image: '/img/offer-feature-003.png',
  },
  {
    id: 4,
    heading: 'Put people first',
    promo: 'Prioritize your customers and your staff with client profiles and team management tools.',
    list: [
      'See all customer history, texts and emails in one place with Square Messages',
      'Time tracking',
      'Timecard reporting',
      'Payroll exports',
      'Auto-created customer profiles',
      'Customer notes and reminders',
      'Attach contracts and files with key information',
      'Customer loyalty program',
    ],
    image: '/img/offer-feature-004.png',
  },
];

export default {
  name: "OffersSection",

  components: {
    AppSectionLink,
    OffersSectionItem,
    AppSection,
    AppSectionHeader,
  },

  setup() {
    const cardId = ref(null);
    const openCard = (id) => cardId.value = id;
    const closeCard = () => cardId.value = null;

    const handleClickOutside = (event) => {
      if (!event.target.classList.contains('offers-section__card')) {
        cardId.value = null;
      }
    };

    onMounted(() => document.addEventListener('click', handleClickOutside));
    onUnmounted(() => document.removeEventListener('click', handleClickOutside));

    return {
      offers,
      cardId,
      openCard,
      closeCard,
    }
  }
}
</script>

<style lang="scss">
.offers-section {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding-top: 100px;

  &__header {
    margin-bottom: 25px;

    .app-section-header__heading {
      width: 700px;
      text-align: center;
      font-weight: 400;
      margin-bottom: 10px;
    }

    .app-section-header__description {
      font-size: 22px;
    }
  }

  &__content {
    width: 1050px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
  }

  &__card {
    &_disabled {
      opacity: .5;
    }
  }

  &__link {
    margin-top: 65px;
  }
}
</style>
