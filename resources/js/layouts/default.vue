<script lang="ts" setup>
import { Link, usePage } from '@inertiajs/inertia-vue3';
const { user } = usePage().props.value.auth as any;
</script>

<template>
    <div class="page--wrapper">
        <header>
            <nav>
                <div>
                    <Link href="/">home</Link>
                    <Link v-if="user.role === 'admin'" href="/employees">employees</Link>
                    <Link href="/universities">universities</Link>
                </div>

                <div class="menu-auth">
                    <Link href="/logout" method="post" as="button">logout</Link>
                </div>
            </nav>
        </header>
        <main>
            <div>
                <slot></slot>
            </div>
        </main>
    </div>
</template>

<style scoped>
.page--wrapper {
    display: flex;
    gap: 30px;
}

.menu-auth {
    margin-top: 20px;
    border-top: 1px #a0a0a0 solid;
    padding-top: 20px;
}

nav a {
    display: block;
}
</style>