<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import GuestLayout from '~/layouts/GuestLayout.vue';
import { useAuth } from '~/composables/auth';
import LinkList from '~/components/shared/LinkList.vue';
</script>

<template>

    <Head>
        <title>Accueil - Ministère d'éducation du Burundi</title>
    </Head>

    <GuestLayout>
        <template #top_bar>
            <div class="sticky top-0 flex items-center justify-end px-6 space-x-4 text-sm font-bold h-14">
                <Link href="/request-password-reset" v-if="useAuth().isUniversity.value" class="text-gray-800 border-b">Réinitialiser mot de passe</Link>
                <Link href="/logout" method="post" as="button" class="text-red-500 border-b">Déconnexion</Link>
            </div>
        </template>

        <div class="px-6 mt-10">
            <div class="relative w-max">
                <h1 class="!mb-0">
                    {{ $page.props.auth['user'].name }}
                </h1>
                <div class="-rotate-[17deg] leading-3 py-1 px-4 bg-gray-600 absolute text-xs  translate-x-6 right-0 inline text-white">{{ $page.props.auth['user'].role }}</div>
            </div>

            <h2 class="pb-4 border-b">Options</h2>
            <LinkList size="lg" class="flex flex-wrap justify-between gap-10" />
        </div>
    </GuestLayout>
</template>