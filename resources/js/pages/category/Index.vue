<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import Pagination from '@/components/Pagination.vue';
import Input from '@/components/ui/input/Input.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, rightButton } from '@/types';
import { Category } from '@/types/Category';
import { PaginationLinks } from '@/types/PaginationLinks';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

interface Props {
    categories: {
        data: Category[];
        links: PaginationLinks[];
    }
    search: string;
}

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Categorias',
        href: route('categories.index')
    }
];

const createButton: rightButton = {
    text: 'Adicionar Categoria',
    href: route('categories.create')
};

const search = ref(props.search);

watch(search, (newValue) => {
    router.reload({
        only: ['categories', 'search'],
        data: {
            search: newValue,
            page: 1
        }
    })
})
</script>

<template>
    <Head title="Categorias" />

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
                                            <Input type="text" :ref="search" v-model="search" />
                                        </template>
                                    </Heading>
                                    <ul v-if="props.categories.data" role="list" class="divide-y divide-gray-100 min-h-136">
                                        <li v-for="category in props.categories.data" :key="category.id"
                                            class="flex justify-between gap-x-6 py-5">
                                            <div class="flex min-w-0 gap-x-4">
                                                <div class="min-w-0 flex-auto">
                                                    <Link :href="route('categories.show', { category: category.id })">
                                                    <p class="text-sm/6 font-semibold underline">{{ category.name }}</p>
                                                    </Link>
                                                    <p class="mt-1 truncate text-xs/5">Usado {{ category.name }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <h1 v-else class="text-center">Nenhum salário adicionado</h1>
                                    <Pagination :links="props.categories.links" />
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
