<script lang="ts" setup>
import { User } from '~/types/users';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { useAuth } from '~/composables/auth';

const { isAdmin, isEmployee } = useAuth();

defineProps<{
    universities: Array<User>
}>();
</script>

<template>
    <div>

        <Head>
            <title>Universities - Sysuniv</title>
        </Head>

        <h1>Universities</h1>

        <Link v-if="isAdmin || isEmployee" href="/universities/create" class="link">Create new university</Link>

        <div class="columns-3">
            <div v-for="university in universities" data-test="university">
                <Link :href="`/universities/${university.id}`">{{ university.name }}</Link>
            </div>
        </div>
    </div>
</template>