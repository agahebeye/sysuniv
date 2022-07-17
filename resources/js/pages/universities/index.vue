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
        <title>Universités - Ministère d'éducation au Burundi</title>
    </Head>

    <DefaultLayout>

        <div>
            <h1>Universités</h1>

            <Link v-if="isAdmin || isEmployee" href="/universities/create" class="link">Créer une nouvelle université</Link>

            <h2 class="mt-10 mb-8" v-if="universities.length"><strong>{{ universities.length }}</strong> université(s)</h2>
            <h2 class="mt-10 mb-8" v-else>Aucune université a été enregistrée</h2>

            <ul class="flex flex-col flex-wrap list-disc list-inside">
                <li v-for="university in universities" class="" data-test="university">
                    <Link :href="`/universities/${university.id}`" class="no-underline hover:underline">{{ university.name }}</Link>
                </li>
            </ul>
        </div>
    </DefaultLayout>
</template>