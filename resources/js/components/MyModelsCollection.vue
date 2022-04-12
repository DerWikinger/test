<template>
    <div class="v-wrapper">
        <div class="v-gallery grid grid-cols-3 gap-y-0 gap-x-4 text-center" :style="{ 'margin-top': '-' + (360 * (currentTopRow-1)) + 'px' }">
            <div v-for="myModel in this.myModels" :key="myModel.id">
                <my-model-brief
                    :name="myModel.model_name"
                    :price="myModel.price"
                    :image="myModel.image"
                    :username="myModel.user_name">
                </my-model-brief>
            </div>
        </div>
    </div>

    <div class="flex justify-center">
        <button v-if="this.end" id="btnBack" class="" @click="onBackClick">Назад</button>
        <button v-if="!this.end && this.totalRows > this.visibleRows" id="btnMore" class="" @click="onMoreClick">Показать ещё 3</button>
    </div>
</template>

<script>
import MyModelBrief from "@/components/MyModelBrief";

export default {
    name: "MyModelsCollection",
    props: {
        myModels: Object,
        visibleRows: {type: Number, default: 4},
        currentRow: {type: Number, default: 1},
    },
    components: {
        MyModelBrief
    },
    methods: {
        onBackClick() {
            if(this.currentTopRow > 1) {
                this.currentTopRow = 1;
                this.end = false;
            }
        },
        onMoreClick() {
            if(this.currentTopRow++ >= (this.totalRows - this.visibleRows)) {
                this.end = true;
            }
        }
    },
    data() {
        return {
            currentTopRow: 1,
            end: false,
        }
    },
    computed: {
        totalRows() {
            let r = Math.trunc(this.myModels.length / 3);
            if (this.myModels.length % 3) r += 1;
            return r;
        }
    }
}
</script>

<style scoped>

.v-wrapper {
    height: 1428px;
    overflow: hidden;

}

#btnMore, #btnBack {
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

.v-gallery {
    transition: all ease 0.5s;
}
</style>
