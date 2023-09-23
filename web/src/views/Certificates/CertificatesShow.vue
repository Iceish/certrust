<script setup>
import Container from "@/components/Container.vue";
import CertificateTable from "@/components/CertificateTable.vue";
import Pie from "@/components/Pie.vue";

const certificate = {
        'common_name': 'Auth',
        'organization': 'Auth team',
        'organization_unit': 'Auth unit',
        'country_name': 'FR',
        'state_or_province_name': 'Tulles',
        'locality_name': 'Tulles',
        'expires_on': new Date('2026-10-2')
    };
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
                    <Pie/>
                    <div class="expire__text">
                        <p>{{ certificate.expires_on.getDate() }}</p>
                        <p>({{ 0 }} days left)</p>
                    </div>
                </div>
            </template>
        </Container>

        <Container class="container--align-with-full-container">
            <template #body>
                <div class="certificate-panel__actions">
                    <a href="#" class="muted"><i class="fa-solid fa-file-lines"></i><p>Download certificate (.crt)</p></a>
                    <a href="#" class="muted"><i class="fa-solid fa-key"></i><p>Download private key (.key)</p></a>
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

<!--    @unless($certificate->type === \App\Enums\CertificateTypeEnum::CERT)-->

    <div class="certificate-issued-items">
        <Container class="container--secondary">
            <template #header>
                <i class="fa-solid fa-lock"></i> <p>Sub-CA</p>
            </template>
            <template #body>
                <a href="#" class="btn btn--primary">
                    <i class="fa-regular fa-square-plus"></i> <p>New</p>
                </a>
                <CertificateTable/>
            </template>
        </Container>

        <Container class="container--tertiary">
            <template #header>
                <i class="fa-solid fa-lock"></i> <p>End-user certificate</p>
            </template>
            <template #body>
                <a href="#" class="btn btn--primary">
                    <i class="fa-regular fa-square-plus"></i> <p>New</p>
                </a>
                <CertificateTable/>
            </template>
        </Container>
    </div>
<!--    @endunless-->
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
</style>