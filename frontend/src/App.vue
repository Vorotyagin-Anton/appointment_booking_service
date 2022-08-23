<script setup>
import {onMounted} from "vue";
import useAuth from "src/hooks/user/useAuth";

const {authorize} = useAuth();

onMounted(() => authorize())
</script>

<template>
  <router-view/>
</template>

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
