<template>
    <div class="wrapper" :style="{'height': height + 'px'}" draggable="true" @mousedown="onMousedown($event, order)">
        <div class="avatar flex justify-center w-full relative" :style="{'height': imageHeight + 'px' }">
            <img class="picture" :src="this.getSource()" alt="No image" :index="order">
            <img v-if="overIconSource" @mousedown.prevent @click="onClick" class="over-icon absolute right-0 w-6 m-4 hover:cursor-pointer"
                 :src="'/svg/' + (isDark ? overIconSource + '-white' : overIconSource ) + '.svg'">
        </div>
        <div class="description">
            <div class="flex justify-between text-xl">
                <div class="title ">
                    {{ model.name }}
                </div>
                <div class="price font-semibold ">
                    ${{ model.price }}
                </div>
            </div>
            <div class="flex">
                <div class="author text-md">
                    by {{ model.username }}
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
        model: Object,
        order: Number,
        height: { type: Number, default: 360 },
        imageHeight: { type: Number, default: 260 },
        overIconSource: { type: String, default: '' },
    },
    methods: {
        getSource() {
            return '/storage/images/' + this.model.image;
            // return 'http://95.179.188.38' + this.image;
        },
        onClick() {
            if(this.overIconSource === 'trash') {
                this.$emit('delete', this.order);
            } else {
                let droppable = document.querySelector('.droppable');
                console.log('Droppable: ', droppable);
                if (!droppable) return;
                droppable.oninsert(this.model, 0);
            }
        },
        onMousedown(event, order) {
            let elemBelow = document.elementFromPoint(event.clientX, event.clientY);
            if (elemBelow.className.includes('over-icon')) {
                return;
            }

            let picture = new Image(this.imageHeight*0.9*16/9, this.imageHeight*0.9);
            picture.src = this.getSource();
            event.target.ondragstart = function () {
                return false;
            }

            picture.style.position = 'absolute';
            picture.style.zIndex = '10';
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
            let self = this;
            picture.onmouseup = function(event) {
                document.removeEventListener('mousemove', onMouseMove);
                picture.hidden = true;
                let elemBelow = document.elementFromPoint(event.clientX, event.clientY);
                if (elemBelow.className.includes('over-icon')) {
                    this.onClick();
                    return;
                }
                picture.onmouseup = null;
                picture.remove();
                if (!elemBelow || !elemBelow.attributes["index"]) return;
                let newOrder = elemBelow.attributes["index"].value;
                let droppableBelow = elemBelow.closest('.droppable');
                if (!droppableBelow) return;
                droppableBelow.ondrop(event, order, newOrder, self.model);
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

.avatar {
    border: 2px solid transparent;
    box-sizing: border-box;
    display: flex;
    overflow: hidden;
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

</style>
