<script lang="ts" setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { User } from '~/types/users';
import {useAuth} from '~/composables/auth';

const {isAdmin, isEmployee} = useAuth();

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

         <div>
            <Link v-if="isAdmin || isEmployee" href="/employees/create">add new employee</Link>
        </div>

        <table>
            <tr v-for="employee in employees" data-test="employee">
                <td>{{ employee.name }}</td>
            </tr>
        </table>
    </div>
</template>