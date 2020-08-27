<template>
    <div class="col-md-3 col-sm-6">
        <div class="card competition-card">
            <div class="card-body">
                <slot></slot>
                <div class="competition-title">{{ name }}</div>
                <div class="competition-description">{{ description }}</div>
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
        }
    }
}
</script>