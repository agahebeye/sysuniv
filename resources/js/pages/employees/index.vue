<script lang="ts" setup>
import {User} from '~/types/users';

defineProps<{
    employees: User[]
}>();

</script>

<template>
    <table>
        <tr>
            <td v-for="employee in employees" data-test="employee">{{ employee.name }}</td>
        </tr>
    </table>
</template>