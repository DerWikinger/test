<template>
    <div class="grid grid-cols-3 gap-4 text-center">
        <div v-for="myModel in this.collection" :key="myModel.id">
            <my-model-brief
                :name="myModel.model_name"
                :price="myModel.price"
                :image="myModel.image"
                :username="myModel.user_name">
            </my-model-brief>
        </div>
    </div>
    <div class="flex justify-center">
        <button v-if="this.end" id="btnBack" class="" @click="onBackClick">Назад</button>
        <button v-else id="btnMore" class="" @click="onMoreClick">Показать ещё 3</button>
    </div>
</template>

<script>
import MyModelBrief from "@/components/MyModelBrief";

export default {
    name: "MyModelsCollection",
    props: {
        myModels: Object,
        visibleRows: { type: Number, default: 4 },
    },
    components: {
        MyModelBrief
    },
    mounted() {
        this.getFirstVisibleRows();
        console.log('Collection: ', this.collection);
    },
    methods: {
        getRow(rowNumber) {
            let next = rowNumber * 3;
            for (let i = ((rowNumber - 1) * 3); i < next; i++) {
                if (i <= this.myModels.length) this.collection.push(this.myModels[i]);
            }
        },
        getFirstVisibleRows() {
            for(this.row = 1; this.row <= this.visibleRows && this.row < this.rows; this.row++) {
                for(let c = (this.row-1)*3; c < this.myModels.length && c < (this.row*3); c++) {
                    this.collection.push(this.myModels[c]);
                }
            }
        },
        onBackClick() {
            this.collection = [];
            this.getFirstVisibleRows();
            this.end = false;
        },
        onMoreClick() {
            // console.log(this.row);
            let next = this.row * 3;
            for (let i = ((this.row - 1) * 3); i < next; i++) {
                if (i < this.myModels.length) this.collection.push(this.myModels[i]);
            }
            if(this.row < this.rows) {
                this.row++;
            } else {
                this.end = true;
            }
        }
    },
    data() {
        return {
            row: 1,
            collection: [],
            end: false,
        }
    },
    computed: {
        rows() {
            let r = Math.trunc(this.myModels.length / 3);
            if(this.myModels.length % 3) r += 1;
            return r;
        }
    }
}
</script>

<style scoped>

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
}

</style>
