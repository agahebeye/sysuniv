<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import DefaultLayout from '~/layouts/default.vue';
import { useAuth } from '~/composables/auth';

import StudentList from './components/StudentList.vue';
import StudentPagination from './components/StudentPagination.vue';
import TableFilters from './components/TableFilters.vue';
import StudentListTitle from './components/StudentListTitle.vue';

const { isUniversity } = useAuth();

defineProps({
    students: Object,
});


</script>

<template>

    <Head>
        <title>Etudiants - Ministère d'éducation au Burundi</title>
    </Head>

    <DefaultLayout>
        <div>
            <h1>Etudiants</h1>

            <Link v-if="isUniversity" href="/registrations/create" class="link">Inscrire un nouveau étudiant</Link>
            <Link v-else href="/students/create" class="link">Enregistrer un nouveau étudiant</Link>

            <div v-if="students.data.length" class="relative flex flex-col mt-10 mb-8">
                <StudentListTitle :meta="students.meta" />
                <TableFilters />
            </div>

            <StudentList v-if="students.data.length" :students="students.data" />

            <StudentPagination v-if="students.meta.total > 15" :links="students?.meta.links" />
        </div>
    </DefaultLayout>
</template>