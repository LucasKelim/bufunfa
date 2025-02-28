<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
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
    <AppLayout :breadcrumbs="breadcrumbs" :button="button">
        <slot />
    </AppLayout>
</template>
