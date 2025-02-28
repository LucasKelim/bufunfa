<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
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
]
</script>

<template>
    <Head title="Salários" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
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
                            <td>{{ salary.id }}</td>
                            <td>R$ {{ salary.value }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>