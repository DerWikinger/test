<template>
        <div class="wrapper">
            <div class="slider" :style="{ 'margin-left': '-' + (100 + (200 * currentPosition)) + 'px' }">
                <my-model-icon v-for="myModel in this.myModels" :key="myModel.id"
                               :image="myModel.image">
                </my-model-icon>
            </div>
            <button class="btnPrev" @click="prevItem">Prev</button>
            <button class="btnNext" @click="nextItem">Next</button>
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

.btnPrev, .btnNext {
    position: absolute;
    height: 100%;
    width: 60px;
    top: 0;
    background: #1f2937;
    opacity: 0;
}

.btnNext {
    right: 0;
}

.btnPrev:hover, .btnNext:hover {
    opacity: 0.4;
}

</style>
