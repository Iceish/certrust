<script setup>
import Container from "@/components/Container.vue";
import {useRoute} from "vue-router";
import TheBreadcrumb from "@/components/TheBreadcrumb.vue";

const route = useRoute();

const type = route.query.type;
const issuer = route.query.issuer;

</script>

<template>
    <Teleport to="#breadcrumb">
        <TheBreadcrumb category="certificates"
                       :title="'Creating a new ' + (type === '0' ? '\'Root authority\'' : type === '1' ? '\'Subordinate authority\'' : '\'End-user certificate\'')"
        />
    </Teleport>

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
            <form class="form" action="http://localhost/api/certificates/create" method="POST">
                <input type="hidden" name="type" :value="type">
                <input v-if="issuer" type="hidden" name="issuer" :value="issuer">

                <div class="form__field">
                    <label for="common_name">Common Name *</label>
                    <input required type="text" id="common_name" name="common_name"/>
                </div>
                <div class="form__field">
                    <label for="organization">Organization *</label>
                    <input required type="text" id="organization" name="organization"/>
                </div>
                <div class="form__field">
                    <label for="organization_unit">Organization unit</label>
                    <input type="text" id="organization_unit" name="organization_unit"/>
                </div>
                <div class="form__field">
                    <label for="country_name">Country name *</label>
                    <input required type="text" id="country_name" name="country_name"/>
                </div>
                <div class="form__field">
                    <label for="state_or_province_name">State or province name</label>
                    <input type="text" id="state_or_province_name" name="state_or_province_name"/>
                </div>
                <div class="form__field">
                    <label for="locality_name">Locality name</label>
                    <input type="text" id="locality_name" name="locality_name"/>
                </div>
                <div class="form__field">
                    <label for="validity_days">Validity days *</label>
                    <input required type="number" id="validity_days" name="validity_days"/>
                </div>


                <button onclick="this.form.submit()" class="btn btn--primary" type="submit"><i class="fa-solid fa-paper-plane"></i> Submit</button>
            </form>
        </template>
    </Container>

</template>

<style scoped lang="scss">

</style>
