<script setup lang="ts">
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import { SidebarTrigger } from '@/components/ui/sidebar';
import type { BreadcrumbItemType, AppSidebarHeaderButton } from '@/types';
import Button from './ui/button/Button.vue';
import { Link } from '@inertiajs/vue3';

defineProps<{
    breadcrumbs?: BreadcrumbItemType[];
    button?: AppSidebarHeaderButton;
}>();

</script>

<template>
    <header
        class="flex justify-between h-16 shrink-0 items-center gap-2 border-b border-sidebar-border/70 px-6 transition-[width,height] ease-linear group-has-[[data-collapsible=icon]]/sidebar-wrapper:h-12 md:px-4"
    >
        <div class="flex items-center gap-2">
            <SidebarTrigger class="-ml-1" />
            <template v-if="breadcrumbs.length > 0">
                <Breadcrumbs :breadcrumbs="breadcrumbs" />
            </template>
        </div>
        <template v-if="button?.text != ''">
            <Link :href="button.href">
                <Button>{{ button.text }}</Button>
            </Link>
        </template>
    </header>
</template>
