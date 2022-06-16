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

        <div class="columns-3 gap-8">
            <div v-for="department in departments" data-test="department">
                {{ department.name }}
            </div>
        </div>
    </div>
</template>