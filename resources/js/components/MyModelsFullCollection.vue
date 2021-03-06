<template>
    <div class="top-block flex justify-between">
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
                <my-model-brief class="w-[320px] self-center"
                    @delete="onDelete"
                    :model="myModel"
                    :order="+index"
                    over-icon-source="trash"
                    :height="rowHeight"
                    :image-height="200">
                </my-model-brief>
            </div>
        </div>
    </div>
    <div class="flex justify-center">
        <button id="btnDiscard" class="btnChanges" @click="onDiscardClick">Discard Changes</button>
        <button id="btnApply" class="btnChanges flex justify-center" @click="onApplyClick">
            <img class="" src="/svg/apply.svg">
            <div class="ml-3">Apply Changes</div>
        </button>
    </div>
</template>

<script>
import MyModelBrief from "@/components/MyModelBrief";

export default {
    name: "MyModelsFullCollection",
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
        for (let index = 0; index < this.myModels.length; index++) {
            let model = this.myModels[index];
            this.collection[index] = model;
        }
        this.rowsCount = this.totalRows;
        let droppableElem = document.querySelector('.droppable');
        if(droppableElem) {
            droppableElem.ondrop = this.onDrop;
            droppableElem.oninsert = this.insertModel;
        }
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
        onDelete(index) {
            delete this.collection[index];
            this.rowsCount = this.totalRows;
        },
        onDiscardClick() {
            console.log('Discard changes');
            location = document.location;
        },
        onApplyClick() {
            console.log('Apply changes');
        },
        onSortChange() {

        },
        onSearchChange() {

        },
        onDrop(e, order, newOrder, obj) {
            let contains = false;
            for(let model in this.collection) {
                if(model.id === obj.id) {
                    contains = true;
                    break;
                }
            }
            if(!contains) {
                this.insertModel(obj, newOrder);
                return;
            }
            let model = this.collection[order];
            if (newOrder < order) {
                for (let i = order; i > newOrder; i--) {
                    this.collection[i] = this.collection[i - 1];
                }
            } else {
                for (let i = order; i < newOrder; i++) {
                    this.collection[i] = this.collection[i + 1];
                }
            }
            this.collection[newOrder] = model;
        },
        insertModel(model, order) {
            for(let i = Object.keys(this.collection).length; i > order ; i--) {
                this.collection[i] = this.collection[i-1];
            }
            this.collection[order] = model;
            this.rowsCount = this.totalRows;
        }
    },
    data() {
        return {
            rowHeight: 300,
            rowsCount: 1,
            collection: {},
        }
    },
    computed: {
        totalRows() {
            let r = Math.trunc( Object.keys(this.collection).length / 3);
            if (Object.keys(this.collection).length % 3) r += 1;
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

.btnChanges {
    border: 2px solid;
    box-sizing: border-box;
    border-radius: 10px;

    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 400;
    font-size: 18px;
    line-height: 22px;

    margin-top: 80.23px;
    margin-left: 14px;
    margin-right: 14px;
    padding: 24px;
    min-width: 303px;
}

#btnDiscard {
    border-color: black;
}

#btnApply {
    border-color: #1C9558;
    color: #1C9558;
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
    padding: 0 5px;
}

</style>
