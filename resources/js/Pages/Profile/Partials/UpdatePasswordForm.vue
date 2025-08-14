<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { useLanguage } from '@/composables/useLanguage.js';

const { t } = useLanguage();

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section>
        <form @submit.prevent="updatePassword" class="space-y-8">
            <div class="space-y-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <InputLabel for="current_password" :value="t.profile.currentPassword" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                        <div class="relative">
                            <TextInput
                                id="current_password"
                                ref="currentPasswordInput"
                                v-model="form.current_password"
                                type="password"
                                class="w-full px-4 py-3 pl-12 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500"
                                autocomplete="current-password"
                            />
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                        </div>
                        <InputError
                            :message="form.errors.current_password"
                            class="mt-1"
                        />
                    </div>

                    <div class="space-y-2">
                        <InputLabel for="password" :value="t.profile.newPassword" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                        <div class="relative">
                            <TextInput
                                id="password"
                                ref="passwordInput"
                                v-model="form.password"
                                type="password"
                                class="w-full px-4 py-3 pl-12 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500"
                                autocomplete="new-password"
                            />
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                </svg>
                            </div>
                        </div>
                        <InputError :message="form.errors.password" class="mt-1" />
                    </div>
                </div>

                <div class="space-y-2">
                    <InputLabel
                        for="password_confirmation"
                        :value="t.profile.confirmPassword"
                        class="text-sm font-medium text-gray-700 dark:text-gray-300"
                    />
                    <div class="relative">
                        <TextInput
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            type="password"
                            class="w-full px-4 py-3 pl-12 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 hover:border-gray-400 dark:hover:border-gray-500"
                            autocomplete="new-password"
                        />
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                    </div>
                    <InputError
                        :message="form.errors.password_confirmation"
                        class="mt-1"
                    />
                </div>
            </div>

            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-6">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-blue-800 dark:text-blue-200 mb-2">
                            {{ t.profile.passwordRequirements }}
                        </h4>
                        <ul class="text-sm text-blue-700 dark:text-blue-300 space-y-1">
                            <li class="flex items-center space-x-2">
                                <svg class="h-4 w-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>{{ t.profile.passwordRequirementsDesc }}</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <svg class="h-4 w-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>{{ t.profile.passwordRequirementsDesc2 }}</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <svg class="h-4 w-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>{{ t.profile.passwordRequirementsDesc3 }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    {{ t.profile.passwordUpdateInfo }}
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
                        class="px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 dark:from-green-500 dark:to-emerald-500 dark:hover:from-green-600 dark:hover:to-emerald-600 text-white font-medium rounded-xl transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                    >
                        <svg v-if="form.processing" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <svg v-else class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        {{ form.processing ? t.profile.updating : t.profile.save }}
                    </PrimaryButton>
                </div>
            </div>
        </form>
    </section>
</template>
