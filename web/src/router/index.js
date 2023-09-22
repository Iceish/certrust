import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
import DashboardLayout from "@/components/layouts/DashboardLayout.vue";
import CertificateView from "@/views/CertificateView.vue";
import ManagementView from "@/views/ManagementView.vue";
import SettingsView from "@/views/SettingsView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      meta: { layout: DashboardLayout }
    },
    {
      path: '/certificates',
      name: 'certificates',
      component: CertificateView,
      meta: { layout: DashboardLayout }
    },
    {
      path: '/management',
      name: 'management',
      component: ManagementView,
      meta: { layout: DashboardLayout }
    },
    {
      path: '/settings',
      name: 'settings',
      component: SettingsView,
      meta: { layout: DashboardLayout }
    },
  ]
})

export default router
