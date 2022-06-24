<script setup>
import AppHeader from '~/components/shared/AppHeader.vue';
</script>

<template>
    <div class="container px-6 md:max-w-5xl mx-auto flex divide-x">
        <AppHeader class="pr-20 min-h-screen flex items-center space-x-2 text-sm w-[30rem]" />
        <!-- <header class="w-96 bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 min-h-screen flex items-center">
             <div class="px-10 text-sm space-y-3">
                <div>Republique du Burundi</div>
                <div>Ministère de l'éducation nationale et de la recherche scientifique</div>
            </div>
        </header> -->

        <main class="prose max-w-none flex items-center pl-20 pr-6">
            <slot />
        </main>
    </div>
</template>