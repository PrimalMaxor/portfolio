<script setup>
import { ref, computed, onMounted, onUnmounted, watch } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { useLanguage } from '../composables/useLanguage.js';

const isSidebarOpen = ref(false);
const isDarkMode = ref(localStorage.getItem('darkMode') === 'true');
const { currentLanguage, toggleLanguage, t } = useLanguage();

const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
};

const closeSidebar = () => {
    isSidebarOpen.value = false;
};

const toggleDarkMode = () => {
    isDarkMode.value = !isDarkMode.value;
    localStorage.setItem('darkMode', isDarkMode.value);
};

const navigationItems = [
    { name: 'home', href: '/', route: 'home' },
    { name: 'about', href: '/about', route: 'about' },
    { name: 'projects', href: '/projects', route: 'projects' },
    { name: 'cv', href: '/cv', route: 'cv' },
    { name: 'contact', href: '/contact', route: 'contact' },
    { name: 'dashboard', href: '/admin/dashboard', route: 'dashboard' },
];

const user = usePage().props.auth?.user;
const page = usePage();

const isCurrentPage = (href) => {
    return page.url === href;
};

const handleClickOutside = (event) => {
    if (isSidebarOpen.value && !event.target.closest('.sidebar') && !event.target.closest('.mobile-menu-button')) {
        closeSidebar();
    }
};

watch(isDarkMode, (newValue) => {
    if (newValue) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
}, { immediate: true });

onMounted(() => {
    document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside);
});
</script>

<template>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
        <div
            v-show="isSidebarOpen"
            class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75 transition-opacity lg:hidden"
            @click="closeSidebar"
        ></div>

        <div
            v-show="isSidebarOpen"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-gray-800 shadow-xl transform transition-transform duration-300 ease-in-out lg:hidden sidebar transition-colors duration-200"
        >
            <div class="flex flex-col h-full">
                <div class="flex-shrink-0 p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold text-2xl mx-auto mb-4">
                            {{ user ? user.initials : 'M' }}
                        </div>
                        <div class="flex items-center justify-center space-x-2 mb-2">
                            <p class="text-base font-medium text-gray-900 dark:text-white">
                                Max Nijenkamp
                            </p>
                            <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ user ? user.email : 'max@example.com' }}
                        </p>
                    </div>
                </div>

                <div class="flex-shrink-0 p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col items-center">
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-2">{{ t.profile.language }}</label>
                            <button
                                @click="toggleLanguage"
                                class="relative inline-flex h-8 w-14 items-center rounded-full bg-gray-200 dark:bg-gray-600 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            >
                                <span
                                    class="inline-flex h-6 w-6 transform rounded-full bg-white dark:bg-gray-300 transition-transform duration-200 items-center justify-center"
                                    :class="{ 'translate-x-7': currentLanguage === 'NL', 'translate-x-1': currentLanguage === 'EN' }"
                                >
                                    <span v-if="currentLanguage === 'EN'" class="text-xs font-medium text-gray-700 dark:text-gray-800">EN</span>
                                    <span v-else class="text-xs font-medium text-gray-700 dark:text-gray-800">NL</span>
                                </span>
                            </button>
                        </div>

                        <div class="flex flex-col items-center">
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-2">{{ t.profile.theme }}</label>
                            <button
                                @click="toggleDarkMode"
                                class="relative inline-flex h-8 w-14 items-center rounded-full bg-gray-200 dark:bg-gray-600 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                :class="{ 'bg-indigo-600': isDarkMode }"
                            >
                                <span
                                    class="inline-flex h-6 w-6 transform rounded-full bg-white dark:bg-gray-300 transition-transform duration-200 items-center justify-center"
                                    :class="{ 'translate-x-7': isDarkMode, 'translate-x-1': !isDarkMode }"
                                >
                                    <svg v-if="!isDarkMode" class="w-3 h-3 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd" />
                                    </svg>
                                    <svg v-else class="w-3 h-3 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>

                <nav class="flex-1 px-4 py-6 space-y-2">
                    <Link
                        v-for="item in navigationItems"
                        :key="item.name"
                        :href="item.href"
                        :class="[
                            isCurrentPage(item.href)
                                ? 'bg-indigo-50 dark:bg-indigo-900/20 text-indigo-700 dark:text-indigo-300 border-l-4 border-indigo-500'
                                : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:text-indigo-700 dark:hover:text-indigo-300',
                            'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-all duration-200'
                        ]"
                        @click="closeSidebar"
                    >
                        {{ t.navigation[item.name] }}
                    </Link>
                </nav>

                <div class="flex-shrink-0 p-6 border-t border-gray-200 dark:border-gray-700">
                    <p class="text-xs text-gray-500 dark:text-gray-400 text-center">
                        © {{ new Date().getFullYear() }} Max Nijenkamp. {{ t.copyright }}
                    </p>
                </div>

                <div class="flex-shrink-0 p-4 border-t border-gray-200 dark:border-gray-700">
                    <button
                        @click="closeSidebar"
                        class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md transition-colors duration-200"
                    >
                        {{ t.closeMenu }}
                    </button>
                </div>
            </div>
        </div>

        <div class="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-64 lg:flex-col">
            <div class="flex flex-col flex-grow bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 transition-colors duration-200">
                <div class="flex-shrink-0 p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold text-2xl mx-auto mb-4">
                            {{ user ? user.initials : 'M' }}
                        </div>
                        <div class="flex items-center justify-center space-x-2 mb-2">
                            <p class="text-base font-medium text-gray-900 dark:text-white">
                                Max Nijenkamp
                            </p>
                            <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ user ? user.email : 'max@example.com' }}
                        </p>
                    </div>
                </div>

                <div class="flex-shrink-0 p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col items-center">
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-2">{{ t.profile.language }}</label>
                            <button
                                @click="toggleLanguage"
                                class="relative inline-flex h-8 w-14 items-center rounded-full bg-gray-200 dark:bg-gray-600 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            >
                                <span
                                    class="inline-flex h-6 w-6 transform rounded-full bg-white dark:bg-gray-300 transition-transform duration-200 items-center justify-center"
                                    :class="{ 'translate-x-7': currentLanguage === 'NL', 'translate-x-1': currentLanguage === 'EN' }"
                                >
                                    <span v-if="currentLanguage === 'EN'" class="text-xs font-medium text-gray-700 dark:text-gray-800">EN</span>
                                    <span v-else class="text-xs font-medium text-gray-700 dark:text-gray-800">NL</span>
                                </span>
                            </button>
                        </div>

                        <div class="flex flex-col items-center">
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-2">{{ t.profile.theme }}</label>
                            <button
                                @click="toggleDarkMode"
                                class="relative inline-flex h-8 w-14 items-center rounded-full bg-gray-200 dark:bg-gray-600 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                :class="{ 'bg-indigo-600': isDarkMode }"
                            >
                                <span
                                    class="inline-flex h-6 w-6 transform rounded-full bg-white dark:bg-gray-300 transition-transform duration-200 items-center justify-center"
                                    :class="{ 'translate-x-7': isDarkMode, 'translate-x-1': !isDarkMode }"
                                >
                                    <svg v-if="!isDarkMode" class="w-3 h-3 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd" />
                                    </svg>
                                    <svg v-else class="w-3 h-3 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>

                <nav class="flex-1 px-4 py-6 space-y-2">
                    <Link
                        v-for="item in navigationItems"
                        :key="item.name"
                        :href="item.href"
                        :class="[
                            isCurrentPage(item.href)
                                ? 'bg-indigo-50 dark:bg-indigo-900/20 text-indigo-700 dark:text-indigo-300 border-l-4 border-indigo-500'
                                : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:text-indigo-700 dark:hover:text-indigo-300',
                            'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-all duration-200'
                        ]"
                    >
                        {{ t.navigation[item.name] }}
                    </Link>
                </nav>

                <div class="flex-shrink-0 p-6 border-t border-gray-200 dark:border-gray-700">
                    <p class="text-xs text-gray-500 dark:text-gray-400 text-center">
                        © {{ new Date().getFullYear() }} Max Nijenkamp. {{ t.copyright }}
                    </p>
                </div>
            </div>
        </div>

        <div class="lg:pl-64">
            <div class="sticky top-0 z-30 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 transition-colors duration-200 lg:hidden">
                <div class="flex items-center justify-between px-4 py-3">
                    <Link href="/" class="flex items-center space-x-2">
                        <span class="text-xl font-bold text-indigo-600 dark:text-indigo-400">Max</span>
                    </Link>
                    <button
                        @click="toggleSidebar"
                        type="button"
                        class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 focus:outline-none focus:text-gray-700 dark:focus:text-gray-200 p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200 mobile-menu-button"
                        aria-label="Toggle sidebar"
                    >
                        <svg
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                        </svg>
                    </button>
                </div>
            </div>

            <main class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template> 