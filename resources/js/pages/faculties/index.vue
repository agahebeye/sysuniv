<script lang="ts" setup>
import { Head } from '@inertiajs/inertia-vue3';

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
        <table>
            <tr v-for="faculty in faculties" data-test="faculty">
                <td>{{ faculty.name }}</td>
            </tr>
        </table>
    </div>
</template>