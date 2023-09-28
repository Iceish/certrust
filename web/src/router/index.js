import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '@/views/HomeView.vue';
import ManagementView from "@/views/ManagementView.vue";
import SettingsView from "@/views/SettingsView.vue";
import CertificateList from "@/views/Certificates/CertificatesList.vue";
import CertificatesShow from "@/views/Certificates/CertificatesShow.vue";
import CertificatesCreate from "@/views/Certificates/CertificatesCreate.vue";
import DashboardLayout from "@/components/layouts/DashboardLayout.vue";


const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        // Home
        {
            path: '/',
            component: DashboardLayout,
            children: [
                {
                    path: '',
                    name: 'home',
                    component: HomeView,
                }
            ],
        },
        // Certificates
        {
            path: '/certificates',
            component: DashboardLayout,
            children: [
                {
                    path: '',
                    name: 'certificates.list',
                    component: CertificateList,
                },
                {
                    path: ':id',
                    name: 'certificates.show',
                    component: CertificatesShow,
                },
                {
                    path: 'create',
                    name: 'certificates.create',
                    component: CertificatesCreate,
                }
            ]
        },
        // Management
        {
            path: '/management',
            component: DashboardLayout,
            children: [
                {
                    path: '',
                    name: 'management',
                    component: ManagementView,
                }
            ],
        },
        // Settings
        {
            path: '/settings',
            component: DashboardLayout,
            children: [
                {
                    path: '',
                    name: 'settings',
                    component: SettingsView,
                }
            ],
        },
    ]
})

export default router
