<script setup lang="ts">
import Button from './ui/button/Button.vue';
import Input from './ui/input/Input.vue';
import { Search } from 'lucide-vue-next'

interface Props {
    placeholder?: string;
}

withDefaults(defineProps<Props>(), {
    placeholder: ''
});

</script>

<template>
    <Input type="text" :placeholder="placeholder"/>
    <Button variant="secondary" class="ms-2 hover:scale-105">
        <component :is="Search" />
        Pesquisar
    </Button>
</template>