<script lang="ts" setup>
import { Link } from '@inertiajs/inertia-vue3';
import { useAuth } from '~/composables/auth';
const { isAdmin, isEmployee } = useAuth();

</script>

<template>
    <div>
        <Link v-if="isAdmin" href="/employees">employees</Link>
        <Link v-if="isAdmin || isEmployee" href="/universities">universities</Link>
        <Link href="/faculties">faculties</Link>
        <Link href="/institutes">institutes</Link>
        <Link href="/departments">departments</Link>
        <Link href="/students">students</Link>
    </div>
</template>