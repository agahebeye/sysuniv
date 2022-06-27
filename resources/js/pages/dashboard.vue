<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import GuestLayout from '~/layouts/GuestLayout.vue';
import { useAuth } from '~/composables/auth';
import LinkList from '~/components/shared/LinkList.vue';

export default {
    layout: GuestLayout,

    components: {
        Head, Link,
        LinkList
    },

    setup() {
        const { authedUser, isUniversity } = useAuth();

        return {
            authedUser,
            isUniversity
        }
    }
}
</script>

<template>
    <div>

        <Head>
            <title>Accueil - Ministère d'éducation du Burundi</title>
        </Head>

        <div>

            <p>Accueil</p>

            <Link href="/request-password-reset" class="text-xs font-bold border-b border-teal-600 fixed top-10 right-10" v-if="isUniversity">Réinitialiser votre mot de passe</Link>

            <div class="relative w-max mb-16">
                <h1 class="!mb-0">
                    {{ $page.props.auth['user'].name }}
                </h1>
                <div class="-rotate-[17deg] leading-3 p-1 bg-gray-600 absolute  translate-x-6 right-0 inline text-white">{{ $page.props.auth['user'].role }}</div>
            </div>

            <LinkList size="lg" class="flex flex-wrap gap-10 max-w-xl" />
        </div>
    </div>
</template>

<style scoped>
a {
    @apply  !no-underline;
}
</style>