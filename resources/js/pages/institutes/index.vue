<script lang="ts" setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { useAuth } from '~/composables/auth';
const { isAdmin, isEmployee } = useAuth();

defineProps<{
    institutes: Array<any>
}>();
</script>

<template>
    <div>

        <Head>
            <title>Institutes - Sysuniv</title>
        </Head>

        <h1>Institutes</h1>

        <Link v-if="isAdmin || isEmployee" href="/institutes/create" class="link">Create new institute</Link>

        <h2 v-if="institutes.length"><strong>{{ institutes.length }}</strong> institutes</h2>
        <h2 v-else>No institutes already registered</h2>

        <div class="columns-2 gap-10 max-w-md">
            <div v-for="institute in institutes" class="mb-2" data-test="institute">
                {{ institute.name }}
            </div>
        </div>
    </div>
</template>