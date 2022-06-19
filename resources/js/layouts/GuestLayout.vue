<template>
    <div class="flex h-[100vh] w-full">
        <header class="w-96 bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 min-h-screen flex items-center">
             <div class="px-10 text-sm space-y-3">
                <div>Republique du Burundi</div>
                <div>Ministère de l'éducation nationale et de la recherche scientifique</div>
            </div>
        </header>

        <main class="prose max-w-none flex items-center pl-20 pr-6">
            <slot />
        </main>
    </div>
</template>