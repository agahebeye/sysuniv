<script lang="ts" setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { User } from '~/types/users';

defineProps<{
    university: User
}>();
</script>

<template>
    <div>

        <Head>
            <title>{{ university.name }} University - Sysuniv</title>
        </Head>

        <div>
            <p>
                <Link :href="`/universities/${university.id}/edit`">update this university</Link>
            </p>
            <p>{{ university }}</p>
        </div>
    </div>
</template>