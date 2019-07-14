<template>
    <div>
        
    </div>
</template>

<script>
export default {
    data(){
        return {
            posts: []
        }
    },
    created() {
        axios.get("/api/posts")
            .then(response => {
                this.posts = response.data
            })
        console.log("hello")       
    }
}
</script>