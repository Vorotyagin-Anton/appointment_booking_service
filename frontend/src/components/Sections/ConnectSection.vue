<template>
  <app-section class="connect-section">
    <div class="connect-section__content">
      <app-section-header
        class="connect-section__header"
        heading="We’re happy to help."
        description="Please select the option that best fits you."
      />

      <div class="connect-section__options">
        <ConnectSectionOption
          class="connect-section__option"
          v-for="(option, key) in options"
          :key="key"
          :icon="option.icon"
          :title="option.title"
        />
      </div>
    </div>
  </app-section>
</template>

<script>
import AppSection from "components/Common/AppSection";
import AppSectionHeader from "components/Common/AppSectionHeader";
import ConnectSectionOption from "components/Sections/ConnectSectionOption";

const options = [
  {
    icon: 'medical_services',
    title: 'I have an account, and I need support.',
  },
  {
    icon: 'dashboard_customize',
    title: 'I have an account, and I am interested in more products.',
  },
  {
    icon: 'handshake',
    title: 'I don`t have a Square account, and I have questions.',
  },
];

export default {
  name: "ConnectSection",

  components: {
    AppSection,
    AppSectionHeader,
    ConnectSectionOption,
  },

  setup() {
    return {
      options,
    }
  }
}
</script>

<style lang="scss">
.connect-section {
  height: 600px;

  &__content {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%;
  }

  &__header {
    margin-bottom: 25px;
  }

  &__options {
    width: 100%;
    display: flex;
    justify-content: space-between;
    padding: 25px 185px;
  }
}
</style>
