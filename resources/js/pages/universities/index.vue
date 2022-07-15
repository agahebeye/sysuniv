<script lang="ts" setup>
import { User } from '~/types/users';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { useAuth } from '~/composables/auth';
import DefaultLayout from '~/layouts/default.vue';

const { isAdmin, isEmployee } = useAuth();

defineProps<{
    universities: Array<User>
}>();
</script>

<template>

    <Head>
        <title>Universités - Ministère d'éducation du Burundi</title>
    </Head>

    <DefaultLayout>

        <div>
            <h1>Universitées</h1>

            <Link v-if="isAdmin || isEmployee" href="/universities/create" class="link">Créer une nouvelle université</Link>

            <h2 class="mt-10 mb-8" v-if="universities.length"><strong>{{ universities.length }}</strong> université(s)</h2>
            <h2 class="mt-10 mb-8" v-else>Aucune université a été enregistrée</h2>

            <ul class="max-w-2xl gap-12 list-disc columns-3">
                <li v-for="university in universities" class="mb-2" data-test="university">
                    <Link :href="`/universities/${university.id}`" class="no-underline hover:underline">{{ university.name }}</Link>
                </li>
            </ul>
        </div>
    </DefaultLayout>
</template>