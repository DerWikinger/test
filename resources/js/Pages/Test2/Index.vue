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
                        <div class="flex h-min ">
                            <div class="mr-3">Next collection</div>
                            <img class="" src="/svg/next.svg" alt="">
                        </div>
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
                <div class="w-1/3 sidebar flex flex-col pl-36">
                    <my-model-brief class="w-[320px] self-end"
                        :name="myModels[0].name"
                        :price="myModels[0].price"
                        :image="myModels[0].image"
                        :username="myModels[0].username"
                        :height="300"
                        :image-height="200">
                    </my-model-brief>
                </div>
            </div>
        </div>

        <!--        <div v-for="category in categories" :key="category.id" @drop="onDrop($event, category.id)"-->
        <!--             class="droppable"-->
        <!--             @dragover.prevent-->
        <!--             @dragenter.prevent>-->
        <!--            <h4>{{ category.title }}</h4>-->
        <!--            <div v-for="item in items.filter( x => x.categoryId == category.id)" :key="item.id"-->
        <!--                 @dragstart="onDragStart($event, item)"-->
        <!--                 class="draggable"-->
        <!--                 draggable="true">-->
        <!--                <h5>{{ item.title }}</h5>-->
        <!--            </div>-->
        <!--        </div>-->
    </div>
</template>

<script>
import {ref} from "vue";
import MyModelSlider from "@/components/MyModelSlider";
import MyModelDetail from "@/components/MyModelDetail";
import MyModelsFullCollection from "@/components/MyModelsFullCollection";
import MyModelBrief from "@/components/MyModelBrief";

export default {
    name: "Index",
    components: {
        MyModelSlider,
        MyModelDetail,
        MyModelsFullCollection,
        MyModelBrief,
    },
    props: {
        myModels: Object,
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
    setup() {
        const items = ref([
            {
                id: 1,
                title: 'BMW',
                categoryId: 1,
            },
            {
                id: 2,
                title: 'Audi',
                categoryId: 1,
            },
            {
                id: 3,
                title: 'Dog',
                categoryId: 2,
            },
            {
                id: 4,
                title: 'Cat',
                categoryId: 2,
            },
        ]);
        const categories = ref([
            {
                id: 1,
                title: 'Cars'
            },
            {
                id: 2,
                title: 'Animals'
            }
        ]);

        function onDragStart(e, item) {
            e.dataTransfer.dropEffect = 'move';
            e.dataTransfer.effectAllowed = 'copy';
            e.dataTransfer.setData('itemId', item.id.toString());
        };

        function onDrop(e, categoryId) {
            const itemId = parseInt(e.dataTransfer.getData('itemId'));
            items.value = items.value.map(x => {
                if (x.id == itemId) x.categoryId = categoryId;
                return x;
            });
        };
        return {
            items,
            categories,
            onDragStart,
            onDrop,
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

.dropable h4 {
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
