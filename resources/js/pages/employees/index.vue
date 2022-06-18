<script lang="ts" setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { User } from '~/types/users';
import { useAuth } from '~/composables/auth';

const { isAdmin, isEmployee } = useAuth();

defineProps<{
    employees: User[]
}>();

</script>

<template>
    <div>

        <Head>
            <title>Employees - Sysuniv</title>
        </Head>

        <h1>Employees</h1>

        <Link v-if="isAdmin || isEmployee" href="/employees/create" class="link">Create new employee</Link>

        <h2><strong>{{ employees.length }}</strong> employees</h2>

        <div class="columns-2 gap-10 max-w-md">
            <div v-for="employee in employees" class="mb-2" data-test="employee">
                {{ employee.name }}
            </div>
        </div>
    </div>
</template>