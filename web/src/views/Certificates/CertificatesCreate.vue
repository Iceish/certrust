<script setup>
import Container from "@/components/Container.vue";
import {useRoute} from "vue-router";
import TheBreadcrumb from "@/components/TheBreadcrumb.vue";
import MountedTeleport from "@/components/MountedTeleport.vue";
import {reactive} from "vue";
import axios from "axios";
import router from "@/router";

const route = useRoute();

const type = route.query.type;
const issuer = route.query.issuer;

let certificate = reactive({
    type: type,
    issuer: issuer,
    common_name: '',
    organization: '',
    organization_unit: '',
    country_name: '',
    state_or_province_name: '',
    locality_name: '',
    validity_days: '',
})

const sendForm = () => {
    axios.post('http://localhost/api/certificates/create',{
        ...certificate
    }).then((response) => {
        console.log(response);
    }).catch((error) => {
        console.log(error);
    })

    router.push({name: 'certificates.list'});
}
</script>

<template>
    <MountedTeleport to="#breadcrumb">
        <TheBreadcrumb category="certificates"
                       :title="'Creating a new ' + (type === '0' ? '\'Root authority\'' : type === '1' ? '\'Subordinate authority\'' : '\'End-user certificate\'')"
        />
    </MountedTeleport>

    <Container class="container--primary">
        <template #header>
            <h2><i class="fa-solid fa-lock"></i> New Certificate</h2>
        </template>
        <template #body>
            <p class="muted"><i class="fa-solid fa-circle-info"></i> You are creating a new certificate.</p>
        </template>
    </Container>

    <Container>
        <template #body>
            <form class="form" @submit.prevent="sendForm">
                <div class="form__field">
                    <label for="common_name">Common Name *</label>
                    <input required type="text" id="common_name" name="common_name" v-model="certificate.common_name"/>
                </div>
                <div class="form__field">
                    <label for="organization">Organization *</label>
                    <input required type="text" id="organization" name="organization" v-model="certificate.organization"/>
                </div>
                <div class="form__field">
                    <label for="organization_unit">Organization unit</label>
                    <input type="text" id="organization_unit" name="organization_unit" v-model="certificate.organization_unit"/>
                </div>
                <div class="form__field">
                    <label for="country_name">Country name *</label>
                    <input required type="text" id="country_name" name="country_name" v-model="certificate.country_name"/>
                </div>
                <div class="form__field">
                    <label for="state_or_province_name">State or province name</label>
                    <input type="text" id="state_or_province_name" name="state_or_province_name" v-model="certificate.state_or_province_name"/>
                </div>
                <div class="form__field">
                    <label for="locality_name">Locality name</label>
                    <input type="text" id="locality_name" name="locality_name" v-model="certificate.locality_name"/>
                </div>
                <div class="form__field">
                    <label for="validity_days">Validity days *</label>
                    <input required type="number" id="validity_days" name="validity_days" v-model="certificate.validity_days"/>
                </div>

                <button class="btn btn--primary" type="submit"><i class="fa-solid fa-paper-plane"></i> Submit</button>
            </form>
        </template>
    </Container>

</template>

<style scoped lang="scss">

</style>
