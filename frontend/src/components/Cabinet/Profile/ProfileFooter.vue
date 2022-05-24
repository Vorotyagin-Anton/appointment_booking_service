<template>
  <footer class="container profile-footer">
    <div class="profile-footer__content">
      <q-btn
        class="profile-footer__btn profile-footer__reset"
        :disable="isCancelDisabled"
        label="Cancel"
        no-caps
        outline
      />

      <q-btn
        class="profile-footer__btn profile-footer__save"
        :disable="isSaveDisabled"
        label="Save"
        color="primary"
        no-caps
      />
    </div>
  </footer>
</template>

<script>
export default {
  name: "ProfileFooter",

  props: {
    isCancelDisabled: {
      type: Boolean,
      default: false,
    },

    isSaveDisabled: {
      type: Boolean,
      default: false,
    },
  },
}
</script>

<style lang="scss">
.profile-footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  height: 70px;
  border-top: 1px solid $grey-4;
  background-color: $white;

  &__content {
    height: 100%;
    padding: 0 15px;
    display: flex;
    justify-content: flex-end;
    align-items: center;
  }

  &__btn {
    width: 85px;
    color: $grey-7;
  }

  &__reset {
    margin-right: 10px;

    &::before {
      border: 1px solid $grey-7;
      box-shadow: none;
    }
  }
}
</style>
