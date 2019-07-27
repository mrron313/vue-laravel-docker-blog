<template>
    <!-- Blog Post -->
    <div class="card mb-4">
        <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
        <div class="card-body">
            <h2 class="card-title">{{ title }}</h2>

            {{ body | truncate(200, '...')}}

            <router-link :to="{ name: 'single-component', params: {id: id } }">Read more</router-link>
        </div>
        <div class="card-footer text-muted">
            <div class="postedOn">
                Posted on {{ created }} by
                <router-link :to="{ name: 'single-user-post-component', params: {user_name: userSlug } }">{{ user }}</router-link>
            </div>
            <div class="categoryName">
                Category: {{ category }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [ 'id', 'title', 'body', 'created', 'user', 'category'],

    mounted(){
        console.log(this.$props.user)
    },

    computed: {
        userSlug: function () {

            var str = this.$props.user

            str = str.replace(/^\s+|\s+$/g, '');

            str = str.toLowerCase();

            var from = "ÁÄÂÀÃÅČÇĆĎÉĚËÈÊẼĔȆÍÌÎÏŇÑÓÖÒÔÕØŘŔŠŤÚŮÜÙÛÝŸŽáäâàãåčçćďéěëèêẽĕȇíìîïňñóöòôõøðřŕšťúůüùûýÿžþÞĐđßÆa·/_,:;";
            var to   = "AAAAAACCCDEEEEEEEEIIIINNOOOOOORRSTUUUUUYYZaaaaaacccdeeeeeeeeiiiinnooooooorrstuuuuuyyzbBDdBAa------";
            for (var i=0, l=from.length ; i<l ; i++) {
                str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }

            str = str.replace(/[^a-z0-9 -]/g, '') 
            .replace(/\s+/g, '-') 
            .replace(/-+/g, '-'); 

            return str;
        }
    }
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
