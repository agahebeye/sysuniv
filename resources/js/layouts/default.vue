<script lang="ts" setup>
import { Link } from '@inertiajs/inertia-vue3';
import LinkList from '~/components/shared/LinkList.vue';
import SuccessAlert from '~/components/flash/SuccessAlert.vue';
import AppHeader from '~/components/shared/AppHeader.vue';

</script>

<template>
    <SuccessAlert v-if="$page.props.flash['success']" :message="$page.props.flash['success']" />
    <div class="">
        <div class="w-full bg-gray-200">
            <AppHeader class="flex items-center justify-center mx-auto mb-16 space-x-8 md:max-w-5xl">
                <div class="relative text-lg w-max">
                    <div>
                        {{ $page.props.auth['user'].name }}
                    </div>
                    <div class="-rotate-[17deg] leading-3 p-1 bg-gray-600 absolute translate-x-6 right-0 inline text-white">{{ $page.props.auth['user'].role }}</div>
                </div>
            </AppHeader>
        </div>

        <div class="flex px-6 mx-auto space-x-32 md:max-w-5xl">
            <nav class="">
                <div>
                    <LinkList size="sm" class="flex flex-col space-y-4">
                        <Link href="/logout" method="post" as="button" class="font-bold text-red-600 uppercase">deconnexion</Link>
                    </LinkList>
                </div>
            </nav>

            <main class="">
                <Link href="/" class="inline-flex items-center mb-4 text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                </svg>
                Accueil
                </Link>
                <slot></slot>
            </main>
        </div>
    </div>
</template>