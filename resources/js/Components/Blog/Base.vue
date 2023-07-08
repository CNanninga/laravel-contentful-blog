<script setup>
import { Link } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';

const props = defineProps([
    'copyrightYear',
    'navLinks',
    'author'
]);
</script>

<template>
    <div class="mb-8">
        <header class="bg-slate-100 py-8 shadow-xl shadow-slate-500 mb-8">
            <div id="site-header" class="container-full">
                <section id="site-title" class="text-center md:text-right border-0 md:border-l border-slate-700 mb-4 md:mb-0">
                    <Link :href="route('home')" class="text-neutral-700 hover:text-neutral-700">
                        <img :src="author.image.url" style="max-width: 150px" class="inline" />
                        <h1 class="font-headerSans">{{ author.name }}</h1>
                    </Link>
                    <Link :href="author.linkedInUrl">Connect with me on LinkedIn</Link>
                </section>
                <section id="site-tag" class="self-center p-3 font-headerSans text-lg text-right hidden md:block">
                    {{ author.tagLine }}
                </section>
                <nav id="site-nav" class="container-full self-end text-center">
                    <ul class="list-none m-0">
                        <li v-for="link in navLinks" :key="link.url" class="inline mx-6">
                            <NavLink :href="link.url" :active="true">
                                {{ link.label }}
                            </NavLink>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>

        <slot />

        <footer class="container-full border-t border-slate-500">
            &copy; {{ copyrightYear }} {{ author.name }}
        </footer>
    </div>
</template>
