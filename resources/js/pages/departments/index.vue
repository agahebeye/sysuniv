<script lang="ts" setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { useAuth } from '~/composables/auth';
const { isAdmin, isEmployee } = useAuth();

defineProps<{
    departments: Array<any>
}>();
</script>

<template>

    <Head>
        <title>Departments - Sysuniv</title>
    </Head>

    <div>
        <h1>Departments</h1>

        <div>
            <Link v-if="isAdmin || isEmployee" href="/departments/create">add new department</Link>
        </div>

        <table>
            <tr v-for="department in departments" data-test="department">
                <td>{{ department.name }}</td>
            </tr>
        </table>
    </div>
</template>