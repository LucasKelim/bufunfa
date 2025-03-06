<script setup lang="ts">
import { SidebarGroup, SidebarGroupLabel, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { User, type NavItem, type SharedData } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { Plus } from 'lucide-vue-next';
import UserInfo from './UserInfo.vue';

const props = defineProps<{
    items: NavItem[];
    usersOn?: User[];
}>();

const page = usePage<SharedData>();

const normalizePath = (url: string) => new URL(url, window.location.origin).pathname

props.items.forEach(item => {
    item.href = normalizePath(item.href);
});

</script>

<template>
    <SidebarGroup class="px-2 py-0">
        <SidebarGroupLabel>Páginas</SidebarGroupLabel>
        <SidebarMenu>
            <SidebarMenuItem v-for="item in items" :key="item.title" class="group/item">
                <SidebarMenuButton as-child :is-active="item.href === page.url">
                    <Link :href="item.href">
                        <component :is="item.icon" />
                        <span class="flex items-center w-full justify-between">
                            <span>{{ item.title }}</span>
                            <Link v-if="item.isActive && `${item.href}/create` != page.url" :href="route(`${item.href.replace('/', '')}.create`)" class="group/edit invisible group-hover/item:visible">
                                <component :is="Plus" class="group-hover/edit:scale-105" />
                            </Link>
                        </span>
                    </Link>
                </SidebarMenuButton>
            </SidebarMenuItem>
        </SidebarMenu>
    </SidebarGroup>
    <hr>
    <SidebarGroup v-if="usersOn" class="px-2 py-0">
        <SidebarGroupLabel>Online - {{ usersOn.length }}</SidebarGroupLabel>
        <SidebarMenu>
            <SidebarMenuItem v-for="user in usersOn" :key="user.id" class="group/item">
                <SidebarMenuButton size="lg" class="data-[state=open]:bg-sidebar-accent data-[state=open]:text-sidebar-accent-foreground">
                    <UserInfo :user="user" />
                </SidebarMenuButton>
            </SidebarMenuItem>
        </SidebarMenu>
    </SidebarGroup>
</template>
