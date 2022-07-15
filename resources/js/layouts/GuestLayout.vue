<script setup>
import AppHeader from '~/components/shared/AppHeader.vue';
</script>

<template>
    <div class="">
        <slot name="top_bar" />
        
        <AppHeader class="" />

        <main class="flex items-center pl-20 pr-6 prose max-w-none">
            <slot />
        </main>
    </div>
</template>

<style scoped>
header {
   @apply bg-red-200 w-full  flex items-center space-x-2 text-sm;
}
</style>