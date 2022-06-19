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

        <h2 v-if="departments.length"><strong>{{ departments.length }}</strong> departments</h2>
        <h2 v-else>No departments already registered</h2>

        <div class="columns-2 gap-10 max-w-md">
            <div v-for="department in departments" class="mb-2" data-test="department">
                {{ department.name }}
            </div>
        </div>
    </div>
</template>