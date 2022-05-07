<template>
  <q-page>
    <promo-section/>
    <catalog-tabs/>
    <featured-masters/>
    <sign-up-invitation/>
    <faq-component/>
  </q-page>
</template>

<script>
import PromoSection from "components/Sections/PromoSection";
import CatalogTabs from "components/Catalog/CatalogTabs";
import FeaturedMasters from "components/Sections/FeaturedMasters";
import SignUpInvitation from "components/Sections/SignUpInvitation";
import FaqComponent from "components/Sections/FaqSection";

export default {
  name: 'IndexPage',

  components: {
    PromoSection,
    CatalogTabs,
    FeaturedMasters,
    SignUpInvitation,
    FaqComponent,
  },
}
</script>
