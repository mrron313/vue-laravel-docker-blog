<template>

    <div class="row">
        <div class="col-md-12">

            <div v-if="loading" class="loading">
                Loading...
            </div>

            <!-- Title -->
            <h1 class="mt-4">{{ post.title }}</h1>

            <!-- Author -->
            <p class="lead">
                by
                <a href="#">{{ post.user.name }}</a>
            </p>

            <hr>

            <!-- Date/Time -->
            <p>Posted on: {{ post.created_at }}</p>

            <hr>

            <!-- Preview Image -->
            <img class="img-fluid rounded" src="http://placehold.it/1100x400" alt="">

            <hr>

            <!-- Post Content -->
            <p>
                {{ post.body }}
            </p>
            <hr>

            <!-- Comments Form -->
            <div v-if="this.$store.getters.isLoggedIn == true" class="card my-4">
                <h5 class="card-header">Leave a Comment:</h5>
                <div class="card-body">
                    <form @submit="submitComment">
                        <div class="form-group">

                            <textarea v-model="comment.reply" class="form-control" rows="3"></textarea>
                        
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

            <!-- Single Comment -->
            <div v-for="cmnt in post.comments" :key="cmnt.id" class="media mb-4">
                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                    <h5 class="mt-0"> {{ cmnt.user.name }} </h5>
                    {{ cmnt.reply }}
                        <a class="btn btn-link" data-toggle="collapse" :href="'#multiCollapseExample' + cmnt.id" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Reply</a>
                        <div class="collapse multi-collapse" :id="'multiCollapseExample' + cmnt.id">
                            <div class="card card-body">
                                <form @submit="submitComment">
                                    <div class="form-group">

                                        <textarea v-model="comment.reply" class="form-control" rows="3"></textarea>
                                        <input type="text" v-model="cmnt.id">

                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    <div v-for="reply in cmnt.replies" :key="reply.id" class="media mt-4">
                        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                        <div class="media-body">
                            <h5 class="mt-0"> {{ reply.user.name }} </h5>
                            {{ reply.reply }} 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    data(){
        return {
            loading: true,
            post: {
                title: '',
                body: '',
                created_at: '',
                user: {
                    name: ''
                },
                comments: {
                    post_id: '',
                    reply: '',
                    user: {
                        name: ''
                    },
                    parent_id: '',
                    token: ''
                }
            },
            comment:{
                post_id: this.$route.params.id,
                reply: '',
                parent_id: 0,
                token: this.$store.getters.userToken
            },
            cmnt: {
                id: ''
            }
        }
    },

    mounted() {
      this.fetchData()
    },

    methods:{
        fetchData(){
            axios.get('/api/posts/' + this.$route.params.id)
                .then((response) => {
                    this.post = response.data.data
                    this.loading = false
                })
                .catch(err => {
                    console.log(err)
                });
        },

        submitComment(e){
            e.preventDefault();

console.log(this.cmnt)
            axios.post('/api/comments', this.comment)
                .then((response) => {
                    console.log(response)
                })
                .catch((err) => {
                    console.log(err)
                })
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
