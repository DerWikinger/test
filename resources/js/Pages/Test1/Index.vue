<script setup>
import {Head, Link} from '@inertiajs/inertia-vue3';
import MyModelsCollection from "@/components/MyModelsCollection";
import MyModelIcon from "@/components/MyModelIcon";
import MyModelSlider from "@/components/MyModelSlider";

defineProps({
    myModels: Object,
    collectionData: Object,
});

</script>

<template>
    <Head title="Test1"/>
    <div class="main-content">
        <div class="">
            <my-model-slider :currentRow="this.currentRow" :my-models="this.myModels"
                             @sliding="this.onSlide"></my-model-slider>
        </div>
        <div class="container mx-auto px-40 py-2">
            <div class="nav py-6 text-xs">
                <Link href="#" class="nav-link">All 3D Models</Link>
                /
                <Link href="#" class="nav-link">Collection: {{ collectionData.name }}</Link>
            </div>
            <div class="flex justify-between my-1">
                <Link class="text-3xl font-semibold">{{ collectionData.name }}</Link>
                <div class="flex justify-end text-sm">
                    <div class="flex justify-between text-sm pl-6">
                        <p><img class="mr-2" src="/storage/svg/eye.svg" alt=""></p>
                        <p>&nbsp;</p>
                        <p>
                            {{
                                (collectionData.views_count > 1000 ? collectionData.views_count / 1000 + 'k.' : collectionData.views_count)
                            }}</p>
                    </div>
                    <div class="flex justify-between text-sm pl-6">
                        <p><img class="mr-2" src="/storage/svg/like.svg" alt=""></p>
                        <p>&nbsp;</p>
                        <p>
                            {{
                                (collectionData.likes_count > 1000 ? collectionData.likes_count / 1000 + 'k.' : collectionData.likes_count)
                            }}</p>
                    </div>
                    <div class="flex justify-between text-sm pl-6">
                        <p><img class="mr-2" src="/storage/svg/dislike.svg" alt=""></p>
                        <p>&nbsp;</p>
                        <p>
                            {{
                                (collectionData.dislikes_count > 1000 ? collectionData.dislikes_count / 1000 + 'k.' : collectionData.dislikes_count)
                            }}</p>
                    </div>
                    <Link class="pl-6">
                        <img src="/storage/svg/send.svg" alt="">
                    </Link>
                    <Link class="pl-6">
                        <img src="/storage/svg/more.svg" alt="">
                    </Link>
                </div>
            </div>
            <Link class="flex">
                <div class="text-lg font-semibold">
                    <span class="font-normal">by&nbsp;</span>{{ 'Author' }}
                </div>
            </Link>
            <div class="flex justify-between mt-4 text-lg">
                <div class="flex">
                    {{ collectionData.description }}
                </div>
                <button id="btnAdd" class="">
                    Add to your collections
                </button>
            </div>
            <div class="flex text-xs mt-10">
                <Link v-if="(Array.isArray(collectionData.tags))" href="#" v-for="tag in collectionData.tags">
                    <span>#{{ tag }}&nbsp;</span>
                </Link>
                <Link v-else href="#">
                    <span>#{{ collectionData.tags }}</span>
                </Link>
            </div>
            <my-models-collection :currentRow="this.currentRow"
                                  :my-models="this.myModels" @rolling="this.onRoll"></my-models-collection>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Index',
    methods: {
        onSlide: function (currentPosition) {
            this.currentRow = Math.trunc(currentPosition / 3) + 1;
            console.log(this.currentRow);
        },
        onRoll: function (currentTopRow) {
            this.currentRow = currentTopRow;
            console.log('Current row: ', currentTopRow);
        }
    },
    data() {
        return {
            currentRow: 1,
        }
    }
}
</script>

<style scoped>

.main-content * {
    font-family: Montserrat;
}

#btnAdd {
    width: 303px;
    height: 68px;

    border: 2px solid #000000;
    box-sizing: border-box;
    border-radius: 10px;
}

.bg-gray-100 {
    background-color: #f7fafc;
    background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
}

.border-gray-200 {
    border-color: #edf2f7;
    border-color: rgba(237, 242, 247, var(--tw-border-opacity));
}

.text-gray-400 {
    color: #cbd5e0;
    color: rgba(203, 213, 224, var(--tw-text-opacity));
}

.text-gray-500 {
    color: #a0aec0;
    color: rgba(160, 174, 192, var(--tw-text-opacity));
}

.text-gray-600 {
    color: #718096;
    color: rgba(113, 128, 150, var(--tw-text-opacity));
}

.text-gray-700 {
    color: #4a5568;
    color: rgba(74, 85, 104, var(--tw-text-opacity));
}

.text-gray-900 {
    color: #1a202c;
    color: rgba(26, 32, 44, var(--tw-text-opacity));
}

/*@media (prefers-color-scheme: dark) {*/
/*    .dark\:bg-gray-800 {*/
/*        background-color: #2d3748;*/
/*        background-color: rgba(45, 55, 72, var(--tw-bg-opacity));*/
/*    }*/

/*    .dark\:bg-gray-900 {*/
/*        background-color: #1a202c;*/
/*        background-color: rgba(26, 32, 44, var(--tw-bg-opacity));*/
/*    }*/

/*    .dark\:border-gray-700 {*/
/*        border-color: #4a5568;*/
/*        border-color: rgba(74, 85, 104, var(--tw-border-opacity));*/
/*    }*/

/*    .dark\:text-white {*/
/*        color: #fff;*/
/*        color: rgba(255, 255, 255, var(--tw-text-opacity));*/
/*    }*/

/*    .dark\:text-gray-400 {*/
/*        color: #cbd5e0;*/
/*        color: rgba(203, 213, 224, var(--tw-text-opacity));*/
/*    }*/
/*}*/
</style>
