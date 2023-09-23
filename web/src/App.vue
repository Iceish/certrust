<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
    <Suspense>
        <template #default>
            <component :is="$route.meta.layout || 'div'">
                <RouterView />
            </component>
        </template>
        <template #fallback>
            <div>loading..</div>
        </template>
    </Suspense>
</template>

<style scoped>
</style>
