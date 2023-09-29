<script setup>
import { RouterView} from "vue-router";
import {Suspense} from "vue";

</script>

<template>
    <Suspense>
        <template #default>
                <RouterView :key="$route.path" />
        </template>
        <template #fallback>
            <div>loading..</div>
        </template>
    </Suspense>
</template>

<style scoped>
</style>
