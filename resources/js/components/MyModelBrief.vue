<template>
    <div class="wrapper">
<!--        <div class="avatar flex justify-center" :style="{ 'backgroundColor' : this.backgroundColor }">-->
        <div class="avatar flex justify-center w-full">
            <img class="" :src="this.getSource()" alt="No image">
        </div>
        <div class="description">
            <div class="flex justify-between text-xl">
                <div class="title ">
                    {{ this.name }}
                </div>
                <div class="price font-semibold ">
                    ${{ this.price }}
                </div>
            </div>
            <div class="flex">
                <div class="author text-md">
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
        getBackgroundColor() {

        },
    },
    // mounted() {
    //     let self = this;
    //     let img = new Image();
    //     let colorArray = [];
    //
    //     img.onload = function () {
    //         let canvas = document.createElement("canvas");
    //         canvas.width = img.naturalWidth;
    //         canvas.height = img.naturalHeight;
    //
    //         let ctx = canvas.getContext("2d");
    //         ctx.drawImage(this, 0, 0);
    //
    //         let rowStart = 0,
    //             row10 = Math.trunc(img.naturalHeight / 10),
    //             row90 = img.naturalHeight - row10,
    //             rowEnd = img.naturalHeight;
    //         let colStart = 0,
    //             col10 = Math.trunc(img.naturalWidth / 10),
    //             col90 = img.naturalWidth - col10,
    //             colEnd = img.naturalWidth;
    //
    //         let imgData = ctx.getImageData(0, 0, canvas.width, canvas.height).data;
    //
    //         for (let r = rowStart; r < row10; r++) {
    //             for (let c = colStart; c < col10 * 4; c += 4) {
    //                 let i = r * colEnd + c;
    //                 // let rgba = imgData[i] * 256 * 256 * 256 + imgData[i + 1] * 256 * 256 + imgData[i + 2] * 256 + imgData[i + 3];
    //                 // let rgba = imgData[i+3] * 256 * 256 * 256 + imgData[i + 2] * 256 * 256 + imgData[i + 1] * 256 + imgData[i];
    //                 let rgb = imgData[i] * 256 * 256 + imgData[i+1] * 256 + imgData[i+2];
    //                 colorArray.push(rgb);
    //             }
    //         }
    //
    //         colorArray = colorArray.sort();
    //         console.log(colorArray);
    //
    //         let moda = colorArray[0];
    //         let maxCount = 1;
    //         let count = 0;
    //         let prevColor = colorArray[0];
    //         colorArray.forEach(function (color) {
    //             if (color == prevColor) {
    //                 count++;
    //             } else {
    //                 count = 1;
    //                 prevColor = color;
    //             }
    //             if (count > maxCount) {
    //                 maxCount = count;
    //                 moda = color;
    //             }
    //         });
    //         console.log('Image: ', self.image, ' : ', '#' + moda.toString(16));
    //         self.backgroundColor = '#' + moda.toString(16);
    //     };
    //
    //     img.src = this.getSource();
    // },
    data() {
        return {
            backgroundColor: 'transparent',
        }
    },
    computed: {}
}
</script>

<style scoped>

.wrapper {
    height: 360px;
}

.avatar {
    height: 260px;
    border: 2px solid transparent;
    box-sizing: border-box;
    display: flex;
    overflow: hidden;
    max-height: 260px;
}

.avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
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
    /*font-size: 18px;*/
    line-height: 22px;
}

</style>
