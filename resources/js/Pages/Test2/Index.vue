<template>
    <div id="app">
        <div class="mt-20 flex">
            <my-model-slider :my-models="this.myModels" picture-width="355px" picture-height="60px" picture-fit="cover"></my-model-slider>
        </div>
        <div class="container mx-auto px-0 py-2">
            <my-model-detail class="mt-5" :my-model="getMyModel" :tags="getTags"></my-model-detail>
            <my-models-collection :searchable="false" :sortable="false" :my-models="this.myModels">
                <h5 class="w-full text-center italic mt-4">Drag items to put them in custom order</h5>
            </my-models-collection>
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
import MyModelsCollection from "@/components/MyModelsCollection";

export default {
    name: "Index",
    components: {
        MyModelSlider,
        MyModelDetail,
        MyModelsCollection,
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
            if(this.myModels) {
                tags = [].concat(this.tags.filter( item => item.my_model_id == this.myModels.id));
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
