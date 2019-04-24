<template>
    <div>

        <div v-if="signedIn" class="mt-2 card">
            <div class="card-body">
                <div class="form-group">
                    <wysiwyg name="body" v-model="body" placeholder="Have something to say?" ref="trix"></wysiwyg>
                </div>
                <button type="submit"
                        class="btn btn-outline-primary"
                        @click="addReply">Post
                </button>
            </div>
        </div>

        <p v-else class="text-center mt-4">Please <a href="#">sign in</a> to participate.</p>

    </div>
</template>

<script>

import "at.js";
import "jquery.caret";

export default {

    data() {
        return {
            body: "",
        }
    },

    mounted() {
        $('#body').atwho({
            at: "@",
            callbacks: {
                remoteFilter: function(query, callback) {
                    $.getJSON("/api/users", {name: query}, function(data) {
                        callback(data)
                    });
                }
            },
            delay: 400
        })
    },

    methods: {
        addReply() {
            axios.post(location.pathname + "/replies", {body: this.body})
                .then(({data}) => {
                    this.body = '';
                    this.$refs.trix.clear();
                    flash('Your reply has been posted.');

                    this.$emit('created', data);
                })
                .catch(error => {
                    flash(error.response.data, 'danger');
                })
        }
    },
}
</script>

<style scoped>

</style>