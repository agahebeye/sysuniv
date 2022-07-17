<script setup>
import AppHeader from '~/components/shared/AppHeader.vue';
</script>

<template>
    <div class="min-h-screen pb-10">
        <slot name="top_bar" />

        <AppHeader class="">
            <template #hamburger>
                <MenuAlt1Icon class="w-8 h-8 mr-8 cursor-pointer" @click="isMenuHidden = false" />
            </template>

            <div class="relative mt-4 text-2xl w-max">
                <div class="">
                    {{ $page.props.auth['user'].name }}
                </div>
                <div class="leading-3 py-1 px-1 bg-gray-600 absolute text-[0.5rem] font-bold translate-x-6 right-0 inline text-white">{{ $page.props.auth['user'].role }}</div>
            </div>
        </AppHeader>

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