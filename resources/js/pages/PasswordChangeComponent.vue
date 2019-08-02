<template>

    <div class="row">
        <div class="col-md-8">
            <h2>Edit Password</h2>
            <hr>
            
            <div v-if="success == true" class="alert alert-success" role="alert">
                {{ successMsg }}
            </div>

            <div v-if="success == false">
                <div class="alert alert-danger" v-for="(value, key, index) in validationErrors" :key="index">
                    {{ value }}
                </div>
            </div>

            <div class="col-md-12 personal-info">
                <form @submit="updatePassword" class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Password:</label>
                        <div>
                            <input class="form-control" type="password" v-model="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Confirm password:</label>
                        <div>
                            <input class="form-control" type="password" v-model="cPassword">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div>
                            <input type="submit" class="btn btn-primary" value="Save Changes">
                            <span></span>
                            <input type="reset" class="btn btn-default" value="Cancel">
                        </div>
                    </div>
                </form>
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
                success: false,
                password: '',
                cPassword: '',
                validationErrors: {},
                successMsg: ''

            }
        },

        methods:{
            updatePassword(e){
                e.preventDefault();

                axios.put('/api/user/password/update', {
                    token: this.$store.getters.userToken,
                    password: this.password,
                    password_confirmation: this.cPassword
                })
                .then((response) => {
                    this.password = ''
                    this.cPassword = ''
                    this.success = true
                    this.successMsg = response.data.message
                    this.validationErrors = {}
                })
                .catch((error) => {
                    if (error.response.status == 422){
                        this.password = ''
                        this.cPassword = ''
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

.personal-info{
    margin: 20px 0px;
    padding: 0px
}

.control-label{
    padding: 0px
}

</style>
