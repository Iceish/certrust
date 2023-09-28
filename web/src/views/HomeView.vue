<script setup>
import MountedTeleport from "@/components/MountedTeleport.vue";
import TheBreadcrumb from "@/components/TheBreadcrumb.vue";


</script>

<template>
    <MountedTeleport to="#breadcrumb">
        <TheBreadcrumb category="home"/>
    </MountedTeleport>

  <p>Home view.</p>
</template>

<style lang="scss">

</style>
