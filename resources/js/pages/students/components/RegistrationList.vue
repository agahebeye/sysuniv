<script setup>

const levelList = ['BAC I', 'BAC II', 'BAC III'];
const resultColors = {
    'Abandonné': 'bg-gray-700',
    'En suspens': 'bg-blue-700',
    'Echoué': 'bg-red-700',
    'Réussi': 'bg-teal-700',
    'Réussi avec complément(s)': 'bg-teal-700',
}

defineProps({
    registrations: Array
});
</script>

<template>
    <h2 class="mt-8">Historique d'inscriptions</h2>
    <table class="">
        <thead class="text-xs text-gray-700 uppercase bg-black dark:bg-gray-700 dark:text-gray-400">
            <tr class="text-left text-white">
                <th scope="col" class="py-2 pl-2">
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
                    état d'inscription
                </th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="registration in registrations" class="text-sm cursor-pointer hover:bg-gray-400 odd:bg-white even:bg-gray-200">
            {{ registration }}
                <td class="py-1 pl-2">{{ registration.university.name }}</td>
                <td class="py-1 pl-2">{{ registration.faculty.name }}</td>
                <td class="py-1 pl-2">{{ registration.department.name }}</td>
                <td class="py-1 pl-2">{{ levelList[registration.level] }}</td>
                <td class="py-1 pl-2">{{ registration.created_at }}</td>
                <td class="py-1 pl-2 text-center">
                    <span class="p-0.5 text-white font-bold text-xs" :class="resultColors[registration.resultStatus]">{{ registration.resultStatus }}</span>
                </td>
            </tr>
        </tbody>

    </table>
</template>