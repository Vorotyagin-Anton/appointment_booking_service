<template>
  <router-view/>
</template>

<script>
import {onMounted} from "vue";
import useAuth from "src/hooks/user/useAuth";

export default {
  name: 'App',

  setup() {
    const {authorize} = useAuth();
    onMounted(() => authorize())
  },
}
</script>

<style lang="scss">
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

a {
  color: $white;
  text-decoration: none;
}
</style>
