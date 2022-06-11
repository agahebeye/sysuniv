<script lang="ts" setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <div>

        <Head>
            <title>Dashboard - Sysuniv</title>
        </Head>

        <div>

            <p>Welcome to the dashboard</p>

            <Link href="/request-password-reset">Reset your password</Link>

            <h1>{{ $page.props.auth['user'].name }}</h1>

            <p>{{ $page.props.auth['user'].photo }}</p>
        </div>


    </div>
</template>