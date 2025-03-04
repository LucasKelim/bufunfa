<script setup lang="ts">
import { TransitionRoot } from '@headlessui/vue';
import { Head, useForm, Link, usePage } from '@inertiajs/vue3';

import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import InputMoney from '@/components/InputMoney.vue';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { User, type BreadcrumbItem } from '@/types';
import { Salary } from '@/types/Salary';
import Heading from '@/components/Heading.vue';
import { format } from 'v-money3';
import Pagination from '@/components/Pagination.vue';
import Select from '@/components/Select.vue';
import { Expense } from '@/types/Expense';
import { PaginationLinks } from '@/types/PaginationLinks';
import { Category } from '@/types/Category';
import { formatCurrency } from '@/composables/useFormat';
import { Minus, Equal } from 'lucide-vue-next';
import HeadingSmall from '@/components/HeadingSmall.vue';

const page = usePage();
const user = page.props.auth.user as User;

interface Props {
    salary: Salary;
    expenses: {
        data: Expense[];
        links: PaginationLinks[];
    }
    categories: Category[];
}

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Salários',
        href: route('salaries.index')
    },
    {
        title: 'Salário',
        href: route('salaries.show', { salary: props.salary.id })
    }
];

const salaryForm = useForm({
    value: props.salary.value
});

const expenseForm = useForm({
    salary_id: props.salary.id,
    category_id: 1,
    value: ''
});

const submitSalary = () => {
    salaryForm.value = format(salaryForm.value);
    salaryForm.patch(route('salaries.update', { salary: props.salary.id }), {
        preserveScroll: true
    });
};

const destroy = () => {
    salaryForm.delete(route('salaries.destroy', { salary: props.salary.id }), {
        preserveScroll: true
    });
};

const submitExpense = () => {
    expenseForm.value = format(expenseForm.value);
    expenseForm.post(route('expenses.store'), {
        preserveScroll: true
    });
};
</script>

<template>

    <Head title="Salários" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div
                class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <div class="flex flex-col justify-center space-y-8 md:space-y-0 lg:flex-row lg:space-x-12 lg:space-y-0">
                    <div class="flex-1 md:max-w-2xl">
                        <section class="max-w-xl space-y-12">
                            <div class="px-4 py-6">
                                <div class="flex flex-col space-y-6">
                                    <form @submit.prevent="submitSalary" class="space-y-6">
                                        <div class="grid grid-rows-2 grid-cols-11 gap-2">
                                            <div class="row-span-2 col-span-3">
                                                <Label for="value">Salário total</Label>
                                                <InputMoney id="value" v-model="salaryForm.value"
                                                    class="text-green-400" :disabled="user.id != salary.user_id" />
                                                <InputError class="mt-2" :message="salaryForm.errors.value" />
                                            </div>
                                            <div class="row-span-2 flex items-end px-3 py-2">
                                                <component :is="Minus" />
                                            </div>
                                            <div class="row-span-2 col-span-3">
                                                <Label for="total_expenses">Gastos totais</Label>
                                                <InputMoney id="total_expenses"
                                                    :modelValue="props.salary.total_expenses"
                                                    class="text-red-400" :disabled="true" />
                                                <InputError class="mt-2" :message="salaryForm.errors.value" />
                                            </div>
                                            <div class="row-span-2 flex items-end px-3 py-2">
                                                <component :is="Equal" />
                                            </div>
                                            <div class="row-span-2 col-span-3">
                                                <Label for="name">Resultado</Label>
                                                <InputMoney
                                                    :modelValue="props.salary.remaining_salary.toFixed(2)"
                                                    class="text-green-400" :disabled="true" />
                                                <InputError class="mt-2" :message="salaryForm.errors.value" />
                                            </div>
                                        </div>

                                        <div v-if="user.id == salary.user_id" class="flex items-center gap-4">
                                            <Button :disabled="salaryForm.processing">Salvar</Button>
                                            <Link :href="route('salaries.index')">
                                            <Button variant="outline">Voltar</Button>
                                            </Link>
                                            <Button :disabled="salaryForm.processing" variant="destructive"
                                                @click.prevent="destroy">Deletar</Button>

                                            <TransitionRoot :show="salaryForm.recentlySuccessful"
                                                enter="transition ease-in-out" enter-from="opacity-0"
                                                leave="transition ease-in-out" leave-to="opacity-0">
                                                <p class="text-sm text-neutral-600">Salvo.</p>
                                            </TransitionRoot>
                                        </div>
                                        <div v-else>
                                            <Link :href="route('salaries.index')">
                                            <Button variant="outline">Voltar</Button>
                                            </Link>
                                        </div>
                                    </form>
                                    <div v-if="user.id == salary.user_id">
                                        <Heading title="Adicionar gasto" />
                                        <form @submit.prevent="submitExpense" class="space-y-6">
                                            <div class="flex gap-2">
                                                <div class="basis-1/2 flex flex-col gap-2">
                                                    <Label for="value">Valor do gasto</Label>
                                                    <InputMoney id="value" v-model="expenseForm.value"
                                                        class="text-red-400" />
                                                    <InputError class="mt-2" :message="expenseForm.errors.value" />
                                                </div>
                                                <div class="basis-1/2 flex flex-col gap-2">
                                                    <Label for="category_id">Categoria</Label>
                                                    <Select id="category_id" name="category_id"
                                                        v-model="expenseForm.category_id">
                                                        <option v-for="category in props.categories" :key="category.id"
                                                            :value="category.id">{{ category.name }}</option>
                                                    </Select>
                                                    <InputError class="mt-2" :message="expenseForm.errors.category_id" />
                                                </div>
                                            </div>
    
                                            <div class="flex items-center gap-4">
                                                <Button :disabled="expenseForm.processing">Adicionar</Button>
    
                                                <TransitionRoot :show="expenseForm.recentlySuccessful"
                                                    enter="transition ease-in-out" enter-from="opacity-0"
                                                    leave="transition ease-in-out" leave-to="opacity-0">
                                                    <p class="text-sm text-neutral-600">Salvo.</p>
                                                </TransitionRoot>
                                            </div>
                                        </form>
                                    </div>

                                    <HeadingSmall v-if="props.expenses" title="Lista de gastos" />
                                    <ul v-if="props.expenses" role="list" class="divide-y divide-gray-100 min-h-136">
                                        <li v-for="expense in props.expenses.data" :key="expense.id"
                                            class="flex justify-between gap-x-6 py-5">
                                            <div class="flex min-w-0 gap-x-4">
                                                <div class="min-w-0 flex-auto">
                                                    <Link :href="route('expenses.show', { expense: expense.id })">
                                                    <p class="text-sm/6 font-semibold underline text-red-400">-
                                                        {{ formatCurrency(expense.value, 'BRL') }}</p>
                                                    </Link>
                                                    <p class="mt-1 truncate text-xs/5">Categoria: {{
                                                        expense.category.name
                                                    }}
                                                    </p>
                                                </div>
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