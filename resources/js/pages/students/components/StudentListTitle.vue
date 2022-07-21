<script setup>
defineProps({
    meta: Object
})

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

if (params['filter[registrations.start_date]']) {
    temp += `inscrits de ${params['filter[registrations.start_date]']} `
}
if (params['filter[registrations.end_date]']) {
    temp += `inscrits jusqu'à' + params['filter[registrations.end_date]']} `
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

</script>

<template>
    <h2>De {{ meta.from }} à {{ meta.to }} sur {{ meta.total }} étudiants</h2>
</template>