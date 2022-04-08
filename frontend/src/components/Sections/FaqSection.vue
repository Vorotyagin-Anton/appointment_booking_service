<template>
  <section class="container faq">
    <div class="faq__content">
      <div class="faq__intro">
        <h2 class="faq__title">FAQ</h2>
      </div>

      <q-list class="faq__list">

        <faq-section-item
          v-for="item in items"
          :key="item.label"
          :item="item"
        />

      </q-list>
    </div>
  </section>
</template>

<script>
import FaqSectionItem from "components/Sections/FaqSectionItem";
import {ref} from "vue";

const items = [
  {
    label: 'Why use online scheduling software?',
    content: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, eius reprehenderit eos corrupti commodi magni quaerat ex numquam, dolorum officiis modi facere maiores architecto suscipit iste eveniet doloribus ullam aliquid.'
  },
  {
    label: 'How do you set appointments?',
    content: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, eius reprehenderit eos corrupti commodi magni quaerat ex numquam, dolorum officiis modi facere maiores architecto suscipit iste eveniet doloribus ullam aliquid.'
  },
  {
    label: 'Is Square Appointments right for my business?',
    content: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, eius reprehenderit eos corrupti commodi magni quaerat ex numquam, dolorum officiis modi facere maiores architecto suscipit iste eveniet doloribus ullam aliquid.'
  },
  {
    label: 'How can I switch from my current scheduling software?',
    content: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, eius reprehenderit eos corrupti commodi magni quaerat ex numquam, dolorum officiis modi facere maiores architecto suscipit iste eveniet doloribus ullam aliquid.'
  },
  {
    label: 'How long will it take to set up my account?',
    content: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, eius reprehenderit eos corrupti commodi magni quaerat ex numquam, dolorum officiis modi facere maiores architecto suscipit iste eveniet doloribus ullam aliquid.'
  },
  {
    label: 'How do you reduce no-show appointments?',
    content: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, eius reprehenderit eos corrupti commodi magni quaerat ex numquam, dolorum officiis modi facere maiores architecto suscipit iste eveniet doloribus ullam aliquid.'
  },
  {
    label: 'How do you increase appointments?',
    content: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, eius reprehenderit eos corrupti commodi magni quaerat ex numquam, dolorum officiis modi facere maiores architecto suscipit iste eveniet doloribus ullam aliquid.'
  },
];

export default {
  name: "FaqComponent",

  components: {
    FaqSectionItem,
  },

  setup() {
    return {
      items: ref(items),
    }
  }
}
</script>

<style lang="scss">
.faq {
  background-color: $charcoal;
  color: $white;

  &__content {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 150px 0;
  }

  &__intro {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 35px;
  }

  &__title {
    font-size: 58px;
    font-weight: 450;
    letter-spacing: 1.5px;
  }

  &__list {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 700px;
  }
}
</style>
