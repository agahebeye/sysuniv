<script lang="ts" setup>
import { User } from '~/types/users';
import { Head } from '@inertiajs/inertia-vue3';


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
        <table>
            <tr>
                <td v-for="university in universities" data-test="university">{{ university.name }}</td>
            </tr>
        </table>
    </div>
</template>