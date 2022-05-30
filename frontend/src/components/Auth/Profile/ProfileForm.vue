<template>
  <div class="profile-form">
    <div class="profile-form__content">

      <h2 class="profile-form__h2">Let’s talk about you.</h2>

      <p class="profile-form__p">
        Enter your legal name and home address, even if registering as a business. We will not use this information to
        perform a credit check, just to verify your identity.
      </p>

      <div class="profile-form-settings profile-form__form">

        <div class="profile-form-settings__row">
          <div class="profile-form-settings__col profile-form-settings__first-name">
            <div class="profile-form-settings__label">Legal name</div>

            <q-input
              class="profile-form-settings__input"
              outlined
              dense
              v-model="profile.firstName"
              placeholder="First name"
            />
          </div>

          <div class="profile-form-settings__col profile-form-settings__last-name">
            <q-input
              class="profile-form-settings__input"
              outlined
              dense
              v-model="profile.lastName"
              placeholder="Last name"
            />
          </div>
        </div>

        <div class="profile-form-settings__row">
          <div class="profile-form-settings__col profile-form-settings__street">
            <div class="profile-form-settings__label">Address</div>

            <q-input
              class="profile-form-settings__input"
              outlined
              dense
              v-model="profile.street"
              placeholder="Full street address"
            />
          </div>

          <div class="profile-form-settings__col profile-form-settings__home">
            <q-input
              class="profile-form-settings__input"
              outlined
              dense
              v-model="profile.home"
              placeholder="Apt/Unit"
            />
          </div>
        </div>

        <div class="profile-form-settings__row">
          <div class="profile-form-settings__col profile-form-settings__code">
            <div class="profile-form-settings__label">Code</div>

            <q-input
              class="profile-form-settings__input"
              outlined
              dense
              v-model="profile.code"
              placeholder="Full street address"
            />
          </div>

          <div class="profile-form-settings__col profile-form-settings__city">
            <div class="profile-form-settings__label">City</div>

            <q-input
              class="profile-form-settings__input"
              outlined
              dense
              v-model="profile.city"
              placeholder="Full street address"
            />
          </div>

          <div class="profile-form-settings__col profile-form-settings__state">
            <div class="profile-form-settings__label">State</div>

            <q-input
              class="profile-form-settings__input"
              outlined
              dense
              v-model="profile.state"
              placeholder="Full street address"
            />
          </div>
        </div>

        <div class="profile-form-settings__row">
          <div class="profile-form-settings__col profile-form-settings__month">
            <div class="profile-form-settings__label">Date of birth</div>

            <q-select
              class="profile-form-settings__input"
              outlined
              dense
              options-dense
              v-model="profile.month"
              :options="months"
              label="Select month..."
            />
          </div>

          <div class="profile-form-settings__col profile-form-settings__day">
            <q-input
              class="profile-form-settings__input"
              outlined
              dense
              v-model="profile.day"
              placeholder="DD"
            />
          </div>

          <div class="profile-form-settings__col profile-form-settings__year">
            <q-input
              class="profile-form-settings__input"
              outlined
              dense
              v-model="profile.year"
              placeholder="YYYY"
            />
          </div>
        </div>

        <div class="profile-form-settings__row">
          <div class="profile-form-settings__col profile-form-settings__email">
            <div class="profile-form-settings__label">Email address</div>

            <q-input
              class="profile-form-settings__input"
              type="email"
              outlined
              dense
              v-model="profile.email"
              placeholder="Email"
            />
          </div>

          <div class="profile-form-settings__col profile-form-settings__phone">
            <div class="profile-form-settings__label">Phone number</div>

            <q-input
              class="profile-form-settings__input"
              outlined
              dense
              v-model="profile.phone"
              placeholder="(000) 000-0000"
            />
          </div>
        </div>
      </div>

      <div class="profile-type__bottom">
        <q-btn
          class="profile-type__btn"
          label="Back"
          color="black"
          outline
          no-caps
          @click="prev"
        />

        <q-btn
          class="profile-type__btn"
          label="Continue"
          color="primary"
          no-caps
          @click="next"
        />
      </div>
    </div>
  </div>
</template>
<script>
// TODO: add form validation 

import {useRouter} from "vue-router";
import useProfile from "src/hooks/auth/useProfile";

const months = [
  {label: '01 - January', value: 1},
  {label: '02 - February', value: 2},
  {label: '03 - March', value: 3},
  {label: '04 - April', value: 4},
  {label: '05 - May', value: 5},
  {label: '06 - June', value: 6},
  {label: '07 - July', value: 7},
  {label: '08 - August', value: 8},
  {label: '09 - September', value: 9},
  {label: '10 - October', value: 10},
  {label: '11 - November', value: 11},
  {label: '12 - December', value: 12},
];

export default {
  name: "profile-form",

  emits: [
    'prev',
  ],

  setup(props, {emit}) {
    const router = useRouter();

    const {profile, updateProfile} = useProfile();

    const next = async () => {
      await updateProfile();
      await router.push({name: 'cabinet'});
    };

    const prev = () => emit('prev');

    return {
      months,
      profile,
      next,
      prev,
    }
  }
}
</script>

<style lang="scss">
.profile-form {
  display: flex;
  justify-content: center;

  &__content {
    width: 750px;
    display: flex;
    flex-direction: column;
  }

  &__h2 {
    font-size: 36px;
    padding: 15px 0;
  }

  &__p {
    font-size: 18px;
    margin-bottom: 15px;
    font-weight: 200;
  }

  &__bottom {
    margin-top: 25px;
    width: 100%;
    display: flex;
    justify-content: space-between;
    padding: 25px 0;
    border-top: 1px solid $grey-4;
  }

  &__btn {
    width: 360px;
    height: 40px;
  }
}

.profile-form-settings {
  width: 100%;
  display: flex;
  flex-direction: column;

  &__row {
    display: flex;
    justify-content: space-between;
  }

  &__col {
    margin-right: 10px;
    height: 75px;
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
  }

  &__label {
    position: absolute;
    top: 15px;
    left: 5px;
    font-size: 12px;
    font-weight: 500;
    color: $grey-7;
  }

  &__input {
    height: 40px;

    .q-field__control:before {
      border-radius: 3px;
      border: 1px solid $grey-4;
    }

    .q-field__label {
      color: $grey-6;
    }

    .q-field__native::placeholder {
      color: $grey-6;
    }
  }

  &__first-name {
    flex: 1;
  }

  &__last-name {
    flex: 1;
    margin-right: 0;
  }

  &__street {
    flex: 6;
  }

  &__home {
    flex: 1.5;
    margin-right: 0;
  }

  &__code {
    flex: 1;
  }

  &__city {
    flex: 1;
  }

  &__state {
    flex: 1;
    margin-right: 0;
  }

  &__month {
    flex: 1;
  }

  &__day {
    flex: 1;
  }

  &__year {
    flex: 1;
    margin-right: 0;
  }

  &__email {
    flex: 1;
  }

  &__phone {
    flex: 1;
    margin-right: 0;
  }
}
</style>
