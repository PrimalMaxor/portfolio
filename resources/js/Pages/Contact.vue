<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '../Layouts/AppLayout.vue';
import { ref } from 'vue';
import { useLanguage } from '../composables/useLanguage.js';

const { t } = useLanguage();

const form = ref({
    name: '',
    email: '',
    phone: '',
    message: ''
});

const errors = ref({});
const isSubmitting = ref(false);
const isSubmitted = ref(false);

const validateForm = () => {
    errors.value = {};
    
    if (!form.value.name.trim()) {
        errors.value.name = t.value.contact.validation.nameRequired;
    }
    
    if (!form.value.email.trim()) {
        errors.value.email = t.value.contact.validation.emailRequired;
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.value.email)) {
        errors.value.email = t.value.contact.validation.emailInvalid;
    }
    
    if (!form.value.message.trim()) {
        errors.value.message = t.value.contact.validation.messageRequired;
    } else if (form.value.message.trim().length < 10) {
        errors.value.message = t.value.contact.validation.messageTooShort;
    }
    
    return Object.keys(errors.value).length === 0;
};

const handleSubmit = () => {
    if (validateForm()) {
        isSubmitting.value = true;
        
        // Simulate form submission (replace with actual endpoint later)
        setTimeout(() => {
            isSubmitting.value = false;
            isSubmitted.value = true;
            form.value = { name: '', email: '', phone: '', message: '' };
        }, 1000);
    }
};

const resetForm = () => {
    isSubmitted.value = false;
    errors.value = {};
};
</script>

<template>
    <Head title="Contact" />
    
    <AppLayout>
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    {{ t.contact.title }}
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    {{ t.contact.subtitle }}
                </p>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="p-8">
                    <div v-if="!isSubmitted" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ t.contact.form.name }} <span class="text-red-500">*</span>
                                </label>
                                <input
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    :class="[
                                        'w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200',
                                        errors.name 
                                            ? 'border-red-300 dark:border-red-600 bg-red-50 dark:bg-red-900/20' 
                                            : 'border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700'
                                    ]"
                                    :placeholder="errors.name || t.contact.form.namePlaceholder"
                                    @focus="errors.name = null"
                                />
                                <p v-if="errors.name" class="mt-1 text-sm text-red-600 dark:text-red-400">
                                    {{ errors.name }}
                                </p>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ t.contact.form.email }} <span class="text-red-500">*</span>
                                </label>
                                <input
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    :class="[
                                        'w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200',
                                        errors.email 
                                            ? 'border-red-300 dark:border-red-600 bg-red-50 dark:bg-red-900/20' 
                                            : 'border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700'
                                    ]"
                                    :placeholder="errors.email || t.contact.form.emailPlaceholder"
                                    @focus="errors.email = null"
                                />
                                <p v-if="errors.email" class="mt-1 text-sm text-red-600 dark:text-red-400">
                                    {{ errors.email }}
                                </p>
                            </div>
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ t.contact.form.phone }} <span class="text-gray-500 text-xs">({{ t.contact.form.optional }})</span>
                            </label>
                            <input
                                id="phone"
                                v-model="form.phone"
                                type="tel"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 bg-white dark:bg-gray-700"
                                :placeholder="t.contact.form.phonePlaceholder"
                            />
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ t.contact.form.message }} <span class="text-red-500">*</span>
                            </label>
                            <textarea
                                id="message"
                                v-model="form.message"
                                rows="6"
                                :class="[
                                    'w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 resize-none',
                                    errors.message 
                                        ? 'border-red-300 dark:border-red-600 bg-red-50 dark:bg-red-900/20' 
                                        : 'border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700'
                                ]"
                                :placeholder="errors.message || t.contact.form.messagePlaceholder"
                                @focus="errors.message = null"
                            ></textarea>
                            <p v-if="errors.message" class="mt-1 text-sm text-red-600 dark:text-red-400">
                                {{ errors.message }}
                            </p>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                {{ t.contact.form.minLength }}
                            </p>
                        </div>

                        <div class="pt-4">
                            <button
                                @click="handleSubmit"
                                :disabled="isSubmitting"
                                class="w-full bg-indigo-600 hover:bg-indigo-700 disabled:bg-indigo-400 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-not-allowed"
                            >
                                <span v-if="isSubmitting" class="flex items-center justify-center">
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    {{ t.contact.form.sending }}
                                </span>
                                <span v-else>{{ t.contact.form.sendMessage }}</span>
                            </button>
                        </div>
                    </div>

                    <div v-else class="text-center py-12">
                        <div class="w-16 h-16 bg-green-100 dark:bg-green-900/20 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                            {{ t.contact.success.title }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">
                            {{ t.contact.success.message }}
                        </p>
                        <button
                            @click="resetForm"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            {{ t.contact.success.sendAnother }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template> 