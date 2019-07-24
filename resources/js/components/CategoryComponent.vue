<template>

    <div class="row">
        <div class="col-md-8">

            <div v-if="loading" class="loading">
                Loading...
            </div>

            <!-- Blog Post -->
            <div v-for="post in posts.data" :key="post.id" class="card mb-4">
                <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
                <div class="card-body">
                    <h2 class="card-title">{{ post.title }}</h2>
                    <p class="card-text">{{ post.body }}</p>
                    <a href="#" class="btn btn-primary">Read More &rarr;</a>
                </div>
                <div class="card-footer text-muted">
                    <div class="postedOn">
                        Posted on {{ post.created_at }} by
                        <a href="#">{{ post.user.name }}</a>
                    </div>
                    <div class="categoryName">
                        Category: {{ post.category.name }}
                    </div>
                </div>
            </div>
            <pagination :data="posts" @pagination-change-page="fetchData"></pagination>
        </div>
        <div class="col-md-4">
            <sidebar-component />
        </div>
    </div>


</template>

<script>
export default {
    data(){
        return {
            loading: true,
            posts: {}
        }
    },

    created() {
      this.fetchData()
    },

    watch: {
       '$route': 'fetchData'
    },

    methods:{
        fetchData(page=1){
            axios.get('/api/posts/categories/' + this.$route.params.id +'?page=' + page)
                .then((response) => {
                    this.posts = response.data.data
                    this.loading = false
                })
                .catch(err => {
                    console.log(err)
                });
        }
    },
}
</script>

<style scoped>
    .postedOn{
        width: 60%;
        float: left
    }

    .categoryName{
        width: 40%;
        float: right
    }
</style>
