<script lang="ts" setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import { useAuth } from '~/composables/auth';
const {isAdmin, isEmployee} = useAuth();

</script>

<template>
    <div class="page--wrapper">
        <header>
            <nav>
                <div>
                    <Link href="/">home</Link>
                    <Link v-if="isAdmin" href="/employees">employees</Link>
                    <Link v-if="isAdmin || isEmployee" href="/universities">universities</Link>
                    <Link href="/faculties">faculties</Link>
                    <Link href="/institutes">institutes</Link>
                    <Link href="/students">students</Link>
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