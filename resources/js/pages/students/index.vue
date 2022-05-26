<script lang="ts" setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { useAuth } from '~/composables/auth';
const { isAdmin, isEmployee, isUniversity } = useAuth();

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
        
        <div>
            <Link v-if="isAdmin || isEmployee" href="/students/create">register new student</Link>
            <Link v-if="isUniversity" href="/registrations/create">enroll new student</Link>
        </div>

        <table>
            <tr v-for="student in students" data-test="student">
                <td>{{ student.firstname }}</td>
                <td>{{ student.lastname }}</td>
            </tr>
        </table>
    </div>
</template>