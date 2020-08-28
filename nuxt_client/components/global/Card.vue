<template>
    <div :class="{'card-white':color==='white'}" class="card">
        <div class="card-body">
            <div v-if="title" class="card-title">{{ title }}</div>
            <slot />
        </div>
        <LoadingSpinner v-if="loading" :class="{'loading-white':color==='white'}" :title="loading_title"></LoadingSpinner>
    </div>
</template>

<script>
import LoadingSpinner from './LoadingSpinner';
export default {
    name: 'Card',
    props: {
        title: {
            type: String
        },
        color: {
            type: String
        },
        loading: {
            type: Boolean
        },
        loading_title: {
            type: String
        }
    }
}
</script>