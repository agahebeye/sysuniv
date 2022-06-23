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

        <h2 class="mt-10 mb-8" v-if="institutes.length"><strong>{{ institutes.length }}</strong> universitée(s)</h2>
        <h2 class="mt-10 mb-8" v-else>Aucune institut a été enregistré</h2>

        <div class="columns-3 gap-12 max-w-2xl">
            <div v-for="institute in institutes" class="mb-2" data-test="institute">
                {{ institute.name }}
            </div>
        </div>
    </div>
</template>