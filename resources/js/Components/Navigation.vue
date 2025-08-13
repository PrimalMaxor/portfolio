<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from './ApplicationLogo.vue';

const isMenuOpen = ref(false);

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
};

const closeMenu = () => {
    isMenuOpen.value = false;
};

const navigationItems = [
    { name: 'Home', href: '/', current: true },
    { name: 'About', href: '/about', current: false },
    { name: 'Projects', href: '/projects', current: false },
    { name: 'Skills', href: '/skills', current: false },
    { name: 'CV', href: '/curriculum-vitae', current: false },
    { name: 'Contact', href: '/contact', current: false },
];
</script>

<template>
    <nav class="bg-gray-800 backdrop-blur-md border-b border-gray-700/50 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0">
                    <Link href="/" class="flex items-center space-x-2">
                        <span class="text-xl hover:text-indigo-400 font-bold text-white">Max</span>
                    </Link>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-6">
                        <Link
                            v-for="item in navigationItems"
                            :key="item.name"
                            :href="item.href"
                            :class="[
                                item.current
                                    ? 'text-indigo-400 border-b-2 border-indigo-400'
                                    : 'text-gray-300 hover:text-indigo-400 hover:border-b-2 hover:border-indigo-400/50',
                                'px-3 py-2 text-sm font-medium transition-all duration-300 border-b-2 border-transparent'
                            ]"
                        >
                            {{ item.name }}
                        </Link>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button
                        @click="toggleMenu"
                        type="button"
                        class="text-gray-300 hover:text-white focus:outline-none focus:text-white p-2 rounded-lg hover:bg-gray-800/50 transition-all duration-300"
                        aria-label="Toggle menu"
                    >
                        <svg
                            class="h-6 w-6"
                            :class="{ 'hidden': isMenuOpen, 'block': !isMenuOpen }"
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
                        <svg
                            class="h-6 w-6"
                            :class="{ 'block': isMenuOpen, 'hidden': !isMenuOpen }"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div
            v-show="isMenuOpen"
            class="md:hidden"
            @click="closeMenu"
        >
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-gray-900/95 backdrop-blur-md border-t border-gray-700/50">
                <Link
                    v-for="item in navigationItems"
                    :key="item.name"
                    :href="item.href"
                    :class="[
                        item.current
                            ? 'bg-indigo-500/20 text-indigo-400 border-l-4 border-indigo-400'
                            : 'text-gray-300 hover:bg-gray-800/50 hover:text-indigo-400',
                        'block px-3 py-2 text-base font-medium transition-all duration-300'
                    ]"
                    @click="closeMenu"
                >
                    {{ item.name }}
                </Link>
            </div>
        </div>
    </nav>
</template> 