<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { useLanguage } from '@/composables/useLanguage.js';
import { useTheme } from '@/composables/useTheme.js';

const { t } = useLanguage();
const { isDarkMode } = useTheme();

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <GuestLayout>
        <Head :title="t.auth.confirmPassword.title" />

        <div class="space-y-8">
            <!-- Header -->
            <div class="text-center">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ t.auth.confirmPassword.title }}</h2>
                <p class="text-gray-600 dark:text-gray-300">{{ t.auth.confirmPassword.subtitle }}</p>
            </div>

            <form @submit.prevent="submit" class="space-y-6">
                <div>
                    <InputLabel for="password" :value="t.auth.confirmPassword.password" class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 block" />
                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                        autofocus
                        :placeholder="t.auth.confirmPassword.password"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div>
                    <PrimaryButton
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800 transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                        :class="{ 'opacity-50': form.processing }"
                        :disabled="form.processing"
                    >
                        <svg v-if="form.processing" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        {{ form.processing ? t.auth.confirmPassword.confirming : t.auth.confirmPassword.confirm }}
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>
