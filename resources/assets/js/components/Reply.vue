<template>

    <div :id="'reply-'+id" class="card my-2">
        <div class="card-header" :class="{ 'text-white': isBest, 'bg-success': isBest }">
            <div class="level">
                <div class="flex">
                    <a :href="'/profiles/' + reply.owner.name"
                        v-text="reply.owner.name">
                    </a>
                    said <span v-text="ago"></span>...
                </div>
                <div v-if="signedIn">
                    <favorite :reply="reply"></favorite>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div v-if="editing">
                <form @submit.prevent="update">
                    <div class="form-group">
                        <wysiwyg v-model="body"></wysiwyg>
                    </div>
                    <button class="btn btn-sm btn-primary" type="submit">Update</button>
                    <button class="btn btn-sm btn-link" @click="editing=false" type="button">Cancel</button>
                </form>
            </div>
            <div v-else v-html="body"></div>
        </div>


        <div class="card-footer level" v-if="authorize('owns', reply) || authorize('owns', reply.thread)">
            <div v-if="authorize('owns', reply)">
                <button class="btn btn-sm mr-1" @click="editing=true">Edit</button>
                <button class="btn btn-danger btn-sm" type="submit" @click="destroy">Delete</button>
            </div>
            <div class="ml-auto">
                <button class="btn btn-default btn-sm" type="submit" @click="markBestReply" v-if="authorize('owns', reply.thread)">Best Reply?</button>
            </div>
        </div>


    </div>

</template>

<script>

    import Favorite from "./Favorite";
    import moment from "moment";

    export default {
        props: ['reply'],
        data() {
            return {
                editing: false,
                id: this.reply.id,
                body: this.reply.body,
                isBest: this.reply.isBest,
            }

        },

        components: {Favorite},

        computed: {
            ago() {
              return moment(this.reply.created_at).fromNow();
            },
        },

        created() {
            window.events.$on('best-reply-selected', id => {
                this.isBest = (id === this.id)
            })
        },

        methods: {
            update() {

                axios.patch('/replies/' + this.reply.id, {
                    body: this.body
                })
                    .then(() => {
                        console.log("then");
                        this.editing = false;
                        flash('Updated!');
                    })
                    .catch(error => {
                        console.log("catch");
                        flash(error.response.data, 'danger');
                    })
            },

            markBestReply() {

                axios.post('/replies/' + this.reply.id + '/best');

                window.events.$emit('best-reply-selected', this.reply.id);
            },

            destroy() {
                axios.delete('/replies/' + this.reply.id);

                this.$emit('deleted', this.reply.id);
            }
        }
    }
</script>

<style scoped>

</style>