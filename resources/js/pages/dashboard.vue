<script lang="ts" setup>
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <div>

        <Head>
            <title>Dashboard - Sysuniv</title>
        </Head>

        <div>

            <p>Welcome to the dashboard</p>

            <h1>{{ $page.props.auth['user'].name }}</h1>
        </div>


    </div>
</template>