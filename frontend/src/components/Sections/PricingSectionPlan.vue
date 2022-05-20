<template>
  <div class="pricing-section-plan">
    <div class="pricing-section-plan__content">
      <h3 class="pricing-section-plan__h3">{{ plan.name }}</h3>

      <p class="pricing-section-plan__promo">{{ plan.promo }}</p>

      <div class="pricing-section-plan__size">
        <span class="pricing-section-plan__price">&#36;{{ plan.price }}/mo</span>
        <span class="pricing-section-plan__location"> {{ plan.location }}</span>
      </div>

      <div class="pricing-section-plan__transaction">
        <span>Per transaction:</span>
        <span>{{ plan.transaction }} (in person)</span>
      </div>

      <q-btn
        class="pricing-section-plan__btn"
        color="primary"
        label="Get started free"
        :to="{name: 'main'}"
      />

      <div class="pricing-section-plan__features">
        <div class="pricing-section-plan__h5">Top {{ plan.name }} features</div>

        <div
          class="pricing-section-plan__feature"
          v-for="(feature, key) in plan.features"
          :key="key"
        >
          <span class="material-icons pricing-section-plan__done">done</span>
          <span>{{ feature }}</span>
        </div>
      </div>
    </div>

    <router-link
      class="pricing-section-plan__more"
      :to="plan.link"
    >
      See more <span class="material-icons pricing-section-plan__arrow-right">keyboard_arrow_right</span>
    </router-link>
  </div>
</template>

<script>
export default {
  name: "PricingSectionPlan",

  props: {
    plan: {
      type: Object,
      required: true,
    }
  }
}
</script>

<style lang="scss">
.pricing-section-plan {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 40px;
  border-radius: 3px;
  background-color: $white;

  &__content {
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    flex-direction: column;
  }

  &__h3 {
    font-size: 32px;
    margin-bottom: 10px;
  }

  &__promo {
    margin-bottom: 15px;
    text-align: center;
  }

  &__size {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 20px;
  }

  &__price {
    font-size: 36px;
    font-weight: 500;
    color: $primary;
  }

  &__location {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: $grey-8;
  }

  &__transaction {
    margin-bottom: 25px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: $grey-8;
  }

  &__btn {
    width: 240px;
    height: 50px;
    margin-bottom: 40px;
  }

  &__features {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    align-self: flex-start;
  }

  &__h5 {;
    margin-bottom: 20px;
    font-weight: 500;
  }

  &__feature {
    display: flex;
    margin-bottom: 5px;
  }

  &__done {
    font-size: 20px;
    margin-right: 10px;
    color: $primary;
  }

  &__more {
    display: flex;
    align-items: center;
    color: $primary;
    font-weight: 500;
  }

  &__arrow-right {
    font-size: 18px;
  }
}
</style>
