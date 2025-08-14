import { ref, computed } from 'vue';
import { languages } from '../lang/index.js';

const currentLanguage = ref(localStorage.getItem('language') || 'EN');

export function useLanguage() {
    const toggleLanguage = () => {
        const newLanguage = currentLanguage.value === 'EN' ? 'NL' : 'EN';
        currentLanguage.value = newLanguage;
        localStorage.setItem('language', newLanguage);
    };

    const t = computed(() => languages[currentLanguage.value]);

    return {
        currentLanguage: computed(() => currentLanguage.value),
        toggleLanguage,
        t
    };
} 