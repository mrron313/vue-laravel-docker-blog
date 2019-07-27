<template>

    <div class="row">
        <div class="col-md-8">
            <div v-if="savingStatus == true" class="alert alert-success" role="alert">
                Your post is in pending list.
            </div>

            <h2>Create a post</h2>
            <form @submit.prevent="submit">
                <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" class="form-control" name="title" id="name" v-model="fields.title" />
                </div>
                
                <div class="form-group">
                    <label for="message">Category</label>
                    <select class="form-control" name="category_id" id="category" v-model="fields.category_id">
                        <option v-for="category in categories" :key="category.id" :value="category.id">
                            {{ category.name }}
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="message">Body</label>
                    <textarea class="form-control" name="message" id="body" rows="5"  v-model="fields.body"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
        <div class="col-md-4">
            <sidebar-component />
        </div>
    </div>

</template>

<script>
export default {
    data(){
        return{
            fields: {
                'identification_token': this.$store.getters.userToken
            },
            savingStatus: false,
            errors: {},
            categories: {},
        }
    },

    mounted(){
        this.fetchCategories()
    },

    methods:{
        submit(){
            this.errors = {}

            axios.post('/api/posts', this.fields).then((reponse) => {
                this.fields.category_id = null 
                this.fields.title = null 
                this.fields.body = null 
                this.savingStatus = true
            }).catch((error) => {
                console.log(error)
            });
        },

        fetchCategories(){
            axios.get('/api/categories').then((response) => {
                this.categories = response.data.data;
            }).catch((error) => {
                console.log(error)
            })
        }
    }
}
</script>

