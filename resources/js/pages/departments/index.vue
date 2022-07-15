<script lang="ts" setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { useAuth } from '~/composables/auth';
import DefaultLayout from '~/layouts/default.vue';
const { isUniversity } = useAuth();

defineProps<{
    departments: Array<any>
}>();
</script>

<template>

    <Head>
        <title>Départements - Ministère de l'éducation du Burundi</title>
    </Head>

    <DefaultLayout>
        <div>
            <h1>Départements</h1>

            <Link v-if="!isUniversity" href="/departments/create" class="link">Créer nouveau département</Link>

            <h2 class="mt-10 mb-8" v-if="departments.length"><strong>{{ departments.length }}</strong> département(s)</h2>
            <h2 class="mt-10 mb-8" v-else>Aucun département a été enregistré</h2>

            <ul class="flex flex-col flex-wrap list-disc list-inside">
                <li v-for="department in departments" class="mb-2" data-test="department">
                    {{ department.name }}
                </li>
            </ul>
        </div>
    </DefaultLayout>
</template>