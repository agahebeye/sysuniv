<script setup>

const levelList = ['BAC I', 'BAC II', 'BAC III'];
const resultColors = {
    'ABANDONED': 'bg-gray-700',
    'PENDING': 'bg-blue-700',
    'FAILED': 'bg-red-700',
    'PASSED': 'bg-teal-700',
}

defineProps({
    registrations: Array
});
</script>

<template>
    <h2 class="mt-8">Historique d'inscriptions</h2>
    <table class="w-[760px] table-fixed">
        <thead class="text-xs text-gray-700 uppercase bg-black dark:bg-gray-700 dark:text-gray-400">
            <tr class="text-left text-white">
                <th scope="col" class="pl-2 py-2">
                    université
                </th>
                <th scope="col" class="pl-2 py-2">
                    faculté/institut
                </th>
                <th scope="col" class="pl-2 py-2">
                    departement
                </th>
                <th scope="col" class="pl-2 py-2">
                    niveau
                </th>
                <th scope="col" class="pl-2 py-2">
                    inscrit le
                </th>
                <th scope="col" class="pl-2 py-2">
                    état d'inscription
                </th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="registration in registrations" class="cursor-pointer hover:bg-gray-400 text-sm odd:bg-white even:bg-gray-200">
                <td class="pl-2 py-1">{{ registration.university.name }}</td>
                <td class="pl-2 py-1">{{ registration.faculty.name }}</td>
                <td class="pl-2 py-1">{{ registration.department.name }}</td>
                <td class="pl-2 py-1">{{ levelList[registration.level] }}</td>
                <td class="pl-2 py-1">{{ registration.created_at }}</td>
                <td class="pl-2 py-1 text-center">
                    <span class="p-0.5 text-white font-bold text-xs" :class="resultColors[registration.resultStatus]">{{ registration.resultStatus }}</span>
                </td>
            </tr>
        </tbody>

    </table>
</template>