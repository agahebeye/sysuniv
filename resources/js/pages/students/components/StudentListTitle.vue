<script setup>
import { ref, onMounted, onUpdated } from 'vue';

defineProps({
    meta: Object
})

const levelList = ['BAC I', 'BAC II', 'BAC III'];

let filteredTitle = ref('');

onMounted(function () {
    filteredTitle.value = setFilteredTitle();
})

onUpdated(function () {
    filteredTitle.value = setFilteredTitle();
})

function setFilteredTitle() {
    const urlSearchParams = new URLSearchParams(window.location.search);
    const params = Object.fromEntries(urlSearchParams.entries());

    let temp = '';

    if (params['filter[gender]']) temp += `${params['filter[gender]']}s `.toLowerCase();
    if (params['filter[results.mention]']) temp += `${params['filter[results.mention]']} `.toLowerCase();
    if (params['filter[abandoned]']) temp += 'abandonnés ';
    if (params['filter[freshmen]']) temp += `inscrits cette année `;
    if (params['filter[registrations.start_date]'] && params['filter[registrations.end_date]']) temp += `inscrits entre ${params['filter[registrations.start_date]'] + ' et ' + params['filter[registrations.end_date]']} `
    if (params['filter[registrations.level]']) temp += `en ${levelList[params['filter[registrations.level]']]} `;
    if (params['filter[universities.name]']) temp += `à ${params['filter[universities.name]']} `

    return temp;
}
</script>

<template>
    <h2 v-if="meta.total">
        De {{ meta.from }} à {{ meta.to }} sur {{ meta.total }} étudiants {{ filteredTitle }}
    </h2>
    <h2 v-else>
        Aucun étudiant {{ filteredTitle }} trouvé
    </h2>
</template>