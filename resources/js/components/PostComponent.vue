<template>
    <!-- Blog Post -->
    <div class="card mb-4">
        <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
        <div class="card-body">
            <h2 class="card-title">{{ title }} </h2> <span class="badge badge-info" v-if="approved == 0"> Not Approved </span> 
            <br>

            {{ body | truncate(200, '...')}}

            <router-link :to="{ name: 'single-component', params: {id: id } }">Read more</router-link>
        </div>
        <div class="card-footer text-muted">
            <div class="postedOn">
                Posted on {{ created }} by
                <router-link :to="{ name: 'single-user-post-component', params: {user_name: user_name } }">{{ user }}</router-link>
            </div>
            <div class="categoryName">
                Category: {{ category }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [ 'id', 'title', 'body', 'approved', 'created', 'user', 'user_name', 'category'],

    data(){
        return{}
    },

    mounted(){} ,
}
</script>

<style scoped>
    h2{
        display: inline-block;
    }

    span{
        font-size: 16px;
        margin-left: 10px
    }

    .postedOn{
        width: 60%;
        float: left
    }

    .categoryName{
        width: 40%;
        float: right
    }
</style>
