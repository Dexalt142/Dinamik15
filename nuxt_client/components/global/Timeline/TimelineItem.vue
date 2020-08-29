<template>
    <div class="timeline-item">
        <div class="timeline-circle"></div>
        <div class="timeline-content">
            <div class="timeline-date">{{ date }}</div>
            <div class="timeline-title">{{ title }}</div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'TimelineItem',
    props: {
        date: {
            type: String,
            required: true
        },
        title: {
            type: String,
            required: true
        }
    }
}
</script>