<script lang="ts" setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { User } from '~/types/users';
import { useAuth } from '~/composables/auth';

const { isAdmin, isEmployee } = useAuth();

defineProps<{
    employees: User[]
}>();

</script>

<template>
    <div>

        <Head>
            <title>Employees - Sysuniv</title>
        </Head>

        <h1>Employées</h1>

        <Link v-if="isAdmin || isEmployee" href="/employees/create" class="link">Créer une nouvelle employée</Link>

        <h2 class="mt-10 mb-8" v-if="employees.length"><strong>{{ employees.length }}</strong> employée(s)</h2>
        <h2 class="mt-10 mb-8" v-else>Aucune employée enregistrée à la base</h2>

        <div class="columns-3 gap-12 max-w-xl">
            <div v-for="employee in employees" class="mb-4 flex items-center space-x-3" data-test="employee">
                <img class="w-8 max-w-full rounded-full" src="/storage/avatars/avatar-placeholder.jpeg" :alt="`${employee.name} profile avatar`" />
                <div class="text-base">
                    {{ employee.name }}
                </div>
            </div>
        </div>
    </div>
</template>