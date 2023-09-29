<script setup>
    import moment from "moment/moment";

    const props = defineProps(['certificates']);

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
        <div v-if="certificates.length" v-for="certificate in certificates" class="cell row">
            <div class="col"><span class="col__header">{{ columnNames['common_name'] }}</span><span class="col__content bold">{{ certificate.common_name }}</span></div>
            <div class="col"><span class="col__header">{{ columnNames['organization'] }}</span><span class="col__content">{{ certificate.organization }}</span></div>
            <div class="col"><span class="col__header">{{ columnNames['country_name'] }}</span><span class="col__content">{{ certificate.country_name }}</span></div>
            <div class="col"><span class="col__header">{{ columnNames['state_or_province_name'] }}</span><span class="col__content">{{ certificate.state_or_province_name }}</span></div>
            <div class="certificate-table__expire-col">
                <p><span
                    class="status" :class="{
                                'status--danger': certificate.has_expired,
                                'status--warning': certificate.expire_soon,
                             }"
                ></span> {{ moment(certificate.expires_on).format('DD MMMM YYYY') }}</p>
                <p>({{ Math.abs(moment(certificate.expires_on).diff(moment(), 'days')) }} {{ certificate.has_expired ? 'days ago' : 'days left' }})</p></div>
            <div class="certificate-table__actions"><router-link :to="{ name: 'certificates.show', params : { id: certificate.id } }"><i class="fa-solid fa-xl fa-magnifying-glass"></i></router-link></div>
        </div>
        <div v-else class="cell cell--empty row">
            <div class="muted">No certificates found.</div>
        </div>
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
