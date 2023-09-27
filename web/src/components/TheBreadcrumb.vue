<script setup>
defineProps(['title', 'category']);

const categories = {
    'home' : {
        'title' : 'Dashboard',
        'routeName' : 'home',
    },
    'certificates' : {
        'title' : 'Certificates',
        'routeName' : 'certificates',
    },
    'management' : {
        'title' : 'Management',
        'routeName' : 'management',
    },
    'settings' : {
        'title' : 'Settings',
        'routeName' : 'settings',
    },
}

</script>

<template>
    <ol class="breadcrumb">
        <li class="breadcrumb__item"><p>Dashboard</p></li>
        <li class="breadcrumb__separator"><p>/</p></li>
        <li class="breadcrumb__item"><router-link :to="{ name : categories[category].routeName }">{{ categories[category].title }}</router-link></li>
        <template v-if="title">
            <li class="breadcrumb__separator"><p>/</p></li>
            <li class="breadcrumb__item"><p>{{ title }}</p></li>
        </template>
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
