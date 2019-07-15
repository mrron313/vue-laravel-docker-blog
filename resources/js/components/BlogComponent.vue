<template>

    <div class="col-md-8">
        <!-- Blog Post -->
        <div v-for="post in posts.data" :key="post.id" class="card mb-4">
        <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
        <div class="card-body">
            <h2 class="card-title">{{ post.title }}</h2>
            <p class="card-text">{{ post.body }}</p>
            <a href="#" class="btn btn-primary">Read More &rarr;</a>
        </div>
        <div class="card-footer text-muted">
            Posted on January 1, 2017 by
            <a href="#">Start Bootstrap</a>
        </div>
        </div>
    </div>

</template>

<script>
export default {
    data(){
        return {
            posts: {}
        }
    },

    created() {
      this.fetchAllPosts()
    },

    methods:{
        async fetchAllPosts(){
            axios.get("/api/posts")
                .then(response => (this.posts = response.data))
                .catch(err => {
                    console.log(err)
                });
        }
    }
}
</script>