<script lang="ts" setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { useAuth } from '~/composables/auth';
const { isAdmin, isEmployee } = useAuth();

defineProps<{
    institutes: Array<any>
}>();
</script>

<template>

    <Head>
        <title>Institutes - Sysuniv</title>
    </Head>

    <div>
        <h1>Institutes</h1>

        <div>
            <Link v-if="isAdmin || isEmployee" href="/institutes/create">add new institute</Link>
        </div>

        <table>
            <tr v-for="institute in institutes" data-test="institute">
                <td>{{ institute.name }}</td>
            </tr>
        </table>
    </div>
</template>