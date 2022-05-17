<template>
    <div class="v-wrapper w-[320px] flex flex-col">
        <div class="v-gallery flex flex-col" :style="{ 'height': (rowHeight * rowsCount) + 'px' }"
             @dragover.prevent @dragenter.prevent @dragstart.prevent>
            <div v-for="model in this.models" :key="model.id" class="grid-row">
                <my-model-brief
                    :model="model"
                    over-icon-source="plus"
                    :height="rowHeight"
                    :image-height="200">
                </my-model-brief>
            </div>
        </div>
        <div class="flex justify-center">
            <button v-if="this.totalRows > this.visibleRows" id="btnOtherMore" class="" @click="onMoreClick">
                More
            </button>
        </div>
    </div>
</template>

<script>
import MyModelBrief from "@/components/MyModelBrief";

export default {
    name: "OtherModels",
    props: {
        models: Object,
        visibleRows: {type: Number, default: 4},
        searchable: {type: Boolean, default: true},
        sortable: {type: Boolean, default: true},
    },
    components: {
        MyModelBrief
    },
    mounted() {
        let elem = document.getElementsByClassName('grid-row').item(0);
        this.rowHeight = elem ? elem.clientHeight : 300;
        this.rowsCount = this.minVisibleRows;
    },
    methods: {
        onMoreClick() {
            let btn = document.getElementById('btnOtherMore');
            if(btn.innerHTML == 'Return') {
                this.rowsCount = this.minVisibleRows;
                btn.innerHTML = 'More';
                return;
            }
            if(this.rowsCount + 3 <= this.totalRows) {
                this.rowsCount += 3;
            } else if(this.rowsCount + 3 > this.totalRows) {
                this.rowsCount = this.totalRows;
            }
            if (this.rowsCount == this.totalRows) {
                setTimeout(function (button) {
                    button.innerHTML = 'Return';
                }, 1000, btn);
            }
        },
    },
    data() {
        return {
            rowHeight: 300,
            rowsCount: 1,
        }
    },
    computed: {
        totalRows() {
            // let r = Math.trunc(this.models.length);
            // if (this.models.length % 3) r += 1;
            return this.models.length;
        },
        minVisibleRows() {
            return Math.min(this.totalRows, this.visibleRows);
        },
    }
}
</script>

<style scoped>

.v-gallery {
    overflow: hidden;
    transition: all ease 1s;
}

#btnOtherMore {
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

</style>
