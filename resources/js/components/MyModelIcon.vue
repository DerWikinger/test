<template>
    <div class="item text-center">
        <img class="" :src="this.getSource()" alt="No image">
    </div>
</template>

<script>
export default {
    name: "MyModelIcon",
    props: {
        image: String,
    },
    methods: {
        getSource() {
            // return '/storage/images/' + this.image;
            return 'http://95.179.188.38' + this.image;
        }
    }
}
</script>

<style scoped>
.item {
    display: inline-block;
    height: 200px;
    min-width: 200px;
    border: none;
    box-sizing: border-box;
}
.item img {
    width: 100%;
    height: 100%;
}
/*.avatar:hover {*/
/*    cursor: pointer;*/
/*    border: 2px solid blue;*/
/*    box-sizing: border-box;*/
/*}*/
</style>
