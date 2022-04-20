<template>
    <div class="outer">
        <div class="avatar flex justify-center" :style="{ 'backgroundColor' : this.backgroundColor }">
            <img class="" :src="this.getSource()" alt="No image">
        </div>
        <div class="description">
            <div class="flex justify-between">
                <div class="title">
                    {{ this.name }}
                </div>
                <div class="price font-semibold">
                    ${{ this.price }}
                </div>
            </div>
            <div class="flex">
                <div class="author">
                    by {{ this.username }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import FastAverageColor from 'fast-average-color';

export default {
    name: "MyModelBrief",
    props: {
        // MyModel: Object,
        name: String,
        image: String,
        price: Number,
        username: String,
    },
    methods: {
        getSource() {
            return '/storage/images/' + this.image;
            // return 'http://95.179.188.38' + this.image;
        },
    },
    mounted() {
        let fac = new FastAverageColor(),
            self = this;
        fac.getColorAsync(this.getSource()).then(function (color) {
            self.backgroundColor = color.hex ?? 'transparent';
        }).catch(function (error) {
            console.log('Error: ', error);
            self.backgroundColor = 'transparent';
        });
    },
    data() {
        return {
            backgroundColor: 'transparent',
        }
    },
    computed: {}
}
</script>

<style scoped>
.outer {
    height: 360px;
}

.avatar {
    height: 260px;
    border: 2px solid transparent;
    box-sizing: border-box;
    display: flex;
    overflow: hidden;
    justify-content: center;
    align-items: center;
}

.avatar img {
    width: 100%;
    height: auto;
}

.avatar:hover {
    cursor: pointer;
    border: 2px solid blue;
    box-sizing: border-box;
}

.description:hover {
    cursor: pointer;
    text-decoration: underline;
}

.description {
    margin-top: 17px;
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 400;
    font-size: 18px;
    line-height: 22px;
}

.author {
    font-size: 14px;
}
</style>
