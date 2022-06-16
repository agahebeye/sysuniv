<script lang="ts" setup>
import { Link } from '@inertiajs/inertia-vue3';
import LinkList from '~/components/shared/LinkList.vue';
import SuccessAlert from '~/components/flash/SuccessAlert.vue';

</script>

<template>
    <div class="flash">
       <SuccessAlert v-if="$page.props.flash['success']" :message="$page.props.flash['success']" />
    </div>

    <div class="pb-6 grid grid-cols-3 md:max-w-4xl md:mx-auto px-6">
        <header class="col-span-full mb-10">
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatum exercitationem labore dicta quibusdam.</p>
        </header>

        <nav class="col-span-1">
            <LinkList class="flex flex-col" />

            <div class="menu-auth">
                <Link href="/logout" method="post" as="button">logout</Link>
            </div>
        </nav>

        <main class="prose col-span-2">
            <slot></slot>
        </main>
    </div>
</template>