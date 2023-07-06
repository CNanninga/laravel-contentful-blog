<script setup>
import Base from '@/Components/Blog/Base.vue';
import ListNav from '@/Components/Blog/ListNav.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps([
    'copyrightYear',
    'author',
    'posts',
    'prevPageUrl',
    'nextPageUrl',
]);
</script>

<template>
    <Base :copyrightYear="copyrightYear" :author="author">
        <ListNav :prevPageUrl="prevPageUrl" :nextPageUrl="nextPageUrl"></ListNav>

        <div id="post-list" class="container-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <article v-for="post in posts" :key="post.slug">
                <img :src="post.image.url" />
                <header>
                    <h2>
                        <Link :href="post.url" class="text-neutral-700 hover:text-neutral-500">{{ post.title }}</Link>
                    </h2>
                    <div class="font-bold">{{ post.publishDate }}</div>
                </header>
                <div v-html="post.description">
                </div>
            </article>
        </div>

        <ListNav :prevPageUrl="prevPageUrl" :nextPageUrl="nextPageUrl"></ListNav>
    </Base>
</template>
