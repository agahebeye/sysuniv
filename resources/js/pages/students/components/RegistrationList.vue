<script setup>

const levelList = ['BAC I', 'BAC II', 'BAC III'];

defineProps({
    registrations: Array
});
</script>

<template>
    <h2>Registrations history</h2>
    <table>
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
                    enrolled on
                </th>
                <th scope="col" class="px-2 py-2">
                    result status
                </th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="registration in registrations" class="cursor-pointer hover:bg-gray-100" data-test="student">
                <!--<td>{{ registration }}</td>-->
                <td class="pl-2 py-1">{{ registration.university.name }}</td>
                <td class="pl-2 py-1">{{ registration.faculty.name }}</td>
                <td class="pl-2 py-1">{{ registration.department.name }}</td>
                <td class="pl-2 py-1">{{ levelList[registration.level] }}</td>
                <td class="pl-2 py-1">{{ registration.created_at }}</td>
                <td class="pl-2 py-1">{{ registration.resultStatus }}</td>
            </tr>
        </tbody>

    </table>
</template>