<template>
    <div id="app">
        <div class="mt-20 flex">
            <my-model-slider :my-models="this.myModels" picture-width="355px" picture-height="60px"
                             picture-fit="cover"></my-model-slider>
        </div>
        <div class="container justify-center mx-auto px-0 py-2">
            <div class="flex">
                <div class="w-2/3">
                    <my-model-detail class="mt-5" :my-model="getMyModel" :tags="getTags"></my-model-detail>
                </div>
                <div class="w-1/3 flex flex-col">
                    <div class="flex h-1/2 items-center justify-end">
                        <button class="flex h-min ">
                            <div class="mr-3">Next collection</div>
                            <img class="" src="/svg/next.svg" alt="">
                        </button>
                    </div>
                </div>
            </div>
            <div class="w-100 my-6 h-6">
                <div class="flex justify-center italic w-2/3">
                    Drag items to put them in custom order
                </div>
                <div class="flex -mt-[4.5rem] h-6 pl-36 justify-end items-start">
                    <div class="w-[320px]">
                        <div class="text-left text-xl">Recommendations</div>
                    </div>
                </div>
            </div>
            <div class="flex justify-between">
                <div class="w-2/3">
                    <my-models-full-collection :searchable="false" :sortable="false" :my-models="this.myModels">
                    </my-models-full-collection>
                    <div class="h-28"></div>
                </div>
                <div class="w-1/3 sidebar flex flex-col pl-36 items-end">
                    <other-models :models="this.otherModels"
                                  :visible-rows="+7">
                    </other-models>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import MyModelSlider from "@/components/MyModelSlider";
import MyModelDetail from "@/components/MyModelDetail";
import MyModelsFullCollection from "@/components/MyModelsFullCollection";
import MyModelBrief from "@/components/MyModelBrief";
import Button from "@/Jetstream/Button";
import OtherModels from "@/components/OtherModels";

export default {
    name: "Index",
    components: {
        Button,
        MyModelSlider,
        MyModelDetail,
        MyModelsFullCollection,
        MyModelBrief,
        OtherModels,
    },
    props: {
        myModels: Object,
        otherModels: Object,
        tags: Object,
        collectionData: Object,
        collectionModels: Array,
    },
    computed: {
        getMyModel() {
            console.log('MyModel: ', this.myModels[0]);
            return this.myModels ? this.myModels[0] : [];
        },
        getTags() {
            let tags = [];
            if (this.myModels) {
                tags = [].concat(this.tags.filter(item => item.my_model_id == this.myModels.id));
            }
            return tags;
        }
    },
};
</script>
<!-- Use preprocessors via the lang attribute! e.g. <style lang="scss"> -->
<style>
#app {
    font-family: Montserrat, Avenir, Helvetica, Arial, sans-serif;
    text-align: center;
}

.droppable {
    padding: 15px;
    border-radius: 5px;
    background: #2c3e50;
    margin-bottom: 10px;
}

.droppable h4 {
    color: white;
}

.draggable {
    background: white;
    padding: 5px;
    border-radius: 5px;
    margin-bottom: 5px;
}

.draggable h5 {
    margin: 0;
}
</style>
