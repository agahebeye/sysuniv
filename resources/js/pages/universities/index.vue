<script lang="ts" setup>
import { User } from '~/types/users';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { useAuth } from '~/composables/auth';
import DefaultLayout from '~/layouts/default.vue';

const { isAdmin, isEmployee } = useAuth();

defineProps<{
    universities: Array<any>
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

            <div class="grid grid-cols-2 gap-6">
                <div v-for="university in universities" class="flex items-center space-x-3" data-test="university">
                    <img class="w-10 max-w-full rounded-full"
                        :src="`/storage/${university.photo?.src ?? 'avatars/university_placeholder.png'}`"
                        :alt="university.name" />
                    <div class="text-base">
                        <Link :href="`/universities/${university.id}`">
                        {{ university.name }}
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>