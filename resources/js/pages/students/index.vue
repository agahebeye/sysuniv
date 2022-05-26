<script lang="ts" setup>
import { Head } from '@inertiajs/inertia-vue3';

const props = defineProps<{
    students: Array<any>
}>();

</script>

<template>

    <Head>
        <title>Students - Sysuniv</title>
    </Head>

    <div>
        <h1>Students</h1>
        <table>
            <tr v-for="student in students" data-test="student">
                <td>{{ student.firstname }}</td>
                <td>{{ student.lastname }}</td>
            </tr>
        </table>
    </div>
</template>