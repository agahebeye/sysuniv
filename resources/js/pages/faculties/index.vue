<script lang="ts" setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { useAuth } from '~/composables/auth';
const {isAdmin, isEmployee} = useAuth();

defineProps<{
    faculties: Array<any>
}>();
</script>

<template>

    <Head>
        <title>Faculties - Sysuniv</title>
    </Head>

    <div>
        <h1>Faculties</h1>

        <div>
            <Link v-if="isAdmin || isEmployee" href="/faculties/create">add new faculty</Link>
        </div>

        <table>
            <tr v-for="faculty in faculties" data-test="faculty">
                <td>{{ faculty.name }}</td>
            </tr>
        </table>
    </div>
</template>