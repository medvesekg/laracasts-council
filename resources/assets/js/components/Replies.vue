<template>
    <div>
        <div v-for="(reply, index) in items">
            <reply :reply="reply" @deleted="remove(index)" :key="reply.id"></reply>
        </div>
        <paginator :dataSet="dataSet" @changed="fetch"></paginator>

        <p v-if="$parent.locked">
            Thread locked.
        </p>

        <new-reply  @created="add" v-else></new-reply>
    </div>
</template>

<script>
    import Reply from "./Reply";
    import NewReply from "./NewReply";
    import collection from "../mixins/collection";

    export default {

        data() {
            return {
                dataSet: false,
            }
        },

        created() {
            this.fetch();
        },

        components: {Reply, NewReply},
        mixins: [collection],

        methods: {
            fetch(page) {
                axios.get(this.url(page))
                    .then(this.refresh);
            },
            refresh({data}) {
                this.dataSet = data;
                this.items = data.data;

                window.scrollTo(0,0);
            },

            url(page) {
                if( ! page) {
                    let query =location.search.match(/page=(\d+)/);
                    page = query ? query[1] : 1;
                }
                return location.pathname + "/replies?page=" + page;
            },

        },
    }
</script>

<style scoped>

</style>