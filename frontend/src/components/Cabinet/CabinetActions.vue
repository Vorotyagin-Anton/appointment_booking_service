<template>
  <div class="cabinet-actions">
    <q-btn
      class="cabinet-actions__btn"
      color="grey-2"
      text-color="primary"
      icon="attach_money"
      label="Take a payment"
      :to="{name: 'cabinet'}"
      unelevated
      no-caps
    />

    <q-btn
      class="cabinet-actions__btn"
      color="grey-2"
      text-color="primary"
      icon="markunread_mailbox"
      label="Send an invoice"
      :to="{name: 'cabinet'}"
      unelevated
      no-caps
    />

    <q-btn
      class="cabinet-actions__btn"
      color="grey-2"
      text-color="primary"
      icon="queue"
      label="Add an item"
      :to="{name: 'cabinet'}"
      unelevated
      no-caps
    />

    <q-btn
      class="cabinet-actions__btn"
      color="grey-2"
      text-color="primary"
      icon="favorite_border"
      label="Ask for donations"
      :to="{name: 'cabinet'}"
      unelevated
      no-caps
    />
  </div>
</template>

<script>
export default {
  name: "CabinetActions",
}
</script>

<style lang="scss">
.cabinet-actions {
  display: flex;
  flex-direction: column;
  padding: 50px 0;

  &__btn {
    width: 300px;
    height: 45px;
    font-size: 15px;
    font-weight: 500;
    border-radius: 7px;
    margin-bottom: 5px;

    .q-btn__content {
      justify-content: flex-start;
    }

    .q-icon {
      font-size: 19px;
      font-weight: 800;
    }
  }
}
</style>
