<script lang="ts" setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { useAuth } from '~/composables/auth';
const { isAdmin, isEmployee } = useAuth();

defineProps<{
    faculties: Array<any>
}>();
</script>

<template>
    <div>

        <Head>
            <title>Faculties - Sysuniv</title>
        </Head>
        <h1>Faculties</h1>

        <Link v-if="isAdmin || isEmployee" href="/faculties/create" class="link">Create new faculty</Link>

        <h2><strong>{{ faculties.length }}</strong> {{ `${faculties.length > 1 ? 'faculties' : 'faculty'}`}}</h2>

        <div class="columns-2 gap-10 max-w-md">
            <div v-for="faculty in faculties" class="mb-2" data-test="faculty">
                {{ faculty.name }}
            </div>
        </div>
    </div>
</template>