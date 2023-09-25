import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '@/views/HomeView.vue';
import ManagementView from "@/views/ManagementView.vue";
import SettingsView from "@/views/SettingsView.vue";
import CertificateList from "@/views/Certificates/CertificatesList.vue";
import CertificatesShow from "@/views/Certificates/CertificatesShow.vue";
import CertificatesCreate from "@/views/Certificates/CertificatesCreate.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        // Home
        {
            path: '/',
            name: 'home',
            component: HomeView,
            meta: { layout: 'DashboardLayout' }
        },
        // Certificates
        {
            path: '/certificates',
            name: 'certificates',
            component: CertificateList,
            meta: { layout: 'DashboardLayout' }
        },
        {
            path: '/certificates/:id',
            name: 'certificates.show',
            component: CertificatesShow,
            meta: { layout: 'DashboardLayout' }
        },
        {
            path: '/certificates/create',
            name: 'certificates.create',
            component: CertificatesCreate,
            meta: { layout: 'DashboardLayout' }
        },
        // Management
        {
            path: '/management',
            name: 'management',
            component: ManagementView,
            meta: { layout: 'DashboardLayout' }
        },
        // Settings
        {
            path: '/settings',
            name: 'settings',
            component: SettingsView,
            meta: { layout: 'DashboardLayout' }
        },
    ]
})

export default router
