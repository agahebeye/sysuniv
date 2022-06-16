<script lang="ts" setup>
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { useAuth } from '~/composables/auth';
const { isAdmin, isEmployee, isUniversity } = useAuth();

const props = defineProps<{
    students: any
}>();

function takeme(url: string) {
    Inertia.visit(url);
}

</script>

<template>
    <div>

        <Head>
            <title>Students - Sysuniv</title>
        </Head>

        <h1>Students</h1>

        <Link v-if="isAdmin || isEmployee" href="/students/create" class="link">Register new student</Link>
        <Link v-if="isUniversity" href="/registrations/create" class="link">Enroll new student</Link>

        <h2><strong>{{ students.data.length }}</strong> students</h2>

        <table>
            <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="pl-2 py-2">
                        firstname
                    </th>
                    <th scope="col" class="px-4 py-2">
                        lastname
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="student in students.data" class="cursor-pointer hover:bg-gray-100" @click="takeme(`/students/${student.id}`)" data-test="student">
                    <td class="pl-2 py-1">{{ student.firstname }}</td>
                    <td class="pl-2 py-1">{{ student.lastname }}</td>
                </tr>
            </tbody>

        </table>
    </div>
</template>