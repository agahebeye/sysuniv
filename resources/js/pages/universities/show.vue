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

        <Link :href="`/universities/${university.id}/edit`" class="text-sm font-bold">Update this university</Link>

        <div class="flex flex-col pb-10">
            <div v-if="university.photo">
                <img :src="`/storage/${university.photo.src}`" :alt="university.ame" class="w-32 h-32 rounded-full border-teal-500 border-2" />
            </div>

            <h2 class="my-2">{{ university.name }}</h2>

            <div class="space-y-1">
                <div>Website {{ university.website }}</div>
                <div>Located at <em>{{ university.address }}</em></div>
                <div class="space-x-2">
                    <span>Faculties: <span class="bg-teal-700 text-white text-xs font-medium mr-2 px-1.5 py-0.5 rounded-full dark:bg-teal-700 dark:text-teal-700">{{ university.faculties_count }}</span> , </span>
                    <span>Institutes: <span class="bg-teal-700 text-white text-xs font-medium mr-2 px-1.5 py-0.5 rounded-full dark:bg-teal-700 dark:text-teal-700">{{ university.institutes_count }}</span></span>
                </div>
            </div>


        </div>
    </div>
</template>