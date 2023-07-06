<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps([
    'copyrightYear',
    'author'
]);
</script>

<template>
    <div class="mb-8">
        <header class="bg-slate-100 py-8 shadow-xl shadow-slate-500 mb-8">
            <div id="site-header" class="container-full">
                <section class="self-center p-3 font-headerSans text-lg text-right">
                    {{ author.tagLine }}
                </section>
                <section class="text-right border-l border-slate-700">
                    <Link :href="route('home')" class="text-neutral-700 hover:text-neutral-700">
                        <img :src="author.image.url" style="max-width: 150px" class="inline" />
                        <h1 class="font-headerSans">{{ author.name }}</h1>
                    </Link>
                    <Link :href="author.linkedInUrl">Connect with me on LinkedIn</Link>
                </section>
            </div>
        </header>

        <slot />

        <footer class="container-full border-t border-slate-500">
            &copy; {{ copyrightYear }} {{ author.name }}
        </footer>
    </div>
</template>
