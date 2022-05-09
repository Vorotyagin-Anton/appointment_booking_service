<template>
  <div
    class="container auth-alert"
    :class="[type, {'auth-alert_active': isVisible}]"
  >
    <div class="auth-alert__content">
      <div class="auth-alert__message">
        {{ message }}
      </div>

      <span
        class="material-icons auth-alert__close"
        @click="hide"
      >
        close
      </span>
    </div>
  </div>
</template>

<script>

import useMessage from "src/hooks/auth/useMessage";

export default {
  name: "AlertAlert",

  setup() {
    const {
      isVisible,
      message,
      lifetime,
      hide,
      makeClassByType,
      callLifetimeWatcher,
    } = useMessage();

    const type = makeClassByType('auth-alert__');

    callLifetimeWatcher();

    return {
      isVisible,
      type,
      message,
      lifetime,
      hide,
    }
  }
}
</script>

<style lang="scss">
.auth-alert {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 80px;
  display: flex;
  justify-content: center;
  transition: transform 300ms, background-color 300ms;
  transform: translateY(-100%);

  &_active {
    transform: translateY(0);
  }

  &__content {
    position: relative;
    width: 900px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  &__message {
    width: 100%;
    text-align: center;
    font-size: 14px;
    font-weight: 500;
    color: $white
  }

  &__close {
    position: absolute;
    right: 0;
    margin-left: 50px;
    font-size: 26px;
    font-weight: 500;
    color: $white;
    cursor: pointer;
  }

  &__success {
    background-color: $green-9;
  }

  &__info {
    background-color: $blue-9;
  }

  &__error {
    background-color: $deep-orange-14;
  }
}
</style>
