<template>
  <q-page>
    <promo-section/>
    <catalog-tabs/>
    <featured-masters/>
    <sign-up-invitation/>
    <connect-section/>
    <faq-component/>
  </q-page>
</template>

<script>
import PromoSection from "components/Sections/PromoSection";
import CatalogTabs from "components/Catalog/CatalogTabs";
import FeaturedMasters from "components/Sections/FeaturedMasters";
import SignUpInvitation from "components/Sections/SignUpInvitation";
import ConnectSection from "components/Sections/ConnectSection";
import FaqComponent from "components/Sections/FaqSection";

export default {
  name: 'IndexPage',

  components: {
    PromoSection,
    CatalogTabs,
    FeaturedMasters,
    SignUpInvitation,
    ConnectSection,
    FaqComponent,
  },
}
</script>
