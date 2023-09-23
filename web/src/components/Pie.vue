<script setup>
import {computed} from "vue";

const props = defineProps(['title','percentComplete','colorComplete','colorIncomplete']);
    // $expire_diff = $certificate->expires_on->timestamp - $certificate->issued_on->timestamp;
    // $current_diff = time() - $certificate->issued_on->timestamp;
    // $percentage = (int) round( $current_diff / $expire_diff * 100 );

    const percentComplete = computed(() => {
        return props.percentComplete;
    })
    const colorComplete = computed(() => {
        return props.colorComplete;
    })
    const colorIncomplete = computed(() => {
        return props.colorIncomplete;
    })
</script>

<template>
    <div class="pie" :style="{
        '--p' : percentComplete,
        '--color-complete' : colorComplete,
        '--color-incomplete' : colorIncomplete
    }
    "><span>{{ title }}</span>
    </div>
</template>

<style scoped lang="scss">
    .pie {
        --pie-size: 100px;
        --p: 60;
        /* percentage to degree  */
        --v:calc( ((18/5) * var(--p) - 90)*1deg);
        --color-complete : var(--clr-primary);
        --color-incomplete : var(--clr-text-muted);

        position: relative;

        width: var(--pie-size);
        height: var(--pie-size);
        display:inline-block;
        border-radius:50%;
        background:
            linear-gradient(var(--v), var(--color-incomplete) 50%,transparent 0) 0 /min(100%,(50 - var(--p))*100%),
            linear-gradient(var(--v), transparent 50%, var(--color-complete) 0) 0 /min(100%,(var(--p) - 50)*100%),
            linear-gradient(to right, var(--color-incomplete) 50%,var(--color-complete) 0);

        span{
            width: calc(var(--pie-size) * 0.8);
            height: calc(var(--pie-size) * 0.8);
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background: var(--clr-background-accent);
            border-radius: 50%;

            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;

            font-size: 0.9rem;
            color: var(--clr-text-muted);
            text-transform: uppercase;
        }
    }
</style>
