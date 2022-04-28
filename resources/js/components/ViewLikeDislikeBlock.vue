<script setup>
defineProps({
    views: {type: Number},
    likes: {type: Number},
    dislikes: {type: Number},
});
</script>
<template>
    <div class="flex justify-end text-sm">
        <div class="flex justify-between text-sm">
            <p><img class="h-5" src="/svg/eye.svg" alt=""></p>
            <p>&nbsp;</p>
            <p class="mx-1 w-12">
                {{
                    this.getCount(views)
                }}</p>
        </div>
        <div class="wrapper flex-column mx-6 w-fit position-relative"
             :style="{ '--color-line' : 'linear-gradient(to right, #F09FE8 ' + this.likePercent + '%, #541B1B 0%, #541B1B)'}">
            <div class="flex">
                <div class="flex justify-between text-sm">
                    <p><img class="h-5" src="/svg/like.svg" alt=""></p>
                    <p>&nbsp;</p>
                    <p class="ml-0 w-12 mr-2">
                        {{
                            this.getCount(likes)
                        }}</p>
                </div>
                <div class="flex justify-between text-sm">
                    <p><img class="h-5" src="/svg/dislike.svg" alt=""></p>
                    <p>&nbsp;</p>
                    <p class="mx-0 w-auto">
                        {{
                            this.getCount(dislikes)
                        }}</p>
                </div>
            </div>

        </div>
        <div class="hover:cursor-pointer" @click="onSend">
            <img class="h-5 mr-5" src="/svg/send.svg" alt="">
        </div>
        <div class="hover:cursor-pointer w-fit pl-2 pr-1" @click="onMore">
            <img class="h-5" src="/svg/more.svg" alt="">
        </div>
    </div>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue3';

export default {
    name: "ViewLikeDislikeBlock",
    components: {
        Link,
    },
    methods: {
        getCount(count) {
            return (count > 10000 ? Math.trunc(count / 1000) + 'k.' : count + '');
        },
        onSend() {
            this.$emit('send', this);
        },
        onMore() {
            this.$emit('more', this);
        },
    },
    computed: {
        likePercent() {
            return Math.trunc(this.likes * 100 / (this.likes + this.dislikes));
        }
    }
}
</script>

<style scoped>
.wrapper {
    --color-line: transparent;
}

.wrapper:after {
    content: '';
    display: flex;
    position: relative;
    bottom: -0.8rem;
    height: 3px;
    width: auto;
    background: var(--color-line);
}
</style>
