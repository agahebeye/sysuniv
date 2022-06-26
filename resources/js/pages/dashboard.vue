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

            <h1 class="capitalize">{{ authedUser.name }}</h1>

            <LinkList size="lg" class="flex flex-wrap gap-10 max-w-xl" />
        </div>
    </div>
</template>

<style scoped>
a {
    @apply !no-underline;
}
</style>