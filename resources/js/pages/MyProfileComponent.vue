<template>

    <div class="row">
        <div class="col-md-8">
            
            <h2>Profile</h2>
            <hr>

            <div v-if="success == true" class="alert alert-success" role="alert">
                {{ successMsg }}
            </div>

            <div v-if="success == false">
                <div class="alert alert-danger" v-for="(value, key, index) in validationErrors" :key="index">
                    {{ value }}
                </div>
            </div>

            <div class="photo-upload text-center">
                <div class="col-md-12">
                    <div class="imageDisplay">
                        <img :src="'/uploads/user/default.jpg'"  alt="profile image">
                    </div>
                </div>
                <!-- <div class="col-md-12">
                    <div class="avatar-upload">
                        <div class="form-group">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    <input type="file"  id="imgInp">
                                </span>
                            </span>
                        </div>
                    </div>
                </div> -->
            </div>

            <div class="row">    
                <div class="col-md-12 personal-info">
                    
                    <div v-if="loading == true" class="loading">
                        Loading...
                    </div>

                    <form v-if="loading == false" @submit="updateUserData" class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Name:</label>
                            <div class="col-lg-12">
                                <input class="form-control" type="text" v-model="user.name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Email:</label>
                            <div class="col-lg-12">
                                <input disabled class="form-control" type="text" :value="user.email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Username:</label>
                            <div class="col-md-12">
                                <input disabled class="form-control" type="text" :value="user.user_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-primary" value="Save Changes">
                            <span></span>
                            <input type="reset" class="btn btn-default" value="Cancel">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
                user: {},
                loading: true,
                success: false,
                validationErrors: {},
                successMsg: ''
            }
        },

        mounted(){
            this.fetchUserData()
        },

        methods:{
            fetchUserData(){
                axios.get('/api/user/edit/' + this.$store.getters.userToken)
                    .then((response) => {
                        this.user = response.data
                        this.loading = false
                    })
                    .catch(err => {
                        console.log(err)
                    });
            },

            updateUserData(e){
                e.preventDefault();

                axios.put('/api/user/update', {
                    token: this.$store.getters.userToken,
                    name: this.user.name
                })
                .then((response) => {
                    this.success = true
                    this.validationErrors = {}
                    this.successMsg = response.data.message
                    this.user = response.data.data
                })
                .catch((error) => {
                    if( error.response.status = 422 ){
                        this.validationErrors = Object.values(error.response.data.errors).flat()                        
                        this.success = false
                        this.successMsg = ''
                    }
                })
            }
        }
    }

</script>

<style scoped>

.imageDisplay{
    padding: 45px 90px;
    border: 1px solid #ced4da;
    margin: 34px 107px;
    border-radius: 33px;
}

.imageDisplay img{
    border-radius: 68px;
    border: 1px solid #ced4da;
    width: 128px;
    height: 128px;
    margin-bottom: 20px;
}

.personal-info{
    margin: 20px 0px;
    padding: 0px
}

</style>
