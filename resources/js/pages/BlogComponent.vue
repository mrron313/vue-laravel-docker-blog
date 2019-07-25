<template>

    <div class="row">
        <div class="col-md-8">

            <div v-if="loading" class="loading">
                Loading...
            </div>

            <div v-for="post in posts.data" :key="post.id">
                <post-component 
                    :id="post.id"
                    :title="post.title"
                    :body="post.body"
                    :created="post.created_at"
                    :user="post.user.name"
                    :category="post.category.name"
                />
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

    mounted() {
      this.fetchData()
    },

    watch: {
       '$route': 'fetchData'
    },

    methods:{
        fetchData(page=1){
            axios.get('/api/posts?page=' + page)
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
