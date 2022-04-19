<template>
    <div class="flex justify-center text-center text-2xl mt-28 mb-16">
        Other collections like this one
    </div>
    <div class="v-wrapper">
        <div class="v-gallery grid grid-cols-3 gap-y-0 gap-x-4 text-center" :style="{ 'margin-top': '-' + (360 * (currentTopRow-1)) + 'px' }">
            <div v-for="otherModel in this.otherCollection" :key="otherCollection.id">
                <collection-brief
                    :name="otherModel.model_name"
                    :price="otherModel.price"
                    :image="otherModel.image"
                    :username="otherModel.user_name">
                </collection-brief>
            </div>
        </div>
    </div>
    <div class="flex justify-center mb-20">
<!--        <button v-if="this.end" id="btnCollectionBack" class="" @click="onBackClick">Назад</button>-->
<!--        <button v-if="!this.end && this.totalRows > this.visibleRows" id="btnCollectionMore" class="" @click="onMoreClick">Показать все</button>-->
        <button id="btnCollectionMore" class="" @click="onMoreClick">Show all</button>
    </div>
</template>

<script>
import CollectionBrief from "@/components/CollectionBrief";

export default {
    name: "OtherCollectionIcons",
    components: {
        CollectionBrief
    },
    props: {
        otherCollection: Array,
    },
    methods: {
        onBackClick() {
            // if(this.currentTopRow > 1) {
            //     this.currentTopRow = 1;
            //     this.end = false;
            //     this.$emit('rolling', this.currentTopRow);
            // }
        },
        onMoreClick() {
            // if(this.currentTopRow++ >= (this.totalRows - this.visibleRows)) {
            //     this.end = true;
            // }
            // this.$emit('rolling', this.currentTopRow);
        },
    },
    data() {
        return {
            currentTopRow: 1,
            end: false,
        }
    },
    computed: {
        totalRows() {
            let r = Math.trunc(this.otherCollection.length / 3);
            if (this.otherCollection.length % 3) r += 1;
            return r;
        }
    }
}
</script>

<style scoped>

#btnCollectionMore, #btnCollectionBack {
    border: 2px solid black;
    box-sizing: border-box;
    border-radius: 10px;

    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 400;
    font-size: 18px;
    line-height: 22px;

    margin-top: 80.23px;
    padding: 24px;
    min-width: 202px;
}
</style>
