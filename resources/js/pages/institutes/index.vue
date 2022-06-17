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

        <h2><strong>{{ institutes.length }}</strong> institute(s)</h2>

        <div class="">
            <div v-for="institute in institutes" class="mb-4" data-test="institute">
                {{ institute.name }}
            </div>
        </div>
    </div>
</template>