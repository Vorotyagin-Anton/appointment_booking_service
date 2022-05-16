<template>
  <q-page>
    <promo-section/>
    <offers-section/>
    <categories-section/>
    <invitation-section/>
    <featured-masters/>
    <connect-section/>
    <faq-component/>
  </q-page>
</template>

<script>
import PromoSection from "components/Sections/PromoSection";
import FeaturedMasters from "components/Sections/FeaturedMasters";
import InvitationSection from "components/Sections/InvitationSection";
import ConnectSection from "components/Sections/ConnectSection";
import FaqComponent from "components/Sections/FaqSection";
import CategoriesSection from "components/Sections/CategoriesSection";
import OffersSection from "components/Sections/OffersSection";

export default {
  name: 'IndexPage',

  components: {
    OffersSection,
    CategoriesSection,
    PromoSection,
    FeaturedMasters,
    InvitationSection,
    ConnectSection,
    FaqComponent,
  },
}
</script>
