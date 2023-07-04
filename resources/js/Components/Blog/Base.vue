<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps([

]);
</script>

<template>
    <div>
        <header>
            <div id="logo-header">
                <Link :href="route('home')">
                    A logo
                </Link>
            </div>

            <nav>
                <ul>
                    <li>
                        A link
                    </li>
                </ul>
            </nav>
        </header>

        <slot />
    </div>
</template>
