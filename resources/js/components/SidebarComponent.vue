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
                                <router-link to="/categories/1">JavaScript</router-link>
                            </li>
                            <li>
                                <router-link to="/categories/2">Web Design</router-link>
                            </li>
                            <li>
                                <router-link to="/categories/3">HTML</router-link>
                            </li>
                            <li>
                                <router-link to="/categories/4">CSS</router-link>
                            </li>
                            <li>
                                <router-link to="/categories/5">Tutorials</router-link>
                            </li>
                            <li>
                                <router-link to="/categories/6">Freebies</router-link>
                            </li>
                            <li>
                                <router-link to="/">All</router-link>
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
                                <router-link to="/create-post">Create Post</router-link>
                            </li>
                            <li>
                                <router-link to="/my-posts">My Posts</router-link>
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
        mounted() {
        }
    }
</script>
