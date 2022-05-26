<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <div>
        <header>
            <nav>
                <Link href="/universities">universities</Link>
            </nav>
        </header>
        <main>
            <div>
                <slot></slot>
            </div>
        </main>
    </div>
</template>