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
                    :user_name="post.user.user_name"
                    :category="post.category.name"
                />
            </div>
<!-- 
            <div v-if="Object.keys(posts).length == 0"> 
                Sorry! There is no post.    
            </div>     -->

            <pagination :data="posts" @pagination-change-page="fetchPosts"></pagination>
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
      this.fetchPosts()
      this.$store.commit('setAuthUser', window.auth_user)
    },

    watch: {
       '$route': 'fetchPosts'
    },

    methods:{
        fetchPosts(page=1){
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
