<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <component :is="$route.meta.layout || 'div'">
    <RouterView />
  </component>
</template>

<style scoped>
</style>
