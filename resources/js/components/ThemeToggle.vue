<script setup lang="ts">
import { Moon, Sun } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';

const isDark = ref(false);

function applyTheme(dark: boolean, persist = true) {
    const root = document.documentElement;
    root.classList.toggle('dark', dark);
    isDark.value = dark;
    if (persist) localStorage.setItem('theme', dark ? 'dark' : 'light');
}

function toggleTheme() {
    const next = !isDark.value;
    // animate = true
    (window as any).__setTheme(next ? 'dark' : 'light', true, true);
    isDark.value = next;
}

onMounted(() => {
    // Aligne l'état local sur ce que le script <head> a déjà mis
    isDark.value = document.documentElement.classList.contains('dark');

    // Si l'utilisateur n'a jamais choisi, suivre les changements du système
    const saved = localStorage.getItem('theme');
    if (!saved) {
        const mq = window.matchMedia('(prefers-color-scheme: dark)');
        const handler = (e: MediaQueryListEvent) => applyTheme(e.matches, false);
        mq.addEventListener?.('change', handler);
    }
});
</script>

<template>
    <button
        type="button"
        @click="toggleTheme"
        aria-label="Toggle theme"
        class="fixed top-4 right-4 z-50 cursor-pointer rounded-full border border-border bg-card p-2 text-foreground shadow hover:bg-muted focus:outline-none focus-visible:ring-2 focus-visible:ring-ring"
    >
        <Moon v-if="!isDark" class="h-5 w-5" />
        <Sun v-else class="h-5 w-5" />
    </button>
</template>
