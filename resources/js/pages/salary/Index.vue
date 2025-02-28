<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { rightButton, type BreadcrumbItem } from '@/types';
import { Salary } from '@/types/Salary';
import { Head, Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';

interface Props {
    salaries: Salary[];
}

defineProps<Props>()

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Salários',
        href: '/salaries'
    }
];

const createButton: rightButton = {
    text: 'Adicionar Salário',
    href: route('salaries.create')
}
</script>

<template>
    <Head title="Salários" />

    <AppLayout :breadcrumbs="breadcrumbs" :button="createButton">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <div class="px-4 py-6">
                    <Link :href="route('salaries.create')">
                        <Button>Adicionar salário</Button>
                    </Link>
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="salary in salaries" :key="salary.id">
                                <td>
                                    <Link :href="route('salaries.show', { salary: salary.id })">
                                        {{ salary.id }}
                                    </Link>
                                </td>
                                <td>R$ {{ salary.value }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>