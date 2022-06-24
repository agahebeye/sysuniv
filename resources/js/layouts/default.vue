<script lang="ts" setup>
import { Link } from '@inertiajs/inertia-vue3';
import LinkList from '~/components/shared/LinkList.vue';
import SuccessAlert from '~/components/flash/SuccessAlert.vue';
import AppHeader from '~/components/shared/AppHeader.vue';

</script>

<template>
    <SuccessAlert v-if="$page.props.flash['success']" :message="$page.props.flash['success']" />
    <div class="container px-6 md:max-w-5xl mx-auto">
        <AppHeader class="flex items-center space-x-8 justify-center mb-16">
                <div class="text-xl">{{ $page.props.auth['user'].name }}</div>
        </AppHeader>
        <!-- <header >
            <img class="w-32" src="/storage/images/armoiries-bi.svg" alt="armoiries du burundi" />
            <div class="mt-4">
                <div>Ministere de l'education nationale et de la recherche scientifique</div>
                <div class="uppercase font-bold">Republique du Burundi</div>
            </div>
        </header> -->

        <div class="flex space-x-32">
            <nav class="">
                <div>
                    <LinkList size="sm" class="flex flex-col space-y-4">
                        <Link href="/logout" method="post" as="button" class="font-bold text-red-600 uppercase">deconnexion</Link>
                    </LinkList>
                </div>
            </nav>

            <main class="">
                <Link href="/" class="inline-flex items-center mb-4 text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                <svg class="mr-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                </svg>
                Accueil
                </Link>
                <slot></slot>
            </main>
        </div>
    </div>
</template>