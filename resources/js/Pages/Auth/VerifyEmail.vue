<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { useLanguage } from '@/composables/useLanguage.js';
import { useTheme } from '@/composables/useTheme.js';

const { t } = useLanguage();
const { isDarkMode } = useTheme();

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(
    () => props.status === 'verification-link-sent',
);
</script>

<template>
    <GuestLayout>
        <Head :title="t.auth.verifyEmail.title" />

        <div class="space-y-8">
            <!-- Header -->
            <div class="text-center">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ t.auth.verifyEmail.title }}</h2>
                <p class="text-gray-600 dark:text-gray-300">{{ t.auth.verifyEmail.subtitle }}</p>
            </div>

            <div
                class="mb-4 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg"
                v-if="verificationLinkSent"
            >
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800 dark:text-green-200">
                            A new verification link has been sent to the email address you provided during registration.
                        </p>
                    </div>
                </div>
            </div>

            <form @submit.prevent="submit" class="space-y-6">
                <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0 sm:space-x-4">
                    <PrimaryButton
                        class="w-full sm:w-auto flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800 transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                        :class="{ 'opacity-50': form.processing }"
                        :disabled="form.processing"
                    >
                        <svg v-if="form.processing" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        {{ form.processing ? t.auth.verifyEmail.resending : t.auth.verifyEmail.resendVerification }}
                    </PrimaryButton>

                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        class="w-full sm:w-auto flex justify-center py-3 px-4 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800 transition-colors duration-200"
                    >
                        {{ t.auth.verifyEmail.logout }}
                    </Link>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>
