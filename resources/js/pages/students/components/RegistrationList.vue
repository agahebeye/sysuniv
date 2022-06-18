<script setup>

const levelList = ['BAC I', 'BAC II', 'BAC III'];
const resultColors = {
    'PENDING': 'bg-gray-700',
    'FAILED': 'bg-red-700',
    'PASSED': 'bg-teal-700',
}

defineProps({
    registrations: Array
});
</script>

<template>
    <h2>Registrations history</h2>
    <table class="max-w-2xl">
        <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="pl-2 py-2">
                    university
                </th>
                <th scope="col" class="px-2 py-2">
                    faculty
                </th>
                <th scope="col" class="px-2 py-2">
                    department
                </th>
                <th scope="col" class="px-2 py-2">
                    level
                </th>
                <th scope="col" class="px-2 py-2">
                    enrolled
                </th>
                <th scope="col" class="px-2 py-2">
                    result status
                </th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="registration in registrations" class="" data-test="student">
                <!--<td>{{ registration }}</td>-->
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