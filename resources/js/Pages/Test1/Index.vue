<script setup>
import {Head, Link} from '@inertiajs/inertia-vue3';
import MyModelsCollection from "@/components/MyModelsCollection";
import MyModelIcon from "@/components/MyModelIcon";

defineProps({
    myModels: Object,
});

</script>

<template>
    <Head title="Test1"/>
    <div class="container mx-auto px-0 py-2 mx-0">
        <div class="grid grid-cols-6 gap-2 text-center">
            <div v-for="myModel in this.myModels" :key="myModel.id">
                            <my-model-icon
                                :image="myModel.image">
                            </my-model-icon>
            </div>
        </div>
    </div>
    <div class="container mx-auto px-40 py-2">
        <my-models-collection :my-models="this.myModels"></my-models-collection>
    </div>
</template>

<style scoped>
.bg-gray-100 {
    background-color: #f7fafc;
    background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
}

.border-gray-200 {
    border-color: #edf2f7;
    border-color: rgba(237, 242, 247, var(--tw-border-opacity));
}

.text-gray-400 {
    color: #cbd5e0;
    color: rgba(203, 213, 224, var(--tw-text-opacity));
}

.text-gray-500 {
    color: #a0aec0;
    color: rgba(160, 174, 192, var(--tw-text-opacity));
}

.text-gray-600 {
    color: #718096;
    color: rgba(113, 128, 150, var(--tw-text-opacity));
}

.text-gray-700 {
    color: #4a5568;
    color: rgba(74, 85, 104, var(--tw-text-opacity));
}

.text-gray-900 {
    color: #1a202c;
    color: rgba(26, 32, 44, var(--tw-text-opacity));
}

/*@media (prefers-color-scheme: dark) {*/
/*    .dark\:bg-gray-800 {*/
/*        background-color: #2d3748;*/
/*        background-color: rgba(45, 55, 72, var(--tw-bg-opacity));*/
/*    }*/

/*    .dark\:bg-gray-900 {*/
/*        background-color: #1a202c;*/
/*        background-color: rgba(26, 32, 44, var(--tw-bg-opacity));*/
/*    }*/

/*    .dark\:border-gray-700 {*/
/*        border-color: #4a5568;*/
/*        border-color: rgba(74, 85, 104, var(--tw-border-opacity));*/
/*    }*/

/*    .dark\:text-white {*/
/*        color: #fff;*/
/*        color: rgba(255, 255, 255, var(--tw-text-opacity));*/
/*    }*/

/*    .dark\:text-gray-400 {*/
/*        color: #cbd5e0;*/
/*        color: rgba(203, 213, 224, var(--tw-text-opacity));*/
/*    }*/
/*}*/
</style>
