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
            <title>Dashboard - Sysuniv</title>
        </Head>

        <div>

            <p>Welcome to the dashboard</p>

            <Link href="/request-password-reset" class="text-xs font-bold border-b border-teal-600 fixed top-10 right-10" v-if="isUniversity">Reset your password</Link>

            <h1>{{ authedUser.name }}</h1>

            <LinkList size="lg" class="flex flex-wrap gap-10" />
        </div>
    </div>
</template>

<style scoped>
a {
    @apply !no-underline;
}
</style>