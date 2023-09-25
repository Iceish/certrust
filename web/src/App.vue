<script setup>
import { useRouter, RouterView} from "vue-router";
import {provide, Suspense, shallowRef} from "vue";
import layouts from "@/router/layouts";

const router = useRouter();
let layout = shallowRef(null)

router.afterEach((to) => {
    layout.value = layouts[to.meta.layout] || 'div';
})

provide('app:layout', layout);

</script>

<template>
    <Suspense>
        <template #default>
            <div>
              <component :is="layout">
                <RouterView />
              </component>
            </div>
        </template>
        <template #fallback>
            <div>loading..</div>
        </template>
    </Suspense>
</template>

<style scoped>
</style>
