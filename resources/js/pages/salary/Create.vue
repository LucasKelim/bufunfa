<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';

import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import InputMoney from '@/components/InputMoney.vue';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { format } from 'v-money3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Salários',
        href: route('salaries.index')
    },
    {
        title: 'Adicionar',
        href: route('salaries.create')
    }
];

const form = useForm({
    value: '',
});

const submit = () => {
    form.value = format(form.value)
    form.post(route('salaries.store'), {
        preserveScroll: true
    });
};

</script>

<template>

    <Head title="Adicinar Salário" />

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
                                            <Label for="value">Valor</Label>
                                            <InputMoney id="value" v-model="form.value" placeholder="Valor do salário" class="text-green-400" />
                                            <InputError class="mt-2" :message="form.errors.value" />
                                        </div>
    
                                        <div class="flex items-center gap-4">
                                            <Button :disabled="form.processing">Salvar</Button>
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
