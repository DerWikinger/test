<template>
<div class="outer">
    <div class="avatar">
        <img class="" :src="this.getSource()" alt="No image">
    </div>
    <div class="description col-12">
        <div class="title row">
            <div class="col-10">
                {{ this.name }}
            </div>
            <div class="col-2">
                {{ this.price }}
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: "MyModelBrief",
    props: {
        // MyModel: Object,
        name: String,
        image: String,
        price: Number,
    },
    methods: {
        getSource() {
            return '/storage/images/' + this.image;
        }
    }
}
</script>

<style scoped>
.avatar {
    height: 200px;
}
.avatar img {
    width: 100%;
    height: 100%;
}
</style>
