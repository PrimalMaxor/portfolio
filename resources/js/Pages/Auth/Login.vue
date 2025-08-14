<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { useLanguage } from '@/composables/useLanguage.js';
import { useTheme } from '@/composables/useTheme.js';

const { t } = useLanguage();
const { isDarkMode } = useTheme();

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800 dark:text-green-200">{{ status }}</p>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ t.auth.login.title }}</h2>
                <p class="text-gray-600 dark:text-gray-300">{{ t.auth.login.subtitle }}</p>
            </div>

            <form @submit.prevent="submit" class="space-y-6">
                <div>
                    <InputLabel for="email" :value="t.auth.login.email" class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 block" />

                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                        :placeholder="t.auth.login.email"
                    />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div>
                    <InputLabel for="password" :value="t.auth.login.password" class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 block" />

                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                        :placeholder="t.auth.login.password"
                    />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <Checkbox name="remember" v-model:checked="form.remember" />
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">{{ t.auth.login.rememberMe }}</span>
                    </label>

                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 rounded transition-colors duration-200"
                    >
                        {{ t.auth.login.forgotPassword }}
                    </Link>
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
                        {{ form.processing ? t.auth.login.signingIn : t.auth.login.signIn }}
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>

<style scoped>
input:focus {
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.dark input:focus {
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
}

* {
    transition: all 0.2s ease-in-out;
}

button:hover:not(:disabled) {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.dark button:hover:not(:disabled) {
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
}

button:active:not(:disabled) {
    transform: translateY(0);
}
</style>
