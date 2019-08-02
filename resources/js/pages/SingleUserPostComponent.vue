<template>

    <div class="row">
        <div class="col-md-8">

            <div v-if="isMyPost == true">
                <h2>My Posts</h2>
                <hr>
            </div>

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
<!-- 
            <div v-if="posts.data.length == 0">
                Sorry! There is no post.    
            </div>     -->

            <pagination :data="posts" @pagination-change-page="fetchMyPosts"></pagination>
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
            posts: {},
            isMyPost: false
        }
    },

    mounted() {
      this.fetchMyPosts()

      this.isMyPostCheck()
    },

    watch: {
       '$route': 'fetchMyPosts'
    },

    methods:{
        fetchMyPosts(page=1){
            axios.get('/api/'+ this.$route.params.user_name + '/posts/?page=' + page)
                .then((response) => {
                    this.posts = response.data.data
                    this.loading = false
                })
                .catch(err => {
                    console.log(err)
                });
        },

        isMyPostCheck(){
            if( this.$store.getters.userName == this.$route.params.user_name )
                this.isMyPost = true
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
