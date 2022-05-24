<template>
  <footer class="container main-footer">
    <div class="main-footer__content">
      <main-footer-nav/>
      <main-footer-info/>
    </div>
  </footer>
</template>

<script>
import MainFooterNav from "components/MainFooter/MainFooterNav";
import MainFooterInfo from "components/MainFooter/MainFooterInfo";
import useAppTime from "src/hooks/common/useAppTime";

export default {
  name: "MainFooter",

  components: {
    MainFooterNav,
    MainFooterInfo,
  },

  setup() {
    const date = useAppTime();

    return {
      date,
    }
  }
}
</script>

<style lang="scss">
.main-footer {
  display: flex;
  justify-content: center;
  background: $charcoal;

  &__content {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 900px;
    padding: 35px 0;
  }
}
</style>
