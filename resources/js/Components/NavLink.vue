<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() => {
    let classes = 'items-center text-sm sm:text-base md:text-lg font-bold font-headerSans';

    if (!props.active) {
        classes += ' text-neutral-500 hover:text-neutral-500 cursor-default'
    }

    return classes;
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
