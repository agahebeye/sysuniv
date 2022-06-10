<script lang="ts" setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { useAuth } from '~/composables/auth';
const { isAdmin, isEmployee, isUniversity } = useAuth();

const props = defineProps<{
    students: Array<any>
}>();

</script>

<template>
    <div>

        <Head>
            <title>Students - Sysuniv</title>
        </Head>

        <h1>Students</h1>

        <div>
            <Link v-if="isAdmin || isEmployee" href="/students/create">register new student</Link>
            <Link v-if="isUniversity" href="/registrations/create">enroll new student</Link>
        </div>

        <table>
            <tr v-for="student in students" data-test="student">
                <Link :href="`/students/${student.id}`">
                <td>{{ student.firstname }}</td>
                <td>{{ student.lastname }}</td>
                </Link>
            </tr>
        </table>
    </div>
</template>