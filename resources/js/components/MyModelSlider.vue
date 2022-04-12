<template>
        <div class="wrapper">
            <div class="slider" :style="{ 'margin-left': '-' + (100 + (200 * currentPosition)) + 'px' }">
                <my-model-icon v-for="myModel in this.forwardCollection" :key="myModel.id"
                               :image="myModel.image">
                </my-model-icon>
            </div>
            <div class="slider" :style="{ 'margin-left': '-' + (100 + (200 * currentPosition)) + 'px' }">
                <my-model-icon v-for="myModel in this.reverseCollection" :key="myModel.id"
                               :image="myModel.image">
                </my-model-icon>
            </div>
            <div class="btnPrev" @click="prevItem">
                <img src="/storage/svg/left_icon-icons.com_61213.svg" alt="">
            </div>
            <div class="btnNext" @click="nextItem">
                <img src="/storage/svg/right_icon-icons.com_61212.svg" alt="">
            </div>
        </div>
</template>

<script>
import MyModelIcon from "@/components/MyModelIcon";
export default {
    name: "MyModelSlider",
    props: {
        myModels: Object,
        slidedItemsCount: { type: Number, default: 3 },
        visibleItemsCount: { type: Number, default: 6 },
    },
    components: {
        MyModelIcon,
    },
    mounted() {
        for(let i = 0; i < this.myModels.length; i++) {
            this.forwardCollection.push(this.myModels[i]);
            this.reverseCollection.push(this.myModels[this.myModels.length - (i+1)]);
        }
    },
    methods: {
        prevItem() {
            if(this.currentPosition >= this.slidedItemsCount) {
                this.currentPosition -= this.slidedItemsCount;
            }
        },
        nextItem() {
            if(this.currentPosition <= this.myModels.length - (this.visibleItemsCount + this.slidedItemsCount)) {
                this.currentPosition += this.slidedItemsCount;
            }
        }
    },
    data() {
        return {
            forwardCollection: [],
            reverseCollection: [],
            currentPosition: 0,
        }
    }
}
</script>

<style scoped>

.wrapper {
    padding: 0;
    margin: 0;
    position: relative;
    width: 100%;
    overflow: hidden;
}

.slider {
    display: flex;
    transition: all ease 0.5s;
}

.btnPrev img, .btnNext img {
    height: 100%;
}

.btnPrev, .btnNext {
    position: absolute;
    height: 100%;
    width: 80px;
    top: 0;
    background: transparent;
    opacity: 0;
}

.btnNext {
    right: 0;
}

.btnPrev:hover, .btnNext:hover {
    opacity: 0.8;
    cursor: pointer;
}

</style>
