<script setup>
    import Container from "@/components/Container.vue";

    const rootAuthorities = [
        {
            'common_name': 'Auth',
            'organization': 'Auth team',
            'organization_unit': 'Auth unit',
            'country_name': 'FR',
            'state_or_province_name': 'Tulles',
            'locality_name': 'Tulles',
            'expires_on': new Date('2026-10-2')
        },
        {
            'common_name': 'example.com',
            'organization': 'Example Inc.',
            'organization_unit': 'Example unit',
            'country_name': 'US',
            'state_or_province_name': 'California',
            'locality_name': 'calif',
            'expires_on': new Date('2024-12-31')
        },
        {
            'common_name': 'london.uk',
            'organization': 'london corp.',
            'organization_unit': 'London unit',
            'country_name': 'UK',
            'state_or_province_name': 'Somewhere',
            'locality_name': 'london',
            'expires_on': new Date('2023-11-13')
        },
    ]
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
                            <a href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
                        </div>
                    </div>

                    <div class="card__body">
                        <div class="numeric-info"><p>{{ 0 }}</p><p>Sub-CA</p></div>
                        <div class="numeric-info"><p>{{ 0 }}</p><p>Certificates</p></div>
                    </div>

                    <hr>

                    <div class="card__footer">
                        <div class="status {{ true ? 'status--danger' : ( true ? 'status--warning' : '')}}"></div>
                        <p> {{ true ? 'Expired on' : 'Expire on' }} {{ rootAuthority.expires_on.getDay() }} <span class="muted">({{ 'X' }} {{ true ? 'days ago' : 'days left' }})</span></p>
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
