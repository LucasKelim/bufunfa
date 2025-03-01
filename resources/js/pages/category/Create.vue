<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';

import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import Input from '@/components/ui/input/Input.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Categorias',
        href: route('categories.index')
    },
    {
        title: 'Adicionar',
        href: route('categories.create')
    }
];

const form = useForm({
    name: '',
});

const submit = () => {
    form.post(route('categories.store'), {
        preserveScroll: true
    });
};

</script>

<template>

    <Head title="Adicinar Categorias" />

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
                                            <Label for="name">Nome</Label>
                                            <Input v-model="form.name" placeholder="Nome da categoria" />
                                            <InputError class="mt-2" :message="form.errors.name" />
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
