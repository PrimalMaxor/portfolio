import { ref, computed, watch, onMounted } from 'vue';

const isDarkMode = ref(localStorage.getItem('darkMode') === 'true');

export function useTheme() {
    const toggleDarkMode = () => {
        isDarkMode.value = !isDarkMode.value;
        localStorage.setItem('darkMode', isDarkMode.value);
    };

    const setDarkMode = (dark) => {
        isDarkMode.value = dark;
        localStorage.setItem('darkMode', isDarkMode.value);
    };

    // Watch for changes and update the DOM
    watch(isDarkMode, (newValue) => {
        if (newValue) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }, { immediate: true });

    // Initialize theme on mount
    onMounted(() => {
        if (isDarkMode.value) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    });

    return {
        isDarkMode: computed(() => isDarkMode.value),
        toggleDarkMode,
        setDarkMode
    };
} 