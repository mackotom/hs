<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue', 'options', 'placeholder']);

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <select
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    >

        <option value="placeholder" v-if="placeholder" disabled hidden>{{ placeholder }}</option>

        <option v-for="option in options" :value="option.value">
            {{ option.label }}
        </option>
    </select>
</template>
