<template>
    <div class="top-block flex justify-between my-10">
        <div class="w-3/4">
            <img class="mr-2 h-5" src="/svg/left_bracket.svg" alt="">
            <span class="text-lg italic">Искать внутри коллекции</span>
            <input class="text-lg border-0 py-0 w-60" @change="onSearchChange" type="search" placeholder="___________________________">
            <img class="mr-2 h-5" src="/svg/glass.svg" alt="">
            <img class="mr-2 h-5" src="/svg/right_bracket.svg" alt="">
        </div>
        <div class="sort-block">
            <span>Сортировать по</span>
            <select name="sortBy" id="sortBy" class="border-0 pr-5 mr-1" @change="onSortChange">
                <option value="date">дате</option>
                <option value="price">цене</option>
                <option value="name">имени</option>
                <option value="author">автору</option>
            </select>
        </div>
    </div>
    <div class="v-wrapper">
        <div class="v-gallery grid grid-cols-3 gap-y-0 gap-x-4 text-center" :style="{ 'margin-top': '-' + (360 * (currentTopRow-1)) + 'px' }">
            <div v-for="myModel in this.myModels" :key="myModel.id">
                <my-model-brief
                    :name="myModel.model_name"
                    :price="myModel.price"
                    :image="myModel.image"
                    :username="myModel.user_name">
                </my-model-brief>
            </div>
        </div>
    </div>
    <div class="flex justify-center">
        <button v-if="this.end" id="btnBack" class="" @click="onBackClick">Назад</button>
        <button v-if="!this.end && this.totalRows > this.visibleRows" id="btnMore" class="" @click="onMoreClick">Показать ещё 3</button>
    </div>
</template>

<script>
import MyModelBrief from "@/components/MyModelBrief";

export default {
    name: "MyModelsCollection",
    props: {
        myModels: Object,
        visibleRows: {type: Number, default: 3},
        currentRow: {type: Number, default: 1},
    },
    watch: {
        currentRow(newValue, oldValue) {
            this.currentTopRow = newValue;
            if(this.currentTopRow > (this.totalRows - this.visibleRows)) {
                this.end = true;
            } else {
                this.end = false;
            }
        }
    },
    components: {
        MyModelBrief
    },
    methods: {
        onBackClick() {
            if(this.currentTopRow > 1) {
                this.currentTopRow = 1;
                this.end = false;
                this.$emit('rolling', this.currentTopRow);
            }
        },
        onMoreClick() {
            if(this.currentTopRow++ >= (this.totalRows - this.visibleRows)) {
                this.end = true;
            }
            this.$emit('rolling', this.currentTopRow);
        },
        onSortChange() {

        },
        onSearchChange() {

        }
    },
    data() {
        return {
            currentTopRow: 1,
            end: false,
        }
    },
    computed: {
        totalRows() {
            let r = Math.trunc(this.myModels.length / 3);
            if (this.myModels.length % 3) r += 1;
            return r;
        }
    }
}
</script>

<style scoped>

.v-wrapper {
    height: 1071px;
    overflow: hidden;
}

#btnMore, #btnBack {
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

.v-gallery {
    transition: all ease 0.5s;
}

.top-block *, .sort-block * {
    display: inline;
    vertical-align: middle;
    line-height: inherit;
    height: 100%;
    border: none;
}

input:focus, input:focus-visible, select:focus, select:focus-visible {
    box-shadow: none;
}

.sort-block {
    height: inherit;
}

</style>
