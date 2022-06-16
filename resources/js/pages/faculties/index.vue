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

        <div class="columns-3 gap-8">
            <div v-for="faculty in faculties" data-test="faculty">
                {{ faculty.name }}
            </div>
        </div>
    </div>
</template>