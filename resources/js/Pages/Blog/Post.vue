<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import Base from '@/Components/Blog/Base.vue';

const props = defineProps([
    'post'
]);
</script>

<template>
    <Base>
        <article id="post">
            <header>
                <h2>{{ post.title }}</h2>
                <div id="publish-date">{{ post.publishDate }}</div>
            </header>
            <div>
                <template v-if="post.contentItems.items">
                    <div v-for="(item, index) in post.contentItems.items" :key="index">
                        <div v-if="item.__typename == 'ContentText'" v-html="item.content"></div>
                        <img v-if="item.__typename == 'ContentImage'" :alt="item.image.description" :src="item.image.url" />
                    </div>
                </template>
            </div>
        </article>
    </Base>
</template>
