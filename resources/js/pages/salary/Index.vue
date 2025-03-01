<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { rightButton, type BreadcrumbItem } from '@/types';
import { Salary } from '@/types/Salary';
import { Head, Link, router } from '@inertiajs/vue3';
import Heading from '@/components/Heading.vue';
import { computed, ref, watch } from 'vue';
import Input from '@/components/ui/input/Input.vue';
import Pagination from '@/components/Pagination.vue';
import { PaginationLinks } from '@/types/PaginationLinks';

interface Props {
    salaries: {
        data: Salary[];
        links: PaginationLinks[]
    };
    search: string;
}

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Salários',
        href: route('salaries.index')
    }
];

const createButton: rightButton = {
    text: 'Adicionar Salário',
    href: route('salaries.create')
}

const search = ref(props.search);

const formattedSalaries = computed(() => {
    return props.salaries.data
        .map(salary => ({
            ...salary,
            formattedValue: new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            }).format(Number(salary.value)),
            formattedCreatedAt: new Date(salary.created_at).toLocaleDateString('pt-BR', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit'
            })
        }));
});

watch(search, (newValue) => {
    router.reload({
        only: ['salaries', 'search'],
        data: {
            search: newValue,
            page: 1
        }
    });
});
</script>

<template>

    <Head title="Salários" />

    <AppLayout :breadcrumbs="breadcrumbs" :button="createButton">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div
                class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <div class="flex flex-col justify-center space-y-8 md:space-y-0 lg:flex-row lg:space-x-12 lg:space-y-0">
                    <div class="flex-1 md:max-w-2xl">
                        <section class="max-w-xl space-y-12">
                            <div class="px-4 py-6">
                                <div class="flex flex-col space-y-6">
                                    <Heading title="Lista de salários">
                                        <template #html>
                                            <Input type="text" :ref="search" v-model="search"
                                                placeholder="Buscar salário" />
                                        </template>
                                    </Heading>
                                    <ul v-if="salaries" role="list" class="divide-y divide-gray-100 min-h-136">
                                        <li v-for="salary in formattedSalaries" :key="salary.id"
                                            class="flex justify-between gap-x-6 py-5">
                                            <div class="flex min-w-0 gap-x-4">
                                                <div class="min-w-0 flex-auto">
                                                    <Link :href="route('salaries.show', { salary: salary.id })">
                                                    <p class="text-sm/6 font-semibold text-green-400 underline">+ {{
                                                        salary.formattedValue }}</p>
                                                    </Link>
                                                    <p class="mt-1 truncate text-xs/5">{{ salary.formattedCreatedAt }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                                <p class="text-sm/6 text-red-400">- R$ 1.231,18</p>
                                                <p class="mt-1 text-xs/5">R$ 150,31 </p>
                                            </div>
                                        </li>
                                    </ul>
                                    <h1 v-else class="text-center">Nenhum salário adicionado</h1>
                                    <Pagination :links="salaries.links" />
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>