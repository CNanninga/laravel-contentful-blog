<script setup>
import Base from '@/Components/Blog/Base.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps([
    'posts',
    'prevPageUrl',
    'nextPageUrl',
]);
</script>

<template>
    <Base>
        <section id="list-nav">
            <span>
                <Link :href="prevPageUrl">
                    Newer
                </Link>
            </span>
            <span>
                <Link :href="nextPageUrl">
                    Older
                </Link>
            </span>
        </section>

        <div id="post-list">
            <article v-for="post in posts" :key="post.slug">
                <header>
                    <h2>
                        <Link :href="post.url">{{ post.title }}</Link>
                    </h2>
                    <div >{{ post.publishDate }}</div>
                </header>
                <div>
                    {{ post.description }}
                </div>
            </article>
        </div>
    </Base>
</template>
