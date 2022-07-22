<script setup>
import { ref } from 'vue';
import { XIcon } from '@heroicons/vue/outline';

const levelList = ['BAC I', 'BAC II', 'BAC III'];
const selectedReport = ref(null);
const resultColors = {
    'Abandonné': 'bg-gray-700',
    'En suspens': 'bg-blue-700',
}

defineProps({
    registrations: Array
});
</script>

<template>
    <div class="report-viewer" v-if="selectedReport">
        <XIcon class="absolute w-10 h-10 text-white cursor-pointer top-10 right-10" @click="selectedReport = null" />
        <img :src="`/storage/${selectedReport.src}`" />
        <div class="bg-white">
        </div>
    </div>
    <h2 class="mt-8">Historique d'inscriptions</h2>
    <table class="">
        <thead class="text-xs text-gray-700 uppercase bg-black dark:bg-gray-700 dark:text-gray-400">
            <tr class="text-left text-white">
                <th scope="col" class="py-2 pl-1">
                    université
                </th>
                <th scope="col" class="py-2 pl-2">
                    faculté/institut
                </th>
                <th scope="col" class="py-2 pl-2">
                    departement
                </th>
                <th scope="col" class="py-2 pl-2">
                    niveau
                </th>
                <th scope="col" class="py-2 pl-2">
                    inscrit le
                </th>
                <th scope="col" class="py-2 pl-2">
                    mention
                </th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="registration in registrations" class="text-sm cursor-pointer odd:bg-white even:bg-gray-200">
                <td class="py-1">{{ registration.university.name }}</td>
                <td class="py-1 pl-2" v-if="registration.faculty">{{ registration.faculty.name }}</td>
                <td class="py-1 pl-2" v-if="registration.institute">{{ registration.institute.name }}</td>
                <td class="py-1 pl-2">{{ registration.department.name }}</td>
                <td class="py-1 pl-2">{{ levelList[registration.level] }}</td>
                <td class="py-1 pl-2">{{ registration.created_at }}</td>
                <td class="py-1 pl-2 text-xs text-center">
                    <span class="font-bold text-gray-800 link" v-if="registration.result" @click="selectedReport = registration.result.report">
                        bulletin
                    </span>
                    <span class="p-0.5 text-white font-bold" v-else-if="!registration.hasAbandoned" :class="resultColors[registration.result ? registration.result.mention : 'En suspens']">
                        {{ registration.result ? registration.result.mention : 'En suspens' }}
                    </span>
                    <span :class="resultColors['Abandonné']" class="text-white p-0.5 font-bold" v-else>
                        Abandonné(e)
                    </span>
                </td>
            </tr>
        </tbody>

    </table>
</template>

<style scoped>
.report-viewer {
    @apply fixed top-0 bottom-0 left-0 right-0 z-40 min-h-screen bg-black/80;
    @apply flex justify-center items-center;
}
</style>