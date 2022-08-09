<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import DefaultLayout from '~/layouts/default.vue';
import { useAuth } from '~/composables/auth';
import { useFilteredTitle } from '~/composables/filtered-title';

import StudentList from './components/StudentList.vue';
import StudentPagination from './components/StudentPagination.vue';
import TableFilters from './components/TableFilters.vue';

const props = defineProps({
    students: Object,
    filters: Object,
});

const { isUniversity } = useAuth();
const filteredTitle = useFilteredTitle(props.filters)


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

            <h2 class="mt-8" v-if="students.meta.total > 15">De {{ students.meta.from }} à {{ students.meta.to }} sur {{ students.meta.total }} étudiants <span v-html="filteredTitle"></span></h2>
            <h2 class="mt-8" v-if="students.meta.total > 0 && students.meta.total < 15">{{ students.meta.total }} étudiants <span v-html="filteredTitle"></span></h2>
            <h2 class="mt-8" v-if="students.meta.total === 0">Aucun étudiant <span v-html="filteredTitle"></span></h2>
            
            <TableFilters :filters="filters" v-if="students.data.length || Object.keys(filters).length > 0" />

            <StudentList v-if="students.data.length" :students="students.data" />

            <StudentPagination v-if="students.meta.total > 15" :links="students?.meta.links" />
        </div>
    </DefaultLayout>
</template>