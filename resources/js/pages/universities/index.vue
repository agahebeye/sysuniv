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

        <h1>Universitées</h1>

        <Link v-if="isAdmin || isEmployee" href="/universities/create" class="link">Créer une nouvelle université</Link>

        <h2 class="mt-10 mb-8" v-if="universities.length"><strong>{{ universities.length }}</strong> universitée(s)</h2>
        <h2 class="mt-10 mb-8" v-else>No universities already registered</h2>

        <div class="columns-3 gap-12 max-w-2xl">
            <div v-for="university in universities" class="mb-2" data-test="university">
                <Link :href="`/universities/${university.id}`" class="no-underline hover:underline">{{ university.name }}</Link>
            </div>
        </div>
    </div>
</template>