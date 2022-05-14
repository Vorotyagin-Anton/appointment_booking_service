<template>
  <q-page>
    <promo-section/>
    <featured-masters/>
    <sign-up-invitation/>
    <connect-section/>
    <faq-component/>
  </q-page>
</template>

<script>
import PromoSection from "components/Sections/PromoSection";
import FeaturedMasters from "components/Sections/FeaturedMasters";
import SignUpInvitation from "components/Sections/SignUpInvitation";
import ConnectSection from "components/Sections/ConnectSection";
import FaqComponent from "components/Sections/FaqSection";

export default {
  name: 'IndexPage',

  components: {
    PromoSection,
    FeaturedMasters,
    SignUpInvitation,
    ConnectSection,
    FaqComponent,
  },
}
</script>
