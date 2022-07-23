<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import DefaultLayout from '~/layouts/default.vue';
import { onUpdated, ref } from 'vue';
import { useAuth } from '~/composables/auth';

import StudentList from './components/StudentList.vue';
import StudentPagination from './components/StudentPagination.vue';
import TableFilters from './components/TableFilters.vue';

const { isUniversity } = useAuth();

const props = defineProps({
    students: Object,
    filters: Object,
});

const filteredTitle = ref(generateFilteredTitle());

onUpdated(() => { filteredTitle.value = generateFilteredTitle(props.title) })

function generateFilteredTitle() {
    let temp = '';
    const levelList = ['BAC 1', 'BAC 2', 'BAC 3'];
    const filters = props.filters;

    if (filters['gender']) temp += `${filters['gender']}(s) `.toLowerCase();
    if (filters['results.mention']) temp += `${filters['results.mention']} `.toLowerCase();
    if (filters['freshmen']) temp += `inscrit(s) cette année `;
    if (filters['registrations.start_date'] && filters['registrations.end_date']) temp += `inscrit(s) entre ${filters['registrations.start_date'] + ' et ' + filters['registrations.end_date']} `
    if (filters['registrations.level']) temp += `en ${levelList[filters['registrations.level']]} `;
    if (filters['universities.name']) temp += ` à ${filters['universities.name']} `
    if (filters['search']) temp += `dont le nom commence <strong>"${filters['search']}"</strong> `

    return temp;
}

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

            <TableFilters :filters="filters" />

            <StudentList v-if="students.data.length" :students="students.data" />

            <StudentPagination v-if="students.meta.total > 15" :links="students?.meta.links" />
        </div>
    </DefaultLayout>
</template>