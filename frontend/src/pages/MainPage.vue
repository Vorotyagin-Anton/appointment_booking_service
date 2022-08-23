<template>
  <q-page>
    <promo-section/>
    <offers-section/>
    <categories-section/>
    <invitation-section/>
    <pricing-section/>
    <connect-section/>
    <faq-section/>
  </q-page>
</template>

<script>
import PromoSection from "components/Sections/PromoSection";
import InvitationSection from "components/Sections/InvitationSection";
import ConnectSection from "components/Sections/ConnectSection";
import FaqSection from "components/Sections/FaqSection";
import CategoriesSection from "components/Sections/CategoriesSection";
import OffersSection from "components/Sections/OffersSection";
import PricingSection from "components/Sections/PricingSection";

export default {
  name: 'IndexPage',

  components: {
    PricingSection,
    OffersSection,
    CategoriesSection,
    PromoSection,
    InvitationSection,
    ConnectSection,
    FaqSection,
  },
}
</script>
