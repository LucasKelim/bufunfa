<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import Pagination from '@/components/Pagination.vue';
import Input from '@/components/ui/input/Input.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, rightButton } from '@/types';
import { Expense } from '@/types/Expense';
import { PaginationLinks } from '@/types/PaginationLinks';
import { Head, Link, router } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';

interface Props {
    expenses: {
        data: Expense[];
        links: PaginationLinks[];
    }
    search: string;
}

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Gastos',
        href: route('expenses.index')
    }
];

const createButton: rightButton = {
    text: 'Adicionar Gasto',
    href: route('expenses.create')
};

const search = ref(props.search);

const formattedExpenses = computed(() => {
    return props.expenses.data
        .map(expense => ({
            ...expense,
            formattedValue: new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            }).format(Number(expense.value)),
            formattedSalaryValue: new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            }).format(Number(expense.salary.value))
        }));
});

watch(search, (newValue) => {
    router.reload({
        only: ['expenses', 'search'],
        data: {
            search: newValue,
            page: 1
        }
    })
})
</script>

<template>

    <Head title="Gastos" />

    <AppLayout :breadcrumbs="breadcrumbs" :button="createButton">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div
                class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <div class="flex flex-col justify-center space-y-8 md:space-y-0 lg:flex-row lg:space-x-12 lg:space-y-0">
                    <div class="flex-1 md:max-w-2xl">
                        <section class="max-w-xl space-y-12">
                            <div class="px-4 py-6">
                                <div class="flex flex-col space-y-6">
                                    <Heading title="Lista de gastos">
                                        <template #html>
                                            <Input type="text" :ref="search" v-model="search"
                                                placeholder="Buscar gasto" />
                                        </template>
                                    </Heading>
                                    <ul v-if="props.expenses.data" role="list"
                                        class="divide-y divide-gray-100 min-h-136">
                                        <li v-for="expense in formattedExpenses" :key="expense.id"
                                            class="flex justify-between gap-x-6 py-5">
                                            <div class="flex min-w-0 gap-x-4">
                                                <div class="min-w-0 flex-auto">
                                                    <Link :href="route('expenses.show', { expense: expense.id })">
                                                    <p class="text-sm/6 font-semibold underline text-red-400">- {{
                                                        expense.formattedValue }}</p>
                                                    </Link>
                                                    <p class="mt-1 truncate text-xs/5">Categoria: {{ expense.category.name
                                                    }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                                <Link :href="route('salaries.show', { salary: expense.salary_id })">
                                                    <p class="text-sm/6 text-green-400 underline">R$ {{ expense.formattedSalaryValue }}</p>
                                                </Link>
                                            </div>
                                        </li>
                                    </ul>
                                    <h1 v-else class="text-center">Nenhum gasto adicionado</h1>
                                    <Pagination :links="props.expenses.links" />
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
