<script setup>
import {onMounted, ref} from "vue";

    defineProps(['to']);

    const isMounted = ref(false);

    onMounted( () => {
        isMounted.value = true;
        }
    )
</script>

<template>
    <Teleport :to="to" v-if="isMounted" ><slot></slot></Teleport>
</template>

<style scoped lang="scss">

</style>
