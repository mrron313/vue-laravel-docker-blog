<template>

    <div class="row">
        <div class="col-md-8">
            <h2>Create a post</h2>
            <hr>

            <div v-if="success == true" class="alert alert-success" role="alert">
                {{ successMsg }}
            </div>

            <div v-if="success == false">
                <div class="alert alert-danger" v-for="(value, key, index) in validationErrors" :key="index">
                    {{ value }}
                </div>
            </div>

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
                title: '',
                body: '',
                category_id: '',
                identification_token: this.$store.getters.userToken
            },
            success: false,
            validationErrors: {},
            categories: {},
            successMsg: ''
        }
    },

    mounted(){
        this.fetchCategories()
    },

    methods:{
        submit(){
            axios.post('/api/posts', this.fields)
            .then((response) => {
                this.fields = {}
                this.success = true
                this.successMsg = response.data.message
            }).catch((error) => {
                if (error.response.status == 422){
                    this.validationErrors = Object.values(error.response.data.errors).flat()                        
                    this.success = false
                    this.successMsg = ''
                }
            });
        },

        fetchCategories(){
            axios.get('/api/categories').then((response) => {
                this.categories = response.data.data
            }).catch((error) => {
                console.log(error)
            })
        }
    }
}
</script>

