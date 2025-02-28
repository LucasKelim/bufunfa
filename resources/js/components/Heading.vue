<script setup lang="ts">
import { Separator } from '@/components/ui/separator';
import { useSlots } from 'vue';

const slots = useSlots();

interface Props {
    title: string;
    description?: string;
}

defineProps<Props>();
</script>

<template>
    <div class="mb-2">
        <h2 class="text-xl font-semibold tracking-tight">{{ title }}</h2>
        <p v-if="description" class="text-sm text-muted-foreground">
            {{ description }}
        </p>
        <template v-if="slots.html">
            <div class="mt-2">
                <slot name="html" />
            </div>
        </template>
    </div>
    <Separator class="my-6" />
</template>
