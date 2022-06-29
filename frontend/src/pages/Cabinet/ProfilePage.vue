<template>
  <div class="container profile-page">
    <app-loading
      v-if="loading"
      title="Updated Loading..."
    />

    <div
      class="profile-page__wrapper"
      v-else
    >
      <div class="profile-page__content">
        <h3 id="personal" class="profile-page__h3">Profile photo</h3>

        <account-avatar
          class="profile-page__avatar"
          :photo="user.pathToPhoto"
          v-model="avatar"
        />

        <h3 class="profile-page__h3">Basic Information</h3>

        <div class="profile-page__group">
          <account-field
            class="profile-page__field"
            label="First name"
            v-model="profile.name"
          />

          <account-field
            class="profile-page__field"
            label="Second name"
            v-model="profile.surname"
          />

          <account-field
            class="profile-page__field"
            label="Middle name"
            v-model="profile.middlename"
          />
        </div>

        <div class="change-password">
          <h3 class="profile-page__h3">Password</h3>

          <p class="profile-page__p">
            A strong password contains a mix of numbers, letters, and symbols. It is hard to
            guess, does not resemble a real word, and is only used for this account.
          </p>

          <q-btn
            class="profile-page__btn"
            label="Update password"
            color="primary"
            no-caps
            @click="openPasswordModal"
          />

          <q-dialog class="password-modal" v-model="passwordModal">
            <q-card class="password-modal__card">
              <q-card-section>
                <div class="text-h6 password-modal__header">Change Password</div>

                <label>
                  <span class="password-modal__label">Enter old password</span>
                  <q-input
                    class="password-modal__input"
                    placeholder="Old password"
                    type="password"
                    v-model="oldPass"
                    :rules="oldPassRules"
                    :dense="true"
                    outlined
                  />
                </label>

                <label>
                  <span class="password-modal__label">Create a new password</span>
                  <q-input
                    class="password-modal__input"
                    placeholder="New password"
                    type="password"
                    v-model="newPass"
                    :rules="newPassRules"
                    :dense="true"
                    outlined
                  />
                </label>

                <label>
                  <span class="password-modal__label">Confirm new password</span>
                  <q-input
                    class="password-modal__input"
                    placeholder="Password confirmation"
                    type="password"
                    v-model="passConfirmation"
                    :rules="passConfirmationRules"
                    :dense="true"
                    outlined
                  />
                </label>
              </q-card-section>

              <q-card-actions align="right">
                <q-btn
                  flat
                  outline
                  label="Cancel"
                  v-close-popup
                  @click="resetPasswordChanges"
                />

                <q-btn
                  flat
                  label="Submit"
                  color="primary"
                  v-close-popup
                  @click="submitPasswordChanges"
                />
              </q-card-actions>
            </q-card>
          </q-dialog>
        </div>

        <h3 class="profile-page__h3">2-step verification</h3>

        <p class="profile-page__p">
          Add an extra layer of security to your account. A verification code will be required each time someone logs in to
          Square Dashboard or a Square mobile app to confirm they are the account holder.
          <router-link
            class="profile-page__link"
            :to="{name: 'cabinet.profile'}"
          >
            <span class="profile-page__link-title">Learn more</span>
            <span class="material-icons profile-page__link-icon">navigate_next</span>
          </router-link>
        </p>

        <q-btn
          class="profile-page__btn"
          label="Enable 2-step verification"
          color="primary"
          no-caps
        />

        <h3 class="profile-page__h3">Personal Story</h3>

        <account-textarea
          class="profile-page__field"
          label="Business story"
          placeholder="Enter a brief bio about your business. Short descriptions are the most effective."
          v-model="profile.story"
        />

        <h3 id="contacts" class="profile-page__h3">Contact Information</h3>

        <div class="profile-page__group">
          <div class="profile-page__phone">
            <account-field
              class="profile-page__field"
              label="Phone Number"
              placeholder="Phone"
              v-model="profile.mobilePhoneNumber"
            />

            <span class="material-icons profile-page__icon-add">add_circle_outline</span>
          </div>

          <account-field
            class="profile-page__field"
            label="Email Address"
            type="email"
            v-model="profile.email"
          />

          <account-field
            class="profile-page__field"
            label="Website"
            type="text"
            placeholder="example.com"
            v-model="profile.website"
          />

          <account-field
            class="profile-page__field"
            label="Facebook"
            placeholder="facebook.com/example"
            v-model="profile.facebook"
          />

          <div class="profile-page__field">
            <account-field
              class="profile-page__telegram"
              label="Telegram"
              placeholder="Username"
              v-model="profile.telegram"
            />

            <account-field
              class="profile-page__instagram"
              label="Instagram"
              placeholder="Username"
              v-model="profile.instagram"
            />
          </div>
        </div>

        <h3 id="location" class="profile-page__h3">Business Address</h3>

        <div class="profile-page__group">
          <account-field
            class="profile-page__field"
            label="Full street address"
            placeholder="Street"
            v-model="profile.street"
          />

          <account-field
            class="profile-page__field"
            label="Apt/Unit"
            placeholder="Address"
            v-model="profile.home"
          />

          <account-field
            class="profile-page__field"
            label="City"
            placeholder="city"
            v-model="profile.city"
          />

          <div class="profile-page__field">
            <account-field
              class="profile-page__state"
              label="State"
              placeholder="State"
              v-model="profile.state"
            />

            <account-field
              class="profile-page__code"
              label="Code"
              placeholder="ZIP Code"
              v-model="profile.code"
            />
          </div>
        </div>
      </div>
    </div>
    <profile-footer
      class="profile-page__footer"
      @confirm="updateProfile"
    />

    <auth-alert/>
  </div>
</template>

<script>
import {ref, onMounted} from "vue";
import AccountField from "components/Cabinet/Common/AccountField";
import AccountTextarea from "components/Cabinet/Common/AccountTextarea";
import AccountAvatar from "components/Cabinet/Common/AccountAvatar";
import ProfileFooter from "components/Cabinet/Profile/ProfileFooter";
import AppLoading from "components/Common/AppLoading";
import AuthAlert from "components/Auth/AuthAlert";
import usePasswordInput from "src/hooks/form/usePasswordInput";
import useAuth from "src/hooks/user/useAuth";
import useProfile from "src/hooks/user/useProfile";

export default {
  name: "ProfilePage",

  components: {
    AuthAlert,
    AppLoading,
    AccountField,
    AccountTextarea,
    AccountAvatar,
    ProfileFooter,
  },

  emits: [
    'toggle-left-drawer',
  ],

  setup(props, {emit}) {
    const {user} = useAuth();

    const avatar = ref(null);

    const {loading, profile, updateProfile, changePassword} = useProfile(user.value);

    onMounted(() => {
      emit('toggle-left-drawer', {
        isOpen: false,
        isOverlay: true,
      });
    });

    const passwordModal = ref(false);

    const openPasswordModal = () => passwordModal.value = true;

    const {pass: oldPass, passRules: oldPassRules} = usePasswordInput();
    const {pass: newPass, passRules: newPassRules, passConfirmation, passConfirmationRules} = usePasswordInput();

    const submitPasswordChanges = () => {
      console.log('test')
      changePassword(oldPass.value, newPass.value);
    };

    const resetPasswordChanges = () => {
      oldPass.value = '';
      newPass.value = '';
      passConfirmation.value = '';
    };

    return {
      loading,
      user,
      avatar,
      profile,
      updateProfile,

      passwordModal,
      openPasswordModal,

      oldPass,
      oldPassRules,

      newPass,
      newPassRules,
      passConfirmation,
      passConfirmationRules,

      changePassword,
      submitPasswordChanges,
      resetPasswordChanges,
    }
  }
}
</script>

<style lang="scss">
.profile-page {
  &__wrapper {
    padding: 0 15px 85px;
    display: flex;
    justify-content: center;
  }

  &__content {
    width: 600px;
  }

  &__h3 {
    padding: 35px 0 10px;
    font-size: 18px;
    font-weight: 700;
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

  &__group {
    border-top: 1px solid $grey-4;

    .account-field {
      border-top: 0;
    }
  }

  &__field {
    width: 600px;
    display: flex;

    .account-field:first-child {
      border-right: 0;
    }
  }

  &__code {
    flex: 1;

    .account-field {
      &__label {
        width: 100px;
      }

      &__input {
        width: calc(100% - 100px);
      }
    }
  }

  &__state {
    flex: 2;
  }

  &__phone {
    position: relative;
    display: flex;
    align-items: center;
  }

  &__icon-add {
    position: absolute;
    right: -30px;
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

.password-modal {
  &__card {
    width: 450px;
    padding: 0 15px;
  }

  &__header {
    margin: 10px 0 15px;
  }

  &__input {
    margin-top: 5px;
  }
}
</style>
