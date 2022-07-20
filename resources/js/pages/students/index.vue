<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import DefaultLayout from '~/layouts/default.vue';
import { useAuth } from '~/composables/auth';
import StudentList from './components/StudentList.vue';
import StudentPagination from './components/StudentPagination.vue';
import TableFilters from './components/TableFilters.vue';
import { computed } from 'vue';

const { isUniversity } = useAuth();

defineProps({
    students: Object,
});

const urlSearchParams = new URLSearchParams(window.location.search);
const params = Object.fromEntries(urlSearchParams.entries());
const levelList = ['BAC I', 'BAC II', 'BAC III'];

let temp = '';
if (params['filter[gender]']) {
    temp += `${params['filter[gender]']} `.toLowerCase()
}

if (params['filter[results.mention]']) {
    temp += `${params['filter[results.mention]']} `.toLowerCase()
}

if (params['filter[freshmen]']) {
    temp += `inscrits cette année `
}

if (params['filter[registrations.start_date]'] && params['filter[registrations.end_date]']) {
    temp += `inscrits de ${params['filter[registrations.start_date]'] + 'à' + params['filter[registrations.end_date]']} `
}

if (params['filter[registrations.level]']) {
    temp += `en ${levelList[params['filter[registrations.level]']]} `
}

if (params['filter[universities.name]']) {
    temp += `à ${params['filter[universities.name]']} `
}

console.log(temp);

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
                <h2 v-if="students.meta.total > 15">De {{ students.meta.from }} à {{ students.meta.to }} sur {{ students.meta.total }} étudiants</h2>
                <h2 class="" v-else><strong>{{ students.data.length }}</strong> étudiant(s)</h2>
                <TableFilters />
            </div>

            <h2 class="mt-10 mb-8" v-if="students.data.length === 0">{{ `${isUniversity ? 'Aucun étudiant a été inscrit' : 'Aucun étudiant a été enregistré'}` }}</h2>

            <StudentList v-if="students.data.length" :students="students.data" />

            <StudentPagination v-if="students.meta.total > 15" :links="students?.meta.links" />
        </div>
    </DefaultLayout>
</template>