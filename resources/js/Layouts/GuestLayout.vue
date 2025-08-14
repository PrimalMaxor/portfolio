<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { useLanguage } from '@/composables/useLanguage.js';
import { useTheme } from '@/composables/useTheme.js';

const { t } = useLanguage();
const { isDarkMode } = useTheme();

onMounted(() => {
    const elements = document.querySelectorAll('.animate-on-mount');
    elements.forEach((el, index) => {
        setTimeout(() => {
            el.classList.add('animate-in');
        }, index * 200);
    });
});
</script>

<template>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 dark:from-gray-600 dark:via-gray-700 dark:to-gray-900 flex items-center justify-center p-6 transition-colors duration-200">
        <div class="w-full max-w-6xl bg-white dark:bg-gray-800 rounded-3xl shadow-2xl overflow-hidden animate-on-mount transition-colors duration-200">
            <div class="flex flex-col lg:flex-row min-h-[600px]">
                <div class="lg:w-[60%] bg-gradient-to-br from-blue-600 to-indigo-700 dark:from-blue-900 dark:to-indigo-900 text-white p-8 lg:p-12 flex flex-col justify-center relative overflow-hidden transition-colors duration-200">
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute top-20 left-20 w-32 h-32 bg-white rounded-full blur-3xl"></div>
                        <div class="absolute bottom-20 right-20 w-40 h-40 bg-blue-300 rounded-full blur-3xl"></div>
                        <div class="absolute top-1/2 left-1/2 w-24 h-24 bg-indigo-300 rounded-full blur-2xl"></div>
                    </div>
                    
                    <div class="relative z-10">
                        <h1 class="text-3xl lg:text-4xl font-bold mb-6 leading-tight">
                            {{ t.guestLayout.title }}
                            <span class="block text-blue-200 dark:text-blue-100">{{ t.guestLayout.subtitle }}</span>
                        </h1>
                        
                        <p class="text-lg lg:text-xl text-blue-100 dark:text-blue-200 mb-8 leading-relaxed">
                            {{ t.guestLayout.description }}
                        </p>
                        
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-blue-200 dark:bg-blue-300 rounded-full"></div>
                                <span class="text-blue-100 dark:text-blue-200">{{ t.guestLayout.features.projects }}</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-blue-200 dark:bg-blue-300 rounded-full"></div>
                                <span class="text-blue-100 dark:text-blue-200">{{ t.guestLayout.features.skills }}</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-blue-200 dark:bg-blue-300 rounded-full"></div>
                                <span class="text-blue-100 dark:text-blue-200">{{ t.guestLayout.features.education }}</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-blue-200 dark:bg-blue-300 rounded-full"></div>
                                <span class="text-blue-100 dark:text-blue-200">{{ t.guestLayout.features.realtime }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="lg:w-[40%] flex items-center justify-center p-8 bg-white dark:bg-gray-800 transition-colors duration-200">
                    <div class="w-full max-w-sm">
                        <div class="space-y-6">
                            <slot />
                        </div>
                        
                        <div class="text-center mt-6">
                            <Link href="/" class="text-sm text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">
                                {{ t.guestLayout.backToPortfolio }}
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.animate-on-mount {
    opacity: 0;
    transform: translateY(20px) scale(0.95);
    transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.animate-on-mount.animate-in {
    opacity: 1;
    transform: translateY(0) scale(1);
}

* {
    transition: all 0.2s ease;
}

@keyframes gradient-shift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.bg-gradient-to-br {
    background-size: 200% 200%;
    animation: gradient-shift 15s ease infinite;
}
</style>
