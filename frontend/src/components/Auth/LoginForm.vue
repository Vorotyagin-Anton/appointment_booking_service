<template>
  <q-form
    class="login-form"
    @submit="onSubmit"
  >
    <app-alert
      :visible="visible"
      :message="message"
      :type="type"
      @hide="hide"
    />

    <div class="login-form__to-register">
      <span class="login-form__p">New to Square?</span>&nbsp;

      <router-link class="login-form__link" :to="{name: 'auth.signup'}">
        Sign up
      </router-link>
    </div>

    <div class="login-form__inputs">
      <q-input
        class="login-form__input"
        placeholder="Email address"
        v-model="email"
        :rules="emailRules"
        :error="Boolean(error.fields.email)"
        :error-message="error.fields.email"
        outlined
      />

      <q-input
        class="login-form__input"
        placeholder="Password"
        type="password"
        v-model="pass"
        :rules="[passRules[0]]"
        :error="Boolean(error.fields.password)"
        :error-message="error.fields.password"
        outlined
      />
    </div>

    <router-link class="login-form__link" :to="{name: 'main'}">
      Forgot password?
    </router-link>

    <q-btn
      class="login-form__submit"
      color="primary"
      label="Sign in"
      type="submit"
      :disable="isRequested"
      no-caps
    />
  </q-form>
</template>

<script>
import useEmailInput from "src/hooks/form/useEmailInput";
import usePasswordInput from "src/hooks/form/usePasswordInput";
import useLogin from "src/hooks/user/useLogin";
import useForm from "src/hooks/common/useForm";
import useMessage from "src/hooks/common/useMessage";
import AppAlert from "components/Common/AppAlert";

export default {
  name: "LoginForm",

  components: {
    AppAlert,
  },

  setup() {
    const {email, emailRules} = useEmailInput();
    const {pass, passRules} = usePasswordInput();

    const {isRequested, error, submit} = useForm();

    const login = useLogin();

    const {visible, type, message, showError, hide} = useMessage();

    const onSubmit = async () => {
      await submit(login, email.value, pass.value);

      if (error.value.message) {
        showError(error.value.message, 3000);
      }
    };

    return {
      visible,
      type,
      message,
      hide,
      isRequested,
      email,
      emailRules,
      pass,
      passRules,
      error,
      onSubmit,
    }
  }
}
</script>

<style lang="scss">
.login-form {
  display: flex;
  flex-direction: column;

  &__inputs {
    padding: 10px 0;
  }

  &__p {
    font-size: 16px;
  }

  &__link {
    font-size: 16px;
    font-weight: 500;
    color: $blue-8;

    &:hover {
      color: $blue-6;
    }
  }

  &__input {
    width: 580px;
    margin: 5px 0 0;
  }

  &__submit {
    margin-top: 30px;
    width: 85px;
    height: 50px;
  }
}
</style>
