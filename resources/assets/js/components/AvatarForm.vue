<template>
    <div>
        <div class="level">
            <img :src="avatar" width="50" height="50" class="mr-2">
            <h1 v-text="user.name" class="m-0"></h1>
        </div>

        <form v-if="canUpdate" enctype="multipart/form-data">
            <image-upload name="avatar" @loaded="onLoad"></image-upload>
        </form>

    </div>
</template>

<script>
    import ImageUpload from"./ImageUpload.vue";

    export default {

        components: {ImageUpload},

        props: ['user'],

        data() {
            return {
                avatar: this.user.avatar_path
            }
        },

        computed: {
            canUpdate() {
                return this.authorize(user => user.id === this.user.id);
            }
        },

        methods: {

            onLoad(avatar) {
                this.avatar = avatar.src;
                this.persist(avatar.file);
            },

            persist(avatar) {
                let data = new FormData();
                data.append('avatar', avatar);

                axios.post(`/api/users/${this.user.name}/avatar`, data)
                    .then(() => flash("Avatar uploaded"));
            }
        }
    }
</script>

<style scoped>

</style>