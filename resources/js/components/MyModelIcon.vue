<template>
    <div class="avatar px-0 py-0 mx-0 my-0">
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
.avatar {
    height: 200px;
    border: 2px solid transparent;
    box-sizing: border-box;
}
.avatar img {
    width: 100%;
    height: 100%;
}
/*.avatar:hover {*/
/*    cursor: pointer;*/
/*    border: 2px solid blue;*/
/*    box-sizing: border-box;*/
/*}*/
</style>
