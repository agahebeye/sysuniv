<script lang="ts" setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { useAuth } from '~/composables/auth';
import DefaultLayout from '~/layouts/default.vue';

const { isUniversity } = useAuth();


defineProps<{
    faculties: Array<any>
}>();
</script>

<template>
    <DefaultLayout>

        <Head>
            <title>Faculties - Sysuniv</title>
        </Head>
        
        <div>
            <h1>Facultés</h1>

            <Link v-if="!isUniversity" href="/faculties/create" class="link">Créer une nouvelle faculté</Link>

            <h2 class="mt-10 mb-8" v-if="faculties.length"><strong>{{ faculties.length }}</strong> faculté(s)</h2>
            <h2 class="mt-10 mb-8" v-else>Aucune faculté a été enregistrée</h2>

            <ul class="flex flex-col flex-wrap list-disc list-inside">
                <li v-for="faculty in faculties" class="mb-2" data-test="faculty">
                    {{ faculty.name }}
                </li>
            </ul>
        </div>
    </DefaultLayout>
</template>