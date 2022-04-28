<script setup>

defineProps({
   myModels: Object,
   collectionData: Object,
   collectionModels: Array,
});

</script>

<template>
    <Head title="Test1"/>
    <div class="main-content">
        <div class="mt-20">
            <my-model-slider :my-models="this.myModels"></my-model-slider>
        </div>
        <div class="container mx-auto px-0 py-2">
            <div class="nav py-6 text-xs">
                <Link href="#" class="nav-link">All 3D Models</Link>
                /
                <Link href="#" class="nav-link">Collection: {{ collectionData.name }}</Link>
            </div>
            <div class="flex justify-between my-1 items-center">
                <Link class="text-3xl font-semibold">{{ collectionData.name }}</Link>
                <view-like-dislike-block :views="this.collectionData.views_count"
                              :likes="this.collectionData.likes_count"
                              :dislikes="this.collectionData.dislikes_count"
                              @send="this.onSend"
                              @more="this.onMore">
                </view-like-dislike-block>
            </div>
            <Link class="flex w-fit">
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
            <my-models-collection :my-models="this.myModels"></my-models-collection>
            <other-collection-icons :other-collection="this.collectionModels">

            </other-collection-icons>
        </div>
    </div>
</template>

<script>
import {Head, Link} from '@inertiajs/inertia-vue3';
import MyModelsCollection from "@/components/MyModelsCollection";
import MyModelIcon from "@/components/MyModelIcon";
import MyModelSlider from "@/components/MyModelSlider";
import OtherCollectionIcons from "@/components/OtherCollectionIcons";
import ViewLikeDislikeBlock from "@/components/ViewLikeDislikeBlock";

export default {
    name: 'Index',
    components: {
        MyModelsCollection,
        MyModelSlider,
        MyModelIcon,
        OtherCollectionIcons,
        ViewLikeDislikeBlock,
        Head,
        Link,
    },
    methods: {
        onMore: function () {
            console.log('Button More is clicked');
        },
        onSend: function () {
            console.log('Button Send is clicked');
        },
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
