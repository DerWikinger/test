<script setup>
import Dropdown from "@/Jetstream/Dropdown";
import DropdownLink from "@/Jetstream/DropdownLink";

defineProps({
    myModel: Object,
});
</script>
<template>
    <div class="wrapper">
        <div class="flex justify-between">
            <div class="my-model-image">
                <img :src="this.getImageSource()" alt="No image" :class="this.isDark ? 'dark-image' : 'light-image'">
                <button id="btnChange" class="text-xl">
                    Change preview
                </button>
            </div>
            <div class="flex flex-col justify-around py-8">
                <button class="btnObject">
                    <div class="flex justify-between h-full">
                        <div class="flex justify-center w-5/6 border-black border-r-[2px] items-center">
                            <div class="flex w-2/6 h-min justify-end">
                                <img class="mr-3" src="/svg/merge.svg">
                            </div>
                            <div class="w-4/6 text-left">Merge with...</div>
                        </div>
                        <Dropdown class="flex h-100 w-1/6 items-center justify-center"
                                  :content-classes="['bg-white', 'py-1', 'relative']">
                            <template v-slot:trigger>
                                <div class="flex justify-center h-inherit">
                                    <img src="/svg/arrow-down.svg" alt="">
                                </div>
                            </template>
                            <template v-slot:content>
                                <ul class="dropdown-content">
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                </ul>
                            </template>
                        </Dropdown>
                    </div>
                </button>
                <button class="btnObject">
                    <div class="flex w-5/6 items-center">
                        <div class="w-2/6 flex h-min justify-end">
                            <img class="mr-3" src="/svg/trash.svg">
                        </div>
                        <div class="w-4/6 text-left">Delete collection</div>
                    </div>
                </button>
            </div>
        </div>
        <div class="text-sm italic text-left mt-8">
            Name
        </div>
        <div class="text-3xl font-semibold text-left border-black border-b my-4">
            {{ this.myModel.name }}
        </div>
        <div class="text-sm italic text-left mt-8 mb-2">
            Description
        </div>
        <p class="text-lg text-left border-black border-b py-4">
            {{ this.myModel.description }}
        </p>

        <!--        <div class="avatar flex justify-center w-full">-->
        <!--            <img class="" :src="this.getSource()" alt="No image">-->
        <!--        </div>-->
        <!--        <div class="description">-->
        <!--            <div class="flex justify-between text-xl">-->
        <!--                <div class="title ">-->
        <!--                    {{ this.name }}-->
        <!--                </div>-->
        <!--                <div class="price font-semibold ">-->
        <!--                    ${{ this.price }}-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="flex">-->
        <!--                <div class="author text-md">-->
        <!--                    by {{ this.username }}-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
    </div>
</template>

<script>
import FastAverageColor from 'fast-average-color';

export default {
    methods: {
        getImageSource() {
            return '/storage/images/' + this.myModel.image;
        }
    },
    data() {
      return {
          isDark: false,
      }
    },
    created() {
        let self = this;
        const fac = new FastAverageColor();
        fac.getColorAsync(this.getImageSource(), {algorithm: 'dominant'})
            .then(color => {
                console.log(color);
                self.isDark = color.isDark;
            })
            .catch(e => {
                console.error(e);
            });
        console.log('My model: ', this.myModel.image);
    }
}
</script>

<style scoped>

.btnObject {
    --button-width: 303px;
    width: var(--button-width);
    height: 68px;
    border: 2px solid #000000;
    box-sizing: border-box;
    border-radius: 10px;
}

.my-model-image {
    width: 458px;
    height: 258px;
    position: relative;
    --light-color: white;
    --dark-color: black;
}

.dark-image {
    outline-offset: -0.75rem;
    outline: 1px dotted var(--light-color);
}

.light-image {
    outline-offset: -0.75rem;
    outline: 1px dotted var(--dark-color);
}

.dark-image + #btnChange {
    border: 2px solid;
    border-color: var(--light-color);
    color: var(--light-color);
}

.light-image + #btnChange {
    border: 2px solid;
    border-color: var(--dark-color);
    color: var(--dark-color);
}

#btnChange {
    position: relative;
    width: 226px;
    height: 68px;
    top: calc(-50% - 34px);
    border-radius: 10px;
}

/*.dropdown-content {*/
/*    position: relative;*/
/*    width: var(--button-width);*/
/*    left: calc(-50%);*/
/*}*/
</style>
