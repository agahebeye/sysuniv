<script lang="ts" setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { useAuth } from '~/composables/auth';
import DefaultLayout from '~/layouts/default.vue';
const { isUniversity } = useAuth();

defineProps<{
    institutes: Array<any>
}>();
</script>

<template>

    <Head>
        <title>Instituts - Ministère de l'éducation du Burundi</title>
    </Head>
    
    <DefaultLayout>
        <div>
            <h1>Instituts</h1>

            <Link v-if="!isUniversity" href="/institutes/create" class="link">Créer nouveau institut</Link>

            <h2 class="mt-10 mb-8" v-if="institutes.length"><strong>{{ institutes.length }}</strong> institut(s)</h2>
            <h2 class="mt-10 mb-8" v-else>Aucune institut a été enregistré</h2>

            <ul class="flex flex-col flex-wrap list-disc list-inside">
                <li v-for="institute in institutes" class="mb-2" data-test="institute">
                    {{ institute.name }}
                </li>
            </ul>
        </div>
    </DefaultLayout>
</template>