<template>
    <div>
        <input type="hidden" id="trix" :name="name" :value="value">
        <trix-editor ref="trix" input="trix" :placeholder="placeholder"></trix-editor>
    </div>
</template>

<script>
    import Trix from 'trix';

    export default {

        props: ['name', 'value', 'placeholder'],

        mounted() {
            this.$refs.trix.addEventListener('trix-change', e => {
                this.$emit('input', e.target.innerHTML);
            })
        },

        methods: {
            clear() {
                this.$refs.trix.value = ''
            }
        }

    }
</script>

<style scoped>

</style>