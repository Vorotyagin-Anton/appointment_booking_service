<template>
  <div class="signin">
    <div class="signin__content">

      <h2 class="signin__heading">Sign in</h2>

      <q-form
        class="signin-form"
        @submit="onSubmit"
      >
        <div class="signin-form__to-signup">
          <span class="signin-form__p">New to Square?</span>&nbsp;
          <router-link class="signin-form__link" :to="{name: 'signup'}">Sign up</router-link>
        </div>

        <div class="signin-form__inputs">
          <q-input
            class="signin-form__input"
            placeholder="Email address"
            name="name"
            v-model="email"
            :rules="emailRules"
            outlined
          />

          <q-input
            class="signin-form__input"
            placeholder="Password"
            name="password"
            type="password"
            v-model="pass"
            :rules="passRules"
            outlined
          />
        </div>
        <router-link class="signin-form__link" :to="{name: 'main'}">Forgot password?</router-link>

        <q-btn
          class="signin-form__submit"
          color="primary"
          label="Sign in"
          type="submit"
          no-caps
        />

      </q-form>
    </div>

  </div>
</template>

<script>
import useEmailInput from "src/hooks/form/useEmailInput";
import usePasswordInput from "src/hooks/form/usePasswordInput";
import useAuthorization from "src/hooks/auth/useAuthorization";

export default {
  name: "SignInPage",

  setup() {
    const {email, emailRules} = useEmailInput();
    const {pass, passRules} = usePasswordInput();
    const {authorize} = useAuthorization();

    const onSubmit = () => authorize(email, pass);

    return {
      email,
      emailRules,
      pass,
      passRules,
      onSubmit,
    }
  }
}
</script>

<style lang="scss">
.signin {
  display: flex;
  align-items: center;
  justify-content: center;

  &__content {
    padding-top: 300px;
  }

  &__heading {
    text-align: left;
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 20px;
  }
}

.signin-form {
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
