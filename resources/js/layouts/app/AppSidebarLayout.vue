<script setup lang="ts">
import AppContent from '@/components/AppContent.vue';
import AppShell from '@/components/AppShell.vue';
import AppSidebar from '@/components/AppSidebar.vue';
import AppSidebarHeader from '@/components/AppSidebarHeader.vue';
import type { BreadcrumbItemType, AppSidebarHeaderButton } from '@/types';

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
        <AppSidebar />
        <AppContent variant="sidebar">
            <AppSidebarHeader :breadcrumbs="breadcrumbs" :button="button" />
            <slot />
        </AppContent>
    </AppShell>
</template>
