<template>
    <button class="btn" :class="classes" @click="subscribe">Subscribe</button>
</template>

<script>
    export default {

        props: ['active'],

        computed: {
            classes() {
                return [
                    'btn',
                    this.active ? 'btn-primary' : 'btn-outline-secondary'
                ]
            }
        },

        methods: {

            subscribe() {

                let requestType = this.active ? 'delete' : 'post';

                axios[requestType](location.pathname + '/subscriptions');

                this.active = ! this.active;

            }
        }
    }
</script>

<style scoped>

</style>