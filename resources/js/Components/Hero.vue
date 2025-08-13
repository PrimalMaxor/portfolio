<template>
    <div class="bg-gray-900 relative overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-20 left-10 w-72 h-72 bg-indigo-500/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute top-40 right-20 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl animate-pulse delay-1000"></div>
            <div class="absolute bottom-20 left-1/3 w-80 h-80 bg-purple-500/10 rounded-full blur-3xl animate-pulse delay-2000"></div>
            <div class="absolute inset-0 bg-[linear-gradient(rgba(59,130,246,0.1)_1px,transparent_1px),linear-gradient(90deg,rgba(59,130,246,0.1)_1px,transparent_1px)] bg-[size:50px_50px] opacity-20"></div>
        </div>

        <div class="relative isolate lg:px-8">
            <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
                <div class="text-center">
                    <div class="overflow-hidden">
                        <h2 class="text-lg font-medium text-indigo-400 mb-4 animate-fade-in-up animation-delay-200">
                            Welcome to my portfolio
                        </h2>
                    </div>
                    
                    <div class="overflow-hidden">
                        <h1 class="text-5xl font-semibold tracking-tight text-balance text-white sm:text-7xl animate-fade-in-up animation-delay-400">
                            Hi, I'm <span class="text-indigo-400 relative group">
                                Max
                                <span class="absolute -bottom-2 left-0 w-0 h-1 bg-indigo-400 transition-all duration-700 group-hover:w-full"></span>
                            </span>
                        </h1>
                    </div>
                    
                    <div class="overflow-hidden">
                        <p class="mt-8 text-lg font-medium text-pretty text-gray-400 sm:text-xl/8 animate-fade-in-up animation-delay-600">
                            I'm a software engineer with a passion for building 
                            <span class="text-indigo-300 font-semibold">web applications</span> that make a difference.
                        </p>
                    </div>
                    
                    <div class="mt-10 flex items-center justify-center gap-x-6 animate-fade-in-up animation-delay-800">
                        <a href="/projects"
                            class="group relative rounded-md bg-indigo-500 px-6 py-3 text-sm font-semibold text-white shadow-lg hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                            <span class="relative z-10">View Projects</span>
                            <div class="absolute inset-0 rounded-md bg-gradient-to-r from-indigo-400 to-purple-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300 blur-sm"></div>
                        </a>
                        
                        <a href="/contact" 
                            class="group text-sm/6 font-semibold text-white hover:text-indigo-300 transition-colors duration-300 relative">
                            Contact 
                            <span aria-hidden="true" class="inline-block transform group-hover:translate-x-1 transition-transform duration-300">→</span>
                            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-indigo-400 transition-all duration-300 group-hover:w-full"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out forwards;
    opacity: 0;
    transform: translateY(30px);
}

.animation-delay-200 {
    animation-delay: 200ms;
}

.animation-delay-400 {
    animation-delay: 400ms;
}

.animation-delay-600 {
    animation-delay: 600ms;
}

.animation-delay-800 {
    animation-delay: 800ms;
}

.animation-delay-1000 {
    animation-delay: 1000ms;
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Smooth transitions for all interactive elements */
* {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}

/* Enhanced hover effects */
.group:hover .group-hover\:scale-110 {
    transform: scale(1.1);
}

.group:hover .group-hover\:rotate-3 {
    transform: rotate(3deg);
}

.group:hover .group-hover\:-rotate-3 {
    transform: rotate(-3deg);
}
</style>