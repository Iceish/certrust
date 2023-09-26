<script setup>
import Container from "@/components/Container.vue";
import CertificateTable from "@/components/CertificateTable.vue";
import Pie from "@/components/Pie.vue";

import axios from 'axios';
import {ref} from "vue";
import {useRoute} from "vue-router";
import moment from "moment";

const route = useRoute();
const certificate = ref({});

const getCertificate = async () => {
    await axios.get('http://localhost/api/certificates/' + route.params.id + '?include=certificates').then(response => {
        certificate.value = response.data.data;
    });
}

await getCertificate();

let days_to_expire = moment(certificate.value.expires_on).diff(moment(certificate.value.issued_on), 'days');
let days_left = moment(certificate.value.expires_on).diff(moment(), 'days');
certificate.value.expire_percentage = 100-Math.ceil(days_left*100/days_to_expire);

console.log(certificate.value.certificates);
</script>

<template>
    <div class="certificate-panel">
        <Container class="container--primary">
            <template #header>
                <i class="fa-solid fa-lock"></i> <p>{{ certificate.common_name }}</p>
            </template>
            <template #body>
                <div class="certificate-panel__detailed">
                    <div class="certificate-panel__infos">
                        <div class="labeled-list">
                            <ul>
                                <li>
                                    <div>Common name</div>
                                    <div>{{ certificate.common_name }}</div>
                                </li>
                                <li>
                                    <div>Organization</div>
                                    <div>{{ certificate.organization }}</div>
                                </li>
                                <li>
                                    <div>Organization unit</div>
                                    <div>{{ certificate.organization_unit }}</div>
                                </li>
                                <li>
                                    <div>Country name</div>
                                    <div>{{ certificate.country_name }}</div>
                                </li>
                                <li>
                                    <div>State or province name</div>
                                    <div>{{ certificate.state_or_province_name }}</div>
                                </li>
                                <li>
                                    <div>Locality name</div>
                                    <div>{{ certificate.locality_name }}</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </template>
        </Container>

        <Container class="container--align-with-full-container">
            <template #body>
                <div class="certificate-panel__expire">
                    <Pie
                        title="Expire time"
                        :percent-complete=certificate.expire_percentage
                        :color-complete="certificate.has_expired ? 'var(--clr-danger)' : 'var(--clr-text-muted)'"
                        :color-incomplete="certificate.has_expired ? 'var(--clr-danger)' : (true ? 'var(--clr-warning)' : 'var(--clr-success)')"
                    />
                    <div class="expire__text">
                        <p>{{ moment(certificate.expires_on).format('DD MMMM YYYY') }}</p>
                        <p>({{ moment(certificate.expires_on).diff(moment(), 'days') }} days left)</p>
                    </div>
                </div>
            </template>
        </Container>

        <Container class="container--align-with-full-container">
            <template #body>
                <div class="certificate-panel__actions">
                    <a :href="'http://localhost/api/certificates/' + certificate.id + '/download/public_key'" class="muted"><i class="fa-solid fa-file-lines"></i><p>Download certificate (.crt)</p></a>
                    <a :href="'http://localhost/api/certificates/' + certificate.id + '/download/private_key'" class="muted"><i class="fa-solid fa-key"></i><p>Download private key (.key)</p></a>
                    <p class="danger" style="cursor: pointer;" ><i class="fa-solid fa-trash"></i> Delete</p>
                </div>
            </template>
        </Container>
    </div>

    <Container>
        <template #body>
            <div class="certificate-breadcrumb">
                <i class="fa-solid fa-building-lock certificate-breadcrumb__item"></i>
                <!--                @foreach($paths as $path)-->
                <a href="#" class="certificate-breadcrumb__item">{{ 'x' }}</a>
                <!--                @if (!$loop->last) <span><i class="certificate-breadcrumb__item fa-solid fa-arrow-right"></i></span> @endif-->
                <!--                @endforeach-->
            </div>
        </template>
    </Container>

        <div v-if="certificate.type !== 2" class="certificate-issued-items">
            <Container class="container--secondary">
                <template #header>
                    <i class="fa-solid fa-lock"></i> <p>Sub-CA</p>
                </template>
                <template #body>
                    <router-link :to="{ name : 'certificates.create'}" class="btn btn--primary">
                        <i class="fa-regular fa-square-plus"></i> <p>New</p>
                    </router-link>
                    <CertificateTable
                        :certificates="
                          certificate.certificates.filter(c => {
                            if(c.type === 1){
                                return c;
                            }
                          })"
                    />
                </template>
            </Container>

            <Container class="container--tertiary">
                <template #header>
                    <i class="fa-solid fa-lock"></i> <p>End-user certificate</p>
                </template>
                <template #body>
                    <router-link :to="{ name : 'certificates.create'}" class="btn btn--primary">
                        <i class="fa-regular fa-square-plus"></i> <p>New</p>
                    </router-link>
                    <CertificateTable
                        :certificates="
                        certificate.certificates.filter(c => {
                          if(c.type === 2){
                              return c;
                          }
                        })"
                    />
                </template>
            </Container>
        </div>

</template>

<style scoped lang="scss">
.certificate-panel{
    display: grid;
    grid-template-columns: 1fr;
    gap: var(--size-spacing-m);

    @include media('>medium'){
        grid-template-columns: 1fr auto auto;
    }

    &__detailed{
        display: flex;
        flex-direction: column;
        gap: var(--size-spacing-xl);

    }

    &__actions{
        height: 100%;
        display: flex;
        flex-direction: column;
        gap: var(--size-spacing-s);
        justify-content: space-around;

        padding: 0 var(--size-spacing-m);

        a{
            display: grid;
            grid-template-columns: 20px 1fr;
        }
    }
    &__expire{
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: var(--size-spacing-s);

        .expire__text{
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: var(--size-spacing-xs);
            :nth-child(2){
                font-size: 0.7rem;
                color: var(--clr-text-muted);

            }
        }
    }

}


.certificate-issued-items{
    display: grid;
    gap: var(--size-spacing-m);
    grid-template-columns: 1fr;


    @include media('>large'){
        grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
    }
}

.certificate-breadcrumb{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;

    &__item{
        color: var(--clr-text-muted);
        font-size: 0.9rem;
        padding: var(--size-spacing-s);
    }
}
.labeled-list{
    ul{
        display: inline-grid;
        grid-gap: var(--size-spacing-l);
        grid-template-columns: repeat(1,auto);
        @include media(">small"){
            grid-template-columns: repeat(2,auto);
        }
        @include media(">medium"){
            grid-template-columns: repeat(3,auto);
        }
    }

    li{
        display: inline-flex;
        flex-direction: column;
        gap: var(--size-spacing-xs);

        div:nth-child(1){
            color: var(--clr-text-muted);
            font-size: 0.7em;
            text-transform: uppercase;
        }
    }
}

</style>
