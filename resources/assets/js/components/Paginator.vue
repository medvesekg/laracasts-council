<template>
    <nav v-if="shouldPaginate">
        <ul class="pagination">
            <li class="page-item" v-show="prevUrl" @click.prevent="page--">
                <a class="page-link" href="#" aria-label="Previous" rel="prev">
                    <span aria-hidden="true">&laquo; Previous</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">{{page}}</a></li>
            <li class="page-item" v-if="nextUrl" @click.prevent="page++">
                <a class="page-link" href="#" aria-label="Next" rel="next">
                    <span aria-hidden="true">Next &raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: ['dataSet'],

    data() {
        return {
            page: 1,
            prevUrl: false,
            nextUrl: false,
        }
    },

    computed: {
        shouldPaginate() {
            return !! (this.prevUrl || this.nextUrl);
        }
    },

    watch: {
        dataSet() {
            this.page = this.dataSet.current_page;
            this.prevUrl = this.dataSet.prev_page_url;
            this.nextUrl = this.dataSet.next_page_url;
        },
        page() {
            this.broadcast().updateUrl();
        }
    },

    methods: {
        broadcast() {
            return this.$emit('changed', this.page);
        },
        updateUrl() {
            history.pushState(null, null, "?page=" + this.page);
        }
    },
}
</script>

<style scoped>

</style>