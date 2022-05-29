<template>
  <q-form
    class="login-form"
    @submit="onSubmit"
  >
    <div class="login-form__to-register">
      <span class="login-form__p">New to Square?</span>&nbsp;

      <router-link
        class="login-form__link"
        :to="{name: 'auth.signup'}"
      >
        Sign up
      </router-link>
    </div>

    <div class="login-form__inputs">
      <q-input
        class="login-form__input"
        placeholder="Email address"
        v-model="email"
        outlined
      />

      <q-input
        class="login-form__input"
        placeholder="Password"
        type="password"
        v-model="pass"
        outlined
      />
    </div>

    <router-link
      class="login-form__link"
      :to="{name: 'main'}"
    >
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
import useAuth from "src/hooks/auth/useAuth";

export default {
  name: "LoginForm",

  setup() {
    const {email} = useEmailInput();
    const {pass} = usePasswordInput();

    const {isRequested, login} = useAuth();

    const onSubmit = () => login(email.value, pass.value);

    return {
      email,
      pass,
      isRequested,
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
