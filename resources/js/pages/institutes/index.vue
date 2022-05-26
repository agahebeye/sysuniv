<script lang="ts" setup>
import { Head } from '@inertiajs/inertia-vue3';

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
        <table>
            <tr v-for="institute in institutes" data-test="institute">
                <td>{{ institute.name }}</td>
            </tr>
        </table>
    </div>
</template>