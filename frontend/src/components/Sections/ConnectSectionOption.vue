<template>
  <div class="connect-option">
    <span class="material-icons connect-option__icon">{{ icon }}</span>
    <h3 class="connect-option__title">{{ title }}</h3>
  </div>
</template>

<script>
export default {
  name: "ConnectSectionOption",
  
  props: {
    icon: {
      type: String,
      required: true,
    },
    
    title: {
      type: String,
      required: true,
    },
  },
}
</script>

<style lang="scss">
.connect-option {
  display: flex;
  flex-direction: column;
  padding: 25px 60px;
  width: 320px;
  height: 210px;
  transition-property: box-shadow;
  transition-duration: .5s;
  box-shadow: rgba(100, 100, 111, .2) 0 7px 29px 0;
  cursor: pointer;

  &:hover {
    box-shadow: rgba(0, 0, 0, .16) 0 10px 36px 0, rgba(0, 0, 0, .06) 0 0 0 1px;
  }

  &__icon {
    margin-bottom: 25px;
    font-size: 40px;
    color: $blue-500;
  }

  &__title {
    display: flex;
    justify-content: center;
    text-align: center;
    font-size: 20px;
    font-weight: 500;
    line-height: 30px;
    letter-spacing: normal;
  }
}
</style>
