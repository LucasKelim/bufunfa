<script setup lang="ts">
import { TransitionRoot } from '@headlessui/vue';
import { Head, useForm, usePage, Link } from '@inertiajs/vue3';

import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import InputMoney from '@/components/InputMoney.vue';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { SharedData, type BreadcrumbItem } from '@/types';
import { Salary } from '@/types/Salary';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Salários',
        href: route('salaries.index')
    },
    {
        title: 'Salário',
        href: '/salaries'
    }
];

const page = usePage<SharedData>();
const salary = page.props.salary as Salary;

const form = useForm({
    value: salary.value
});

const submit = () => {
    form.patch(route('salaries.update', { salary: salary.id }), {
        preserveScroll: true
    });
};

const destroy = () => {
    form.delete(route('salaries.destroy', { salary: salary.id }), {
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
                                    <form @submit.prevent="submit" class="space-y-6">
                                        <div class="grid gap-2">
                                            <Label for="name">Name</Label>
                                            <InputMoney id="value" v-model="form.value" />
                                            <InputError class="mt-2" :message="form.errors.value" />
                                        </div>

                                        <div class="flex items-center gap-4">
                                            <Button :disabled="form.processing">Salvar</Button>
                                            <Link :href="route('salaries.index')">
                                                <Button variant="outline">Voltar</Button>
                                            </Link>
                                            <Button :disabled="form.processing" variant="destructive" @click.prevent="destroy">Deletar</Button>

                                            <TransitionRoot :show="form.recentlySuccessful"
                                                enter="transition ease-in-out" enter-from="opacity-0"
                                                leave="transition ease-in-out" leave-to="opacity-0">
                                                <p class="text-sm text-neutral-600">Salvo.</p>
                                            </TransitionRoot>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>