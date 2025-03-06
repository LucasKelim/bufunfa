<script setup lang="ts">
import AppContent from '@/components/AppContent.vue';
import AppShell from '@/components/AppShell.vue';
import AppSidebar from '@/components/AppSidebar.vue';
import AppSidebarHeader from '@/components/AppSidebarHeader.vue';
import type { BreadcrumbItemType, AppSidebarHeaderButton } from '@/types';
import { usePresenceStore } from '@/stores/presence';

const usersOn = usePresenceStore();

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
    button?: AppSidebarHeaderButton;
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
    button: () => ({
        text: '',
        href: ''
    })
});

</script>

<template>
    <AppShell variant="sidebar">
        <AppSidebar :users-on="usersOn.users" />
        <AppContent variant="sidebar">
            <AppSidebarHeader :breadcrumbs="breadcrumbs" :button="button" />
            <slot />
        </AppContent>
    </AppShell>
</template>
