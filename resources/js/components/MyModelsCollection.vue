<template>
    <div class="top-block flex justify-between my-10">
        <slot></slot>
        <div v-if="searchable" class="w-3/4 text-left">
            <img class="mr-2 h-5" src="/svg/left_bracket.svg" alt="">
            <input id="myInput" class="text-lg border-0 py-0 w-1/2 italic"
                   @change="onSearchChange" type="search"
                   placeholder="Search within collection _________________________________">
            <img class="mr-2 h-5" src="/svg/glass.svg" alt="">
            <img class="mr-2 h-5" src="/svg/right_bracket.svg" alt="">
        </div>
        <div v-if="sortable" class="sort-block">
            <span>Sort by</span>
            <select name="sortBy" id="sortBy" class="border-0 pr-5 mr-1" @change="onSortChange">
                <option value="date">date</option>
                <option value="price">price</option>
                <option value="name">name</option>
                <option value="author">author</option>
            </select>
        </div>
    </div>
    <div class="v-wrapper" :style="{ 'height': (rowHeight * rowsCount) + 'px' }">
        <div class="v-gallery grid grid-cols-3 gap-y-0 gap-x-4 text-center droppable"
             @dragover.prevent @dragenter.prevent @dragstart.prevent>
            <div v-for="(myModel, index) in this.collection" :key="index" class="grid-row">
                <my-model-brief
                    :name="myModel.name"
                    :price="myModel.price"
                    :image="myModel.image"
                    :username="myModel.username"
                    :order="+index">
                </my-model-brief>
            </div>
        </div>
    </div>
    <div class="flex justify-center">
        <button v-if="this.totalRows > this.visibleRows" id="btnMore" class="" @click="onMoreClick">Show more 3</button>
    </div>
</template>

<script>
import MyModelBrief from "@/components/MyModelBrief";

export default {
    name: "MyModelsCollection",
    props: {
        myModels: Object,
        visibleRows: {type: Number, default: 4},
        searchable: {type: Boolean, default: true},
        sortable: {type: Boolean, default: true},
    },
    components: {
        MyModelBrief
    },
    mounted() {
        let elem = document.getElementsByClassName('grid-row').item(0);
        this.rowHeight = elem ? elem.clientHeight : 360;
        this.rowsCount = this.minVisibleRows;
        for(let index = 0; index < this.myModels.length; index++) {
            let model = this.myModels[index];
            this.collection[index] = model;
        }
        let droppableElem = document.querySelector('.droppable');
        droppableElem.ondrop = this.onDrop;
    },
    methods: {
        onMoreClick() {
            let btn = document.getElementById('btnMore');
            if (++this.rowsCount > this.totalRows) {
                this.rowsCount = this.minVisibleRows;
            }
            if (this.rowsCount == this.totalRows) {
                setTimeout(function (button) {
                    button.innerHTML = 'Return';
                }, 1000, btn);
            } else {
                btn.innerHTML = 'Show more 3';
            }
        },
        onSortChange() {

        },
        onSearchChange() {

        },
        onDrop(e, order, newOrder) {
            let model = this.collection[order];
            if(newOrder < order) {
                for(let i = order; i > newOrder; i--) {
                    this.collection[i] = this.collection[i-1];
                }
            } else {
                for(let i = order; i < newOrder; i++) {
                    this.collection[i] = this.collection[i+1];
                }
            }
            this.collection[newOrder] = model;
        },
    },
    data() {
        return {
            rowHeight: 360,
            rowsCount: 1,
            collection: {},
        }
    },
    computed: {
        totalRows() {
            let r = Math.trunc(this.myModels.length / 3);
            if (this.myModels.length % 3) r += 1;
            return r;
        },
        minVisibleRows() {
            return Math.min(this.totalRows, this.visibleRows);
        },
    }
}
</script>

<style scoped>

.v-wrapper {
    overflow: hidden;
    transition: all ease 1s;
}

#btnMore {
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

.top-block *, .sort-block * {
    display: inline;
    vertical-align: middle;
    line-height: inherit;
    height: 100%;
}

input:focus, input:focus-visible, select:focus, select:focus-visible {
    box-shadow: none;
}

.sort-block {
    height: inherit;
}

.droppable {
    background: transparent;
}

</style>
