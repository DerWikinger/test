<script setup>
import {Head, Link} from '@inertiajs/inertia-vue3';
import MyModelsCollection from "@/components/MyModelsCollection";
import MyModelIcon from "@/components/MyModelIcon";
import MyModelSlider from "@/components/MyModelSlider";
import OtherCollectionIcons from "@/components/OtherCollectionIcons";

defineProps({
    myModels: Object,
    collectionData: Object,
    collectionModels: Array,
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
                        <p><img class="mr-2" src="/svg/eye.svg" alt=""></p>
                        <p>&nbsp;</p>
                        <p>
                            {{
                                (collectionData.views_count > 10000 ? collectionData.views_count / 10000 + 'k.' : collectionData.views_count)
                            }}</p>
                    </div>
                    <div class="flex justify-between text-sm pl-6">
                        <p><img class="mr-2" src="/svg/like.svg" alt=""></p>
                        <p>&nbsp;</p>
                        <p>
                            {{
                                (collectionData.likes_count > 10000 ? collectionData.likes_count / 10000 + 'k.' : collectionData.likes_count)
                            }}</p>
                    </div>
                    <div class="flex justify-between text-sm pl-6">
                        <p><img class="mr-2" src="/svg/dislike.svg" alt=""></p>
                        <p>&nbsp;</p>
                        <p>
                            {{
                                (collectionData.dislikes_count > 10000 ? collectionData.dislikes_count / 10000 + 'k.' : collectionData.dislikes_count)
                            }}</p>
                    </div>
                    <Link class="pl-6">
                        <img src="/svg/send.svg" alt="">
                    </Link>
                    <Link class="pl-6">
                        <img src="/svg/more.svg" alt="">
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
                    Добавить в вашу коллекцию
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
            <other-collection-icons :other-collection="this.collectionModels">

            </other-collection-icons>
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
    background: white;
}

#btnAdd {
    width: 303px;
    height: 68px;

    border: 2px solid #000000;
    box-sizing: border-box;
    border-radius: 10px;
}

</style>
