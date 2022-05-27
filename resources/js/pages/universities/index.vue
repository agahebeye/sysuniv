<script lang="ts" setup>
import { User } from '~/types/users';
import { Head, Link } from '@inertiajs/inertia-vue3';
import {useAuth} from '~/composables/auth';

const {isAdmin, isEmployee} = useAuth();

defineProps<{
    universities: Array<User>
}>();
</script>

<template>

    <Head>
        <title>Universities - Sysuniv</title>
    </Head>

    <div>
        <h1>Universities</h1>

        <div>
            <Link v-if="isAdmin || isEmployee" href="/universities/create">add new university</Link>
        </div>

        <table>
            <tr v-for="university in universities" data-test="university">
                <td>{{ university.name }}</td>
            </tr>
        </table>
    </div>
</template>