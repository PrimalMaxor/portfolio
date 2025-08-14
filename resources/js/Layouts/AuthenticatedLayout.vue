<script setup>
import { ref, computed, onMounted, onUnmounted, watch } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { useLanguage } from '@/composables/useLanguage.js';
import { useTheme } from '@/composables/useTheme.js';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

const isSidebarOpen = ref(false);
const { currentLanguage, toggleLanguage, t } = useLanguage();
const { isDarkMode, toggleDarkMode } = useTheme();

const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
};

const closeSidebar = () => {
    isSidebarOpen.value = false;
};

const navigationItems = [
    { name: 'dashboard', href: '/admin/dashboard', route: 'dashboard', icon: 'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z' },
    { name: 'profile', href: '/admin/profile', route: 'profile.edit', icon: 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z' },
    { name: 'website', href: '/', route: 'home', icon: 'M12 2L2 22h20L12 2z' },
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
                    <div class="flex items-center justify-between">
                        <Link :href="route('dashboard')" class="flex items-center space-x-3">
                            <span class="text-xl font-bold text-gray-900 dark:text-white">{{ t.admin.title }}</span>
                        </Link>
                        <button
                            @click="closeSidebar"
                            class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 p-1 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200"
                        >
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex-shrink-0 p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold text-xl mx-auto mb-3">
                            {{ user ? user.initials : 'U' }}
                        </div>
                        <div class="flex items-center justify-center space-x-2 mb-2">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ user ? user.full_name : 'User' }}
                            </p>
                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            {{ user ? user.email : 'user@example.com' }}
                        </p>
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
                        <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="item.icon" />
                        </svg>
                        {{ t.admin[item.name] }}
                    </Link>
                </nav>

                <div class="flex-shrink-0 p-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col items-center">
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-2">{{ t.profile.language }}</label>
                            <button
                                @click="toggleLanguage"
                                class="relative inline-flex h-8 w-14 items-center rounded-full bg-gray-200 dark:bg-gray-600 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
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
                                class="relative inline-flex h-8 w-14 items-center rounded-full bg-gray-200 dark:bg-gray-600 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
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

                <div class="flex-shrink-0 p-4 border-t border-gray-200 dark:border-gray-700">
                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30 rounded-md transition-colors duration-200"
                        @click="closeSidebar"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        {{ t.admin.logout }}
                    </Link>
                </div>
            </div>
        </div>

        <div class="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-64 lg:flex-col">
            <div class="flex flex-col flex-grow bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 transition-colors duration-200">
                <div class="flex-shrink-0 p-6 border-b border-gray-200 dark:border-gray-700">
                    <Link :href="route('dashboard')" class="flex items-center space-x-3">
                        <span class="text-xl font-bold text-gray-900 dark:text-white">{{ t.admin.title }}</span>
                    </Link>
                </div>

                <div class="flex-shrink-0 p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold text-xl mx-auto mb-3">
                            {{ user ? user.initials : 'U' }}
                        </div>
                        <div class="flex items-center justify-center space-x-2 mb-2">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ user ? user.full_name : 'User' }}
                            </p>
                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            {{ user ? user.email : 'user@example.com' }}
                        </p>
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
                        <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="item.icon" />
                        </svg>
                        {{ t.admin[item.name]}}
                    </Link>
                </nav>

                <div class="flex-shrink-0 p-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col items-center">
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-2">{{ t.profile.language }}</label>
                            <button
                                @click="toggleLanguage"
                                class="relative inline-flex h-8 w-14 items-center rounded-full bg-gray-200 dark:bg-gray-600 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
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
                                class="relative inline-flex h-8 w-14 items-center rounded-full bg-gray-200 dark:bg-gray-600 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
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

                <div class="flex-shrink-0 p-4 border-t border-gray-200 dark:border-gray-700">
                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30 rounded-md transition-colors duration-200"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        {{ t.admin.logout }}
                    </Link>
                </div>
            </div>
        </div>

        <div class="lg:pl-64">
            <div class="sticky top-0 z-30 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 transition-colors duration-200 lg:hidden">
                <div class="flex items-center justify-between px-4 py-3">
                    <Link :href="route('dashboard')" class="flex items-center space-x-2">
                        <ApplicationLogo class="h-6 w-6 fill-current text-indigo-600 dark:text-indigo-400" />
                        <span class="text-lg font-bold text-gray-900 dark:text-white">{{ t.admin.title }}</span>
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
                    <header v-if="$slots.header" class="mb-8">
                        <slot name="header" />
                    </header>
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>
