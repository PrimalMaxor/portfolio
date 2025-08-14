<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
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

const user = usePage().props.auth.user;

const form = useForm({
    first_name: user.first_name,
    middle_name: user.middle_name,
    last_name: user.last_name,
    phone_number: user.phone_number,
    email: user.email,
});
</script>

<template>
    <section>
        <form
            @submit.prevent="form.patch(route('profile.update'))"
            class="space-y-8"
        >
            <div class="space-y-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <InputLabel for="first_name" :value="t.profile.firstName" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                        <TextInput
                            id="first_name"
                            type="text"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500"
                            v-model="form.first_name"
                            required
                            autofocus
                            autocomplete="given-name"
                        />
                        <InputError class="mt-1" :message="form.errors.first_name" />
                    </div>

                    <div class="space-y-2">
                        <InputLabel for="middle_name" :value="t.profile.middleName" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                        <TextInput
                            id="middle_name"
                            type="text"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500"
                            v-model="form.middle_name"
                            autocomplete="additional-name"
                        />
                        <InputError class="mt-1" :message="form.errors.middle_name" />
                    </div>

                    <div class="space-y-2">
                        <InputLabel for="last_name" :value="t.profile.lastName" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                        <TextInput
                            id="last_name"
                            type="text"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500"
                            v-model="form.last_name"
                            required
                            autocomplete="family-name"
                        />
                        <InputError class="mt-1" :message="form.errors.last_name" />
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                        {{ t.profile.contactInformation }}
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{ t.profile.contactInformationDesc }}
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <InputLabel for="email" :value="t.profile.email" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                        <div class="relative">
                            <TextInput
                                id="email"
                                type="email"
                                class="w-full px-4 py-3 pl-12 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500"
                                v-model="form.email"
                                required
                                autocomplete="username"
                            />
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m6.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                        </div>
                        <InputError class="mt-1" :message="form.errors.email" />
                    </div>

                    <div class="space-y-2">
                        <InputLabel for="phone_number" :value="t.profile.phoneNumber" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                        <div class="relative">
                            <TextInput
                                id="phone_number"
                                type="tel"
                                class="w-full px-4 py-3 pl-12 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500"
                                v-model="form.phone_number"
                                autocomplete="tel"
                            />
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                        </div>
                        <InputError class="mt-1" :message="form.errors.phone_number" />
                    </div>
                </div>
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null" class="bg-gradient-to-r from-yellow-50 to-amber-50 dark:from-yellow-900/20 dark:to-amber-900/20 border border-yellow-200 dark:border-yellow-800 rounded-xl p-6">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-medium text-yellow-800 dark:text-yellow-200 mb-2">
                            {{ t.profile.emailVerificationRequired }}
                        </h4>
                        <p class="text-sm text-yellow-700 dark:text-yellow-300 mb-3">
                            {{ t.profile.emailUnverified }}
                        </p>
                        <Link
                            :href="route('verification.send')"
                            method="post"
                            as="button"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-yellow-800 dark:text-yellow-200 bg-yellow-100 dark:bg-yellow-900/30 border border-yellow-300 dark:border-yellow-700 rounded-lg hover:bg-yellow-200 dark:hover:bg-yellow-900/50 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors duration-200"
                        >
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            {{ t.profile.resendVerification }}
                        </Link>
                    </div>
                </div>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-4 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg"
                >
                    <div class="flex items-center space-x-2">
                        <svg class="h-5 w-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-sm font-medium text-green-800 dark:text-green-200">
                            {{ t.profile.verificationLinkSent }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    {{ t.profile.changesSavedInfo }}
                </div>
                
                <div class="flex items-center space-x-4">
                    <Transition
                        enter-active-class="transition ease-in-out"
                        enter-from-class="opacity-0"
                        leave-active-class="transition ease-in-out"
                        leave-to-class="opacity-0"
                    >
                        <div
                            v-if="form.recentlySuccessful"
                            class="flex items-center space-x-2 text-sm text-green-600 dark:text-green-400 font-medium"
                        >
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ t.profile.saved }}</span>
                        </div>
                    </Transition>

                    <PrimaryButton 
                        :disabled="form.processing"
                        class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 dark:from-blue-500 dark:to-indigo-500 dark:hover:from-blue-600 dark:hover:to-indigo-600 text-white font-medium rounded-xl transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                    >
                        <svg v-if="form.processing" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <svg v-else class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ form.processing ? t.profile.saving : t.profile.save }}
                    </PrimaryButton>
                </div>
            </div>
        </form>
    </section>
</template>
