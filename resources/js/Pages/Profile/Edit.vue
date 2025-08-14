<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import { useLanguage } from '@/composables/useLanguage.js';

const { t } = useLanguage();

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head :title="t.profile.title" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-800 rounded-xl flex items-center justify-center">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                        {{ t.profile.title }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300 mt-1">
                        {{ t.profile.accountSettings }}
                    </p>
                </div>
            </div>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-6xl">
                <div class="mb-12">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <div class="px-8 py-6 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border-b border-gray-200 dark:border-gray-700">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center">
                                <svg class="w-5 h-5 mr-3 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                {{ t.profile.profileInformation }}
                            </h2>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                                {{ t.profile.profileDescription }}
                            </p>
                        </div>
                        <div class="p-8">
                            <UpdateProfileInformationForm
                                :must-verify-email="mustVerifyEmail"
                                :status="status"
                            />
                        </div>
                    </div>
                </div>

                <div class="mb-12">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <div class="px-8 py-6 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border-b border-gray-200 dark:border-gray-700">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center">
                                <svg class="w-5 h-5 mr-3 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                {{ t.profile.updatePassword }}
                            </h2>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                                {{ t.profile.passwordDescription }}
                            </p>
                        </div>
                        <div class="p-8">
                            <UpdatePasswordForm />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
