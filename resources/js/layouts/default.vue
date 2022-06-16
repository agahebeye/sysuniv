<script lang="ts" setup>
import { Link } from '@inertiajs/inertia-vue3';
import LinkList from '~/components/shared/LinkList.vue';

</script>

<template>
    <div class="message">
        <div v-if="$page.props.flash['success']">
            {{ $page.props.flash['success'] }}
        </div>
    </div>

    <div class="page--wrapper grid">
        <header class="">
        </header>

        <nav>
            <LinkList class="flex flex-col" />

            <div class="menu-auth">
                <Link href="/logout" method="post" as="button">logout</Link>
            </div>
        </nav>

        <main class="prose">
            <slot></slot>
        </main>
    </div>
</template>