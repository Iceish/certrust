<script setup>

import TheBreadcrumb from "@/components/TheBreadcrumb.vue";
import MountedTeleport from "@/components/MountedTeleport.vue";
</script>

<template>
    <MountedTeleport to="#breadcrumb">
        <TheBreadcrumb category="settings"/>
    </MountedTeleport>

  <p>Settings View</p>
</template>

<style scoped lang="scss">

</style>
