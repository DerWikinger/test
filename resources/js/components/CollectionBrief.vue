<template>
    <div class="collection-wrapper">
        <Link class="avatar" href="#">
            <img class="" :src="this.getSource()" alt="No image">
        </Link>
        <div class="description mt-1 text-lg flex justify-between">
            <Link class="title font-semibold" href="#">
                {{ this.name }}
            </Link>
            <div class="flex justify-between text-sm pl-6">
                <span class="mr-4">{{ this.itemsCount }}&nbsp;Моделей</span>
                <p><img class="mr-2 -mt-1" src="/svg/like.svg" alt=""></p>
                <p>&nbsp;</p>
                <p>
                    {{
                        (this.likes > 10000 ? this.likes / 10000 + 'k.' : this.likes)
                    }}</p>
            </div>
        </div>
    </div>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue3';

export default {
    name: "CollectionBrief",
    components: {
      Link,
    },
    props: {
        // MyModel: Object,
        name: String,
        image: String,
        price: Number,
        username: String,
        likes: {type: Number, default: 0},
        itemsCount: {type: Number, default: 0},
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

.collection-wrapper {
    height: 300px;
}

.avatar {
    display: block;
    height: 260px;
    border: 2px solid transparent;
    box-sizing: border-box;
    outline: 1px dashed rgba(255, 255, 255, 0.2); /* Пунктирная рамка */
    outline-offset: -10px; /* Выводим рамку внутри элемента */
}

.avatar img {
    width: 100%;
    height: 100%;
}

.avatar:hover {
    cursor: pointer;
    border: 2px solid blue;
    box-sizing: border-box;
}

.description * {
    display: inline;
    vertical-align: middle;
    line-height: inherit;
    height: 100%;
    border: none;
}
Link:hover {
    cursor: pointer;
    text-decoration: underline;
}
</style>
