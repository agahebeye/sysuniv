<script lang="ts" setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { useAuth } from '~/composables/auth';
const { isAdmin, isEmployee } = useAuth();

defineProps<{
    departments: Array<any>
}>();
</script>

<template>
    <div>

        <Head>
            <title>Departments - Sysuniv</title>
        </Head>
        <h1>Departments</h1>

        <Link v-if="isAdmin || isEmployee" href="/departments/create" class="link">Create new department</Link>

        <h2 class="mt-10 mb-8" v-if="departments.length"><strong>{{ departments.length }}</strong> department(s)</h2>
        <h2 class="mt-10 mb-8" v-else>Aucune department a été enregistré</h2>

        <div class="columns-3 gap-12 max-w-2xl">
            <div v-for="department in departments" class="mb-2" data-test="department">
                {{ department.name }}
            </div>
        </div>
    </div>
</template>