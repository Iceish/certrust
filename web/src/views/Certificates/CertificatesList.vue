<script setup>
    import Container from "@/components/Container.vue";
    import axios from 'axios';
    import {ref} from "vue";
    import moment from "moment";

    const rootAuthorities = ref([]);

    const getRootAuthorities = async () => {
        await axios.get('http://localhost/api/certificates').then(response => {
            rootAuthorities.value = response.data.data;
        });
    }

    await getRootAuthorities();
</script>

<template>
    <Container class="container--primary">
        <template #header>
            <i class="fa-solid fa-building-lock"></i> <p>Authorities</p>
        </template>
        <template #body>
            <p class="muted"><i class="fa-solid fa-circle-info"></i> A CA root, or Certificate Authority root, is the foundational entity in a public key infrastructure that issues and verifies digital certificates. </p>
        </template>
    </Container>

    <a href="#" class="btn btn--primary" style="align-self: start;">
        <i class="fa-regular fa-square-plus"></i> <p>New CA-Root</p>
    </a>

    <div class="grid-card">
        <Container v-for="rootAuthority in rootAuthorities">
            <template #body>
                <div class="card">
                    <div class="card__header">
                        <div>
                            <p class="card__title">{{ rootAuthority.common_name }}</p>
                            <p class="card__sub-title muted">{{ rootAuthority.organization }}, {{ rootAuthority.organization_unit }}, {{ rootAuthority.country_name }}, {{ rootAuthority.state_or_province_name }}, {{ rootAuthority.locality_name }}.</p>
                        </div>

                        <div class="card__actions">
                            <router-link :to="{ name: 'certificates.show', params : { id: rootAuthority.id } }"><i class="fa-solid fa-magnifying-glass"></i></router-link>
                        </div>
                    </div>

                    <div class="card__body">
                        <div class="numeric-info"><p>{{ 0 }}</p><p>Sub-CA</p></div>
                        <div class="numeric-info"><p>{{ 0 }}</p><p>Certificates</p></div>
                    </div>

                    <hr>

                    <div class="card__footer">
                        <div class="status"
                             :class="{
                                'status--danger': rootAuthority.has_expired,
                                'status--warning': false,
                             }"
                        ></div>
                        <p> {{ rootAuthority.has_expired ? 'Expired on' : 'Expire on' }} {{ moment(rootAuthority.expires_on).format('DD MMMM YYYY') }} <span class="muted">({{ Math.abs(moment(rootAuthority.expires_on).diff(moment(), 'days')) }} {{ rootAuthority.has_expired ? 'days ago' : 'days left' }})</span></p>
                    </div>
                </div>
            </template>
        </Container>
    </div>

</template>

<style scoped lang="scss">
    .card{
        display: flex;
        flex-direction: column;
        gap: var(--size-spacing-m);

        &__header{
            display: flex;
            flex-direction: row;
            justify-content: space-between;

            :nth-child(1){
                display: flex;
                flex-direction: column;
                gap: var(--size-spacing-xs);
            }
        }

        &__title{
            font-weight: var(--weight-font-bold);
        }

        &__body{
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            gap: var(--size-spacing-s);
        }

        hr{
            width: 100%;
            height: 1px;
            background-color: var(--clr-text-muted);
            opacity: 0.2;
            border: 0;
            margin: 0;
        }

        &__footer{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            text-transform: uppercase;
            font-size: 0.7rem!important;
            color: var(--clr-text-muted);

            gap: var(--size-spacing-s);
        }

        &__actions{
            font-size: 1.5rem;
            color: var(--clr-primary);
        }
    }

    .grid-card{
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: var(--size-spacing-m);
    }
</style>
