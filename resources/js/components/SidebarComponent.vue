<template>

    <div>
        <!-- Categories Widget -->
        <div class="card">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-unstyled mb-0">
                            <li>
                                <router-link to="/posts/categories/1">JavaScript</router-link>
                            </li>
                            <li>
                                <router-link to="/posts/categories/2">Web Design</router-link>
                            </li>
                            <li>
                                <router-link to="/posts/categories/3">HTML</router-link>
                            </li>
                            <li>
                                <router-link to="/posts/categories/4">CSS</router-link>
                            </li>
                            <li>
                                <router-link to="/posts/categories/5">Tutorials</router-link>
                            </li>
                            <li>
                                <router-link to="/posts/categories/6">Freebies</router-link>
                            </li>
                            <li>
                                <router-link to="/posts">All</router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <!-- Post Widget -->
        <div class="card">
            <h5 class="card-header">My Card</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-unstyled mb-0">
                            <li>
                                <router-link to="/create-posts">Create Post</router-link>
                            </li>
                            <li>
                                <router-link v-bind:to="{ name: 'single-user-post-component', params: { user_name: user_name } }" >My Posts</router-link>
                            </li>
                            <li>
                                <router-link to="/my-profile">My Profile</router-link>
                            </li>
                            <li>
                                <router-link to="/change-password">Change Password</router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data(){
            return{
                user_name: ''
            }
        },

        mounted() {
            this.user_name = this.$store.getters.userName
        }
    }
</script>
