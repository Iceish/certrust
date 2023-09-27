<script setup>

import TheBreadcrumb from "@/components/TheBreadcrumb.vue";
</script>

<template>
    <Teleport to="#breadcrumb">
        <TheBreadcrumb category="management"/>
    </Teleport>

  <p>Management View</p>
</template>

<style scoped lang="scss">

</style>
