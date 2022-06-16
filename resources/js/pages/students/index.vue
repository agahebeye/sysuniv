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

        <Link v-if="isAdmin || isEmployee" href="/students/create" class="link">Register new student</Link>
        <Link v-if="isUniversity" href="/registrations/create" class="link">Enroll new student</Link>

        <h2><strong>{{ students.length }}</strong> students</h2>

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