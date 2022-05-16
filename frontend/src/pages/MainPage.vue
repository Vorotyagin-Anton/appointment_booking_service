<template>
  <q-page>
    <promo-section/>
    <categories-section/>
    <featured-masters/>
    <invitation-section/>
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

export default {
  name: 'IndexPage',

  components: {
    CategoriesSection,
    PromoSection,
    FeaturedMasters,
    InvitationSection,
    ConnectSection,
    FaqComponent,
  },
}
</script>
