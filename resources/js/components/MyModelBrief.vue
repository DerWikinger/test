<template>
    <div class="wrapper z-50" draggable="true" @mousedown="onMousedown($event, order)">
        <div class="avatar flex justify-center w-full relative">
            <img class="picture" :src="this.getSource()" alt="No image" :index="order">
            <img v-if="isDark" @click="onDelete" class="absolute z-10 right-0 w-6 m-4 hover:cursor-pointer" src="/svg/trash-white.svg">
            <img v-else @click="onDelete" class="absolute z-10 right-0 w-6 m-4 hover:cursor-pointer" src="/svg/trash.svg">
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
        order: Number,
    },
    methods: {
        getSource() {
            return '/storage/images/' + this.image;
            // return 'http://95.179.188.38' + this.image;
        },
        getBackgroundColor() {

        },
        onDelete() {
            console.log('Picture is delete!');
        },
        onMousedown(event, order) {
            let picture = new Image(300, 200);
            picture.src = this.getSource();
            event.target.ondragstart = function () {
                return false;
            }

            picture.style.position = 'absolute';
            picture.style.zIndex = 1000;
            picture.style.objectFit = 'fill';
            document.body.append(picture);

            moveAt(event.pageX, event.pageY);

            function moveAt(pageX, pageY) {
                picture.style.left = pageX - picture.offsetWidth / 2 + 'px';
                picture.style.top = pageY - picture.offsetHeight / 2 + 'px';
            }

            function onMouseMove(event) {
                moveAt(event.pageX, event.pageY);
            }

            document.addEventListener('mousemove', onMouseMove);
            picture.onmouseup = function(event) {
                document.removeEventListener('mousemove', onMouseMove);
                picture.hidden = true;
                // let elemBelow = document.elementFromPoint(event.screenX, event.screenY);
                let elemBelow = document.elementFromPoint(event.clientX, event.clientY);
                picture.onmouseup = null;
                picture.remove();
                if (!elemBelow || !elemBelow.attributes["index"]) return;
                let newOrder = elemBelow.attributes["index"].value;
                let droppableBelow = elemBelow.closest('.droppable');
                if (!droppableBelow) return;
                droppableBelow.ondrop(event, order, newOrder);
                // console.log(droppableBelow);
            };
        },
    },
    created() {

        let self = this;
        const fac = new FastAverageColor();
        fac.getColorAsync(this.getSource(), {algorithm: 'dominant'})
            .then(color => {
                self.isDark = color.isDark;
            })
            .catch(e => {
                console.error(e);
            });
    },
    data() {
        return {
            backgroundColor: 'transparent',
            isDark: false,
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

.draggable {

}

.avatar img.picture {
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

canvas {
    position:absolute;
    /*left: 0;*/
    left:-100%;
}

</style>
