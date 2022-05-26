<script lang="ts" setup>
import { Head } from '@inertiajs/inertia-vue3';
import { User } from '~/types/users';

defineProps<{
    employees: User[]
}>();

</script>

<template>

    <Head>
        <title>Employees - Sysuniv</title>
    </Head>

    <div>
        <h1>Employees</h1>
        <table>
            <tr v-for="employee in employees" data-test="employee">
                <td>{{ employee.name }}</td>
            </tr>
        </table>
    </div>
</template>