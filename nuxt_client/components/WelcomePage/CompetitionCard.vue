<template>
    <div class="col-md-3 col-sm-6">
        <div class="card competition-card">
            <div class="card-body">
                <slot></slot>
                <div class="competition-title">{{ name }}</div>
                <a class="guidebook-link" target="_blank" :href="link">Guidebook</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'CompetitionCard',
    props: {
        name: {
            type: String
        },
        description: {
            type: String
        },
        link: {
            type: String
        }
    }
}
</script>