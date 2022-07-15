<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import GuestLayout from '~/layouts/GuestLayout.vue';
import LinkList from '~/components/shared/LinkList.vue';
</script>

<template>

    <Head>
        <title>Accueil - Ministère d'éducation du Burundi</title>
    </Head>

    <GuestLayout>
        <template #top_bar>
            <div class="flex justify-end">
                <Link href="/logout" method="post" as="button" class="text-sm text-red-600">déconnexion</Link>
            </div>
        </template>

        <p>Accueil</p>

        <div class="relative mb-16 w-max">
            <h1 class="!mb-0">
                {{ $page.props.auth['user'].name }}
            </h1>
            <div class="-rotate-[17deg] leading-3 p-1 bg-gray-600 absolute  translate-x-6 right-0 inline text-white">{{ $page.props.auth['user'].role }}</div>
        </div>

        <LinkList size="lg" class="flex flex-wrap max-w-xl gap-10" />
    </GuestLayout>
</template>