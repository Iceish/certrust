<script setup>
    const certificates = [
        {
            'common_name': 'Auth',
            'organization': 'Auth team',
            'country_name': 'FR',
            'state_or_province_name': 'Tulles',
            'expires_on': new Date('2026-10-2')
        },
        {
            'common_name': 'example.com',
            'organization': 'Example Inc.',
            'country_name': 'US',
            'state_or_province_name': 'California',
            'expires_on': new Date('2024-12-31')
        },
        {
            'common_name': 'london.uk',
            'organization': 'london corp.',
            'country_name': 'UK',
            'state_or_province_name': 'Somewhere',
            'expires_on': new Date('2023-11-13')
        },
    ]
    const columnNames = {
        'common_name': 'Common name',
        'organization': 'Organization',
        'country_name': 'Country name',
        'state_or_province_name': 'State or province name',
    }
</script>

<template>
    <div class="table certificate-table">
        <div class="cell header">
            <div>{{ columnNames['common_name'] }}</div>
            <div>{{ columnNames['organization'] }}</div>
            <div>{{ columnNames['country_name'] }}</div>
            <div>{{ columnNames['state_or_province_name'] }}</div>
            <div>Expires on</div>
            <div></div>
        </div>
        <div v-for="certificate in certificates" class="cell row">
            <div class="col"><span class="col__header">{{ columnNames['common_name'] }}</span><span class="col__content bold">{{ certificate.common_name }}</span></div>
            <div class="col"><span class="col__header">{{ columnNames['organization'] }}</span><span class="col__content">{{ certificate.organization }}</span></div>
            <div class="col"><span class="col__header">{{ columnNames['country_name'] }}</span><span class="col__content">{{ certificate.country_name }}</span></div>
            <div class="col"><span class="col__header">{{ columnNames['state_or_province_name'] }}</span><span class="col__content">{{ certificate.state_or_province_name }}</span></div>
            <div class="certificate-table__expire-col">
                <p><span class="status {{ true ? 'status--danger' : (true ? 'status--warning' : '')}}"></span> {{ certificate.expires_on.getDate() }}</p>
                <p>(X days left)</p></div>
            <div class="certificate-table__actions"><a href="#"><i class="fa-solid fa-xl fa-magnifying-glass"></i></a></div>
        </div>
<!--        <div class="cell cell&#45;&#45;empty row">-->
<!--            <div class="muted">No certificates found.</div>-->
<!--        </div>-->
    </div>
</template>

<style scoped lang="scss">
    .certificate-table{
        &__actions{
            display: flex;
            flex-direction: row;
            justify-content: center;
            gap: var(--size-spacing-s);
            align-items: center;

            color: var(--clr-primary);
        }

        .cell{
            @include media('>medium'){
                grid-template-columns: repeat(5, 1fr) 20px;
            }

            &--empty{
                grid-template-columns: 1fr;
                justify-items: center;
            }
        }

        &__expire-col{
            :nth-child(2){
                font-size: 0.7rem;
                color: var(--clr-text-muted);
            }
        }
    }
</style>
