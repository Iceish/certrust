<script setup>

import {useRoute} from "vue-router";

const route = useRoute()


const breadcrumbs = [
    { title : 'aze',
        url : 'https://google.com'
    },
    { title : 'qsd',
        url : 'https://google.fr'
    },
]

</script>

<template>
    <ol class="breadcrumb">
<!--        @foreach ($breadcrumbs as $breadcrumb)-->
        <template v-for="(item, index) of breadcrumbs">
            <li class="breadcrumb__item"><a :href="item.url">{{ item.title}}</a></li>
            <li class="breadcrumb__separator"><p>/</p></li>
        </template>
<!--        @if (!is_null($breadcrumb->url) && !$loop->last)-->

<!--        @else-->
<!--        <li class="breadcrumb__item active">Title</li>-->
<!--        @endif-->

<!--        @endforeach-->
    </ol>
</template>

<style scoped lang="scss">
.breadcrumb{
    display: flex;
    flex-direction: row;
    gap: var(--size-spacing-xs);
    flex-wrap: wrap;
    &__separator{
        color: var(--clr-text-muted);
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
    }
    &__item{
        color: var(--clr-text-muted);
        &.active{
            color: var(--clr-secondary);
        }
    }
}
</style>
