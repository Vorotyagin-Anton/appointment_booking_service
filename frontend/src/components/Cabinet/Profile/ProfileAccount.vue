<template>
  <div class="profile-account">
    <h3 id="personal" class="profile-account__h3">Profile photo</h3>

    <account-avatar
      class="profile-account__avatar"
      :photo="user.pathToPhoto"
      v-model="avatar"
    />

    <h3 class="profile-account__h3">Basic Information</h3>

    <div class="profile-account__field">
      <account-field
        label="First name"
        v-model="profile.name"
      />
    </div>

    <div class="profile-account__field">
      <account-field
        label="Second name"
        v-model="profile.surname"
      />
    </div>

    <div class="profile-account__field">
      <account-field
        label="Middle name"
        v-model="profile.middlename"
      />
    </div>

    <h3 class="profile-account__h3">Date of birth</h3>

    <div class="profile-account__field">
      <div class="profile-account__month">
        <account-select
          label="Month"
          placeholder="Select month..."
          v-model="profile.month"
          :options="months"
        />
      </div>

      <div class="profile-account__day">
        <account-field
          label="Day"
          placeholder="DD"
          v-model="profile.day"
        />
      </div>

      <div class="profile-account__year">
        <account-field
          label="Year"
          placeholder="YYYY"
          v-model="profile.year"
        />
      </div>
    </div>

    <h3 class="profile-account__h3">Password</h3>

    <p class="profile-account__p">
      A strong password contains a mix of numbers, letters, and symbols. It is hard to
      guess, does not resemble a real word, and is only used for this account.
    </p>

    <q-btn
      class="profile-account__btn"
      label="Update password"
      color="primary"
      no-caps
    />

    <h3 class="profile-account__h3">2-step verification</h3>

    <p class="profile-account__p">
      Add an extra layer of security to your account. A verification code will be required each time someone logs in to
      Square Dashboard or a Square mobile app to confirm they are the account holder.
      <router-link
        class="profile-account__link"
        :to="{name: 'cabinet.profile'}"
      >
        <span class="profile-account__link-title">Learn more</span>
        <span class="material-icons profile-account__link-icon">navigate_next</span>
      </router-link>
    </p>

    <q-btn
      class="profile-account__btn"
      label="Enable 2-step verification"
      color="primary"
      no-caps
    />

    <h3 class="profile-account__h3">Personal Story</h3>

    <p class="profile-account__p">
      Enter a brief bio about your business. Short descriptions are the most effective.
    </p>

    <div class="profile-account__field">
      <account-textarea
        label="Business story"
        v-model="profile.story"
      />
    </div>

    <h3 id="contacts" class="profile-account__h3">Contact Information</h3>

    <div class="profile-account__field">
      <account-field
        label="Email Address"
        type="email"
        v-model="profile.email"
      />
    </div>

    <div class="profile-account__phone">
      <div class="profile-account__field">
        <account-field
          label="Phone Number"
          v-model="profile.mobilePhoneNumber"
        />
      </div>

      <span class="material-icons profile-account__icon-add">add_circle_outline</span>
    </div>

    <h3 id="location" class="profile-account__h3">Business Address</h3>

    <div class="profile-account__field">
      <account-field
        label="Full street address"
        v-model="profile.street"
      />
    </div>

    <div class="profile-account__field">
      <account-field
        label="Apt/Unit"
        v-model="profile.home"
      />
    </div>

    <div class="profile-account__field">
      <account-field
        label="City"
        v-model="profile.city"
      />
    </div>

    <div class="profile-account__field">
      <div class="profile-account__code">
        <account-field
          label="Code"
          v-model="profile.code"
        />
      </div>

      <div class="profile-account__state">
        <account-field
          label="State"
          v-model="profile.state"
        />
      </div>
    </div>
  </div>
</template>

<script>

import {ref} from "vue";
import useAuth from "src/hooks/auth/useAuth";
import useProfile from "src/hooks/auth/useProfile";
import AccountSelect from "components/Cabinet/Common/AccountSelect";
import AccountField from "components/Cabinet/Common/AccountField";
import AccountTextarea from "components/Cabinet/Common/AccountTextarea";
import AccountAvatar from "components/Cabinet/Common/AccountAvatar";

export default {
  name: "ProfileAccount",

  components: {
    AccountField,
    AccountTextarea,
    AccountAvatar,
    AccountSelect,
  },

  setup() {
    const {user} = useAuth();

    const avatar = ref(null);

    const {profile, months} = useProfile(user.value);

    return {
      user,
      avatar,
      profile,
      months,
    }
  }
}
</script>

<style lang="scss">
.profile-account {

  &__h3 {
    padding: 35px 0 10px;
    font-size: 18px;
    font-weight: 700;
  }

  &__p {
    width: 600px;
  }

  &__link {
    align-items: center;
    color: $primary;
  }

  &__link-title {
    &:hover {
      text-decoration: underline;
    }
  }

  &__btn {
    min-width: 150px;
    height: 50px;
  }

  &__field {
    width: 600px;
    margin-bottom: 10px;
    display: flex;
  }

  &__month {
    flex: 1.5;
  }

  &__day {
    flex: 1;
  }

  &__year {
    flex: 1;
  }

  &__code {
    flex: 1.5;
  }

  &__state {
    flex: 2;
  }

  &__phone {
    display: flex;
    align-items: center;
  }

  &__icon-add {
    margin-left: 5px;
    margin-bottom: 10px;
    font-size: 24px;
    color: $grey-6;
    cursor: pointer;
    transition-property: transform;
    transition-duration: .4s;

    &:hover {
      color: $primary;
    }
  }
}
</style>
