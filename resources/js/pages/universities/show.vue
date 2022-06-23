<script lang="ts" setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { User } from '~/types/users';

defineProps<{
    university: any
}>();
</script>

<template>
    <div>

        <Head>
            <title>{{ university.name }} University - Sysuniv</title>
        </Head>

        <Link :href="`/universities/${university.id}/edit`" class="link">Modifier cette université</Link>

        <div class="flex flex-col pb-10">
            <div v-if="university.photo">
                <img :src="`/storage/${university.photo.src}`" :alt="university.ame" class="w-32 h-32 rounded-full border-teal-500 border-2" />
            </div>

            <h1 class="mt-10">{{ university.name }}</h1>

            <div class="space-y-1 divide-y mt-6">
                <div>Siteweb: {{ university.website }}</div>
                <div>Adresse: {{ university.address }}</div>
                <div><strong>{{ university.faculties_count }}</strong> faculté(s)</div>
                <div><strong>{{ university.institutes_count }}</strong> institut(s)</div>
                <div><strong>{{ university.departments_count }}</strong> departements(s)</div>
                <div><strong>{{ university.students_count }}</strong> étudiants(s)</div>
            </div>


        </div>
    </div>
</template>