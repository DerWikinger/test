<template>
    <div class="item text-center">
        <img class="" :src="this.getSource()" alt="No image"
             :style="{ 'width': imageWidth, 'height': imageHeight, 'object-fit': imageFit }">
    </div>
</template>

<script>
export default {
    name: "MyModelIcon",
    props: {
        image: String,
        imageWidth: { type: String, default: '100%' },
        imageHeight: { type: String, default: 'auto' },
        imageFit: { type: String, default: 'cover' },
    },
    methods: {
        getSource() {
            return '/storage/images/' + this.image;
            // return 'http://95.179.188.38' + this.image;
        }
    }
}
</script>

<style scoped>
.item {
    display: flex;
    height: 150px;
    width: 200px;
    min-width: 200px;
    max-height: 150px;
    border: none;
    box-sizing: border-box;
    overflow: hidden;
    /*justify-content: center;*/
    /*align-items: center;*/
}
/*.item img {*/
/*    width: 100%;*/
/*    height: auto;*/
/*    object-fit: cover;*/
/*}*/
/*.avatar:hover {*/
/*    cursor: pointer;*/
/*    border: 2px solid blue;*/
/*    box-sizing: border-box;*/
/*}*/
</style>
