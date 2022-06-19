<script lang="ts" setup>
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { useAuth } from '~/composables/auth';
import StudentList from './components/StudentList.vue';
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

        <h2 v-if="students.length" class="!mb-0">{{ students.meta.from }} to {{ students.meta.to }} of {{ students.meta.total }} student(s)</h2>
        <h2 v-else>No students already registered</h2>

        <div class="pagination" v-if="students.meta.links.length">
            <Component
                :is="link.url ? Link : 'span'"
                v-for="link in students.meta.links"
                :href="link.url"
                v-html="link.label"
                class="px-1 text-xs no-underline"
                :class="{ 'text-black': link.url, 'font-bold': link.active }" />
        </div>

       <StudentList v-if="students.data.length" :students="students.data" />
    </div>
</template>