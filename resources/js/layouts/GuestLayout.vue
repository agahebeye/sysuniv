<script setup>
import AppHeader from '~/components/shared/AppHeader.vue';
</script>

<template>
    <div class="min-h-screen pb-10">
        <slot name="top_bar" />
        
        <AppHeader class="" />

        <main class="prose max-w-none">
            <slot />
        </main>
    </div>
</template>

<style scoped>
header {
   @apply px-6 w-full py-7 flex items-center space-x-2 text-sm sticky top-0;
}
</style>