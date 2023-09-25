<script setup>
import { useRouter, RouterView} from "vue-router";
import {provide, Suspense, shallowRef} from "vue";
import layouts from "@/router/layouts";

const router = useRouter();
let layout = shallowRef('div')

router.afterEach((to) => {
    layout.value = layouts[to.meta.layout] || 'div';
})

provide('app:layout', layout);

</script>

<template>
    <Suspense>
        <template #default>
            <component :is="layout || 'div'">
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
