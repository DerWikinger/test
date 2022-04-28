<template>
    <div class="wrapper">
        <div class="slider" :style="{ 'margin-left': (currentMargin) + 'px' }">
            <my-model-icon v-for="myModel in this.forwardCollection" :key="myModel.id"
                           :image="myModel.image">
            </my-model-icon>
        </div>
        <div class="slider" :style="{ 'margin-left': (currentMargin) + 'px' }">
            <my-model-icon v-for="myModel in this.reverseCollection" :key="myModel.id"
                           :image="myModel.image">
            </my-model-icon>
        </div>
        <div class="btnPrev" @click="onPrevClick">
            <img src="/svg/left_icon-icons.com_61213.svg" alt="">
        </div>
        <div class="btnNext" @click="onNextClick">
            <img src="/svg/right_icon-icons.com_61212.svg" alt="">
        </div>
    </div>
</template>

<script>
import MyModelIcon from "@/components/MyModelIcon";

export default {
    name: "MyModelSlider",
    props: {
        myModels: Object,
        slideTimeInterval: {type: Number, default: 3000},
    },
    components: {
        MyModelIcon,
    },
    mounted() {
        for (let i = 0; i < this.myModels.length; i++) {
            this.forwardCollection.push(this.myModels[i]);
            this.reverseCollection.push(this.myModels[this.myModels.length - (i + 1)]);
        }
        this.timeInterval = this.startSlider(true);
    },
    methods: {
        onPrevClick() {
            this.prevItem(false);
        },
        onNextClick() {
            this.nextItem(false);
        },
        prevItem(auto = true) {
            let outerWidth = window.outerWidth;
            if (Math.abs(this.currentMargin) > (outerWidth / 2)) {
                let margin = outerWidth / 2;
                let count = Math.trunc(margin / this.itemWidth);
                this.currentMargin = this.currentMargin + (count * this.itemWidth);
            } else {
                this.currentMargin = 0;
            }
            if(!auto) this.resetInterval();
        },
        nextItem(auto = true) {
            let elem = document.querySelector('div.wrapper'),
                scrollWidth = elem.scrollWidth,
                outerWidth = window.outerWidth;
            if (scrollWidth > outerWidth) {
                if (scrollWidth > outerWidth * 1.5) {
                    let margin = outerWidth / 2;
                    let count = Math.trunc(margin / this.itemWidth);
                    this.currentMargin = this.currentMargin - (count * this.itemWidth);
                } else {
                    this.currentMargin = this.currentMargin - (scrollWidth - outerWidth);
                }
            } else {
                this.currentMargin = 0;
            }
            if(!auto) this.resetInterval();
        },
        resetInterval() {
            clearTimeout(this.timeOut);
            clearInterval(this.timeInterval);
            let self = this;
            this.timeOut = setTimeout(function () {
                self.timeInterval = self.startSlider();
                clearTimeout(self.timeOut);
            }, this.timePause);
        },
        startSlider() {
            return setInterval(this.nextItem, this.slideTimeInterval);
        }
    },
    data() {
        return {
            forwardCollection: [],
            reverseCollection: [],
            currentMargin: 0,
            itemWidth: 200,
            timeInterval: 0,
            timePause: 2000,
            timeOut: 0,
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
    transition: all ease 0.8s;
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
    background: white;
    opacity: 0.5;
    cursor: pointer;
}

</style>
