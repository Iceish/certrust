<script setup>

import TheBreadcrumb from "@/components/TheBreadcrumb.vue";
import MountedTeleport from "@/components/MountedTeleport.vue";
</script>

<template>
    <MountedTeleport to="#breadcrumb">
        <TheBreadcrumb category="management"/>
    </MountedTeleport>

  <p>Management View</p>
</template>

<style scoped lang="scss">

</style>
