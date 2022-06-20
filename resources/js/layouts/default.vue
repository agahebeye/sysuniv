<script lang="ts" setup>
import { Link } from '@inertiajs/inertia-vue3';
import LinkList from '~/components/shared/LinkList.vue';
import SuccessAlert from '~/components/flash/SuccessAlert.vue';

</script>

<template>
    <SuccessAlert v-if="$page.props.flash['success']" :message="$page.props.flash['success']" />

    <div class="flex">
        <nav class="top-nav w-56 pl-4 pt-4 bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 min-h-screen">
            <div>
                <LinkList size="sm" class="flex flex-col space-y-4" />
                <div class="h-px bg-teal-600 mt-6 mb-3"></div>
                <Link href="/logout" method="post" as="button" class="font-bold text-red-600 uppercase">logout</Link>
            </div>
        </nav>

        <div class="flex-grow">
            <header class="mb-10 ">
                <div class="pl-10 text-xs mt-4">
                    <div>Republique du Burundi</div>
                    <div>Ministere de l'education nationale et de la recherche scientifique</div>
                    <div class="font-bold text-2xl">{{ $page.props.auth['user'].name }}</div>
                </div>
            </header>

            <main class="prose pl-10 max-w-none">
                <Link href="/" class="inline-flex items-center mb-4 text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                <svg class="mr-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                </svg>
                Home
                </Link>
                <slot></slot>
            </main>
        </div>


    </div>
</template>

<style scoped>
.container {}

.top-nav {}

main {}

header {}
</style>