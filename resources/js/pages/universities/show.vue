<script lang="ts" setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import DefaultLayout from '~/layouts/default.vue'
import UniversityPlaceholder from '~/../assets/icons/UniversityPlaceholder.svg';

defineProps<{
    university: any
}>();
</script>

<template>

    <Head>
        <title>Université "{{ university.name }}" - Ministère d'éducation du Burundi</title>
    </Head>

    <DefaultLayout>
        <div>
            <Link :href="`/universities/${university.id}/edit`" class="link">Modifier cette université</Link>

            <div class="flex flex-col pb-10 mt-4">
                <img v-if="university.photo" :src="`/storage/${university.photo?.src}`" :alt="university.ame" class="object-contain w-48 h-48" />
                <UniversityPlaceholder v-else class="w-56 h-56" />

                <h1 class="mt-10">{{ university.name }}</h1>

                <div class="mt-6 space-y-1">
                    <div>Siteweb: {{ university.website }}</div>
                    <div>Adresse: {{ university.address }}</div>
                    <div><strong>{{ university.faculties_count }}</strong> faculté(s)</div>
                    <div><strong>{{ university.institutes_count }}</strong> institut(s)</div>
                    <div><strong>{{ university.departments_count }}</strong> departements(s)</div>
                    <div><strong>{{ university.students_count }}</strong> étudiants(s)</div>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>