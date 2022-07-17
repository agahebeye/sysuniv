<script lang="ts" setup>
import { computed, ref } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import LinkList from '~/components/shared/LinkList.vue';
import SuccessAlert from '~/components/flash/SuccessAlert.vue';
import AppHeader from '~/components/shared/AppHeader.vue';
import { XIcon, MenuAlt1Icon } from '@heroicons/vue/outline';

import { useAuth } from '~/composables/auth';
const homeLink = computed(() => useAuth().isUniversity.value ? '/registrations/create' : '/universities')

const isMenuHidden = ref(true);

</script>

<template>
    <SuccessAlert v-if="$page.props.flash['success']" :message="$page.props.flash['success']" />
    <div class="min-h-screen pb-10">
        <AppHeader class="">
            <template #hamburger>
                <MenuAlt1Icon class="w-8 h-8 mr-8 cursor-pointer" @click="isMenuHidden = false" />
            </template>

            <div class="relative mt-4 text-lg w-max">
                <div class="">
                    {{ $page.props.auth['user'].name }}
                </div>
                <div class="-rotate-[17deg] leading-3 py-1 px-3 bg-gray-600 absolute text-[0.6rem] font-bold translate-x-6 right-0 inline text-white">{{ $page.props.auth['user'].role }}</div>
            </div>
        </AppHeader>

        <div class="px-6 mt-10">
            <nav :class="{ 'visible': !isMenuHidden, 'invisible': isMenuHidden }">
                <XIcon class="absolute w-10 h-10 cursor-pointer top-10 right-10" @click="isMenuHidden = true" />
                <LinkList size="sm" class="flex flex-col space-y-6">
                    <div class="flex flex-col pt-4 space-y-4 border-t border-gray-300">
                        <Link href="/request-password-reset" v-if="useAuth().isUniversity.value" class="text-gray-800 border-b">Réinitialiser mot de passe</Link>
                        <Link href="/logout" method="post" as="button" class="font-bold text-red-600 w-max">Déconnexion</Link>
                    </div>
                </LinkList>
            </nav>

            <main class="">
                <slot></slot>
            </main>
        </div>
    </div>
</template>

<style scoped>
header {
    @apply px-6 w-full py-7 flex items-center space-x-2 text-sm sticky top-0;
    @apply bg-white z-20;
}

nav {
    @apply fixed top-0 w-full min-h-screen bg-gray-200 z-30 left-0;
    @apply flex justify-center items-center text-3xl font-bold;
}
</style>