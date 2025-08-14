<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        required: true,
    },
    value: {
        default: null,
    },
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>

<template>
    <input
        type="checkbox"
        :value="value"
        v-model="proxyChecked"
        class="rounded border-gray-300 dark:border-gray-600 text-blue-600 dark:text-blue-500 shadow-sm focus:ring-blue-500 dark:focus:ring-blue-400 focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800 bg-white dark:bg-gray-700 transition-colors duration-200"
    />
</template>
