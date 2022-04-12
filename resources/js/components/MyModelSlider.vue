<template>
        <div class="wrapper">
            <div class="carousel">
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
    },
    components: {
        MyModelIcon,
    },
    mounted() {

    },
    methods: {
        prevItem() {

        },
        nextItem() {

        }
    },
    data() {
        return {
            forwardCollection: [],
            reverseCollection: [],
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

.carousel {
    display: flex;
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
