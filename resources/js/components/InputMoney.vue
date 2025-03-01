<script setup lang="ts">
import { cn } from '@/lib/utils';
import { useVModel } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import Input from './ui/input/Input.vue';

const props = defineProps<{
    defaultValue?: string | number;
    modelValue?: string | number;
    class?: HTMLAttributes['class'];
    placeholder?: string;
}>();

const emits = defineEmits<{
    (e: 'update:modelValue', payload: string | number): void;
}>();

const modelValue = useVModel(props, 'modelValue', emits, {
    passive: true,
    defaultValue: props.defaultValue,
});
</script>

<template>
    <div>
        <div class="mt-2">
            <div
                class="flex h-10 items-center rounded-md border border-input bg-background pl-2 pr-1 py-2 ring-offset-background has-[input:focus-visible]:outline-none has-[input:focus-visible]:ring-2 has-[input:focus-visible]:ring-ring has-[input:focus-visible]:ring-offset-2">
                <div class="shrink-0 select-none text-base text-green-400 sm:text-sm/6">
                    R$
                </div>
                <Input 
                    type="text" 
                    v-model="modelValue"
                    maxlength="8"
                    minlength="8"
                    :placeholder="placeholder"
                    v-mask="'#.###,##'"
                    :class="cn('block min-w-0 grow border-0 py-1.5 pl-1 pr-3 text-base focus-visible:outline-none focus-visible:ring-0 focus-visible:ring-offset-0 h-9', props.class)" />
            </div>
        </div>
    </div>
</template>