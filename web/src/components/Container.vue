<script setup>
    import {useSlots} from "vue";

    const slots = useSlots()
    const hasSlot = (name) =>{
        return !!slots[name];
    }
</script>

<template>
    <div class="container">
        <div v-if="hasSlot('header')" class="container__header">
            <h2><slot name="header"></slot></h2>
        </div>

        <div class="container__body">
            <slot name="body"></slot>
        </div>
    </div>
</template>

<style scoped lang="scss">
    .container{
        $header-height: 50px;
        position: relative;
        display: flex;
        width: 100%;

        &--primary > &__header{
            background-color: var(--clr-primary);
        }
        &--secondary > &__header{
            background-color: var(--clr-secondary);
        }
        &--tertiary > &__header{
            background-color: var(--clr-text-muted);
        }

        &--align-with-full-container > &__body{
            margin-top: calc($header-height / 2);
        }

        &__header{
            position: absolute;
            top: 0;
            left: 25px;

            height: $header-height;

            display: inline-flex;
            flex-direction: row;
            justify-content: start;
            align-items: center;
            padding: var(--size-spacing-s) var(--size-spacing-l);



            border-radius: 15px;
            color: var(--clr-text-on-primary);
            font-weight: 700;

            h2{
                display: inline-flex;
                flex-direction: row;
                gap: var(--size-spacing-s);
            }

            // This trick is here for allowing use of the container without a header.
            & + .container__body{
                margin-top: calc($header-height / 2);
                padding-top: calc($header-height/2 + 24px);
            }
        }
        &__body{
            width: 100%;
            overflow-x: hidden;
            padding: var(--size-spacing-m);
            background-color: var(--clr-background-accent);
            border-radius: 15px;
            box-shadow:0 4px 6px -1px rgba(0,0,0,.1), 0 2px 4px -1px rgba(0,0,0,.06);
        }
    }
</style>

