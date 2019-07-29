<template>

    <div class="row">
        <div class="col-md-8">
            <h2>Edit Profile</h2>
            
            <div class="row photo-upload text-center">
                <div class="col-md-12">
                    <div class="imageDisplay">
                        <img :src="'/uploads/user/default.jpg'"  alt="profile image">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="avatar-upload">
                        <div class="form-group">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    <input type="file"  id="imgInp">
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">    
                <div class="col-md-12 personal-info">
                    
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Name:</label>
                            <div class="col-lg-12">
                                <input class="form-control" type="text" value="Jane">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Email:</label>
                            <div class="col-lg-12">
                                <input class="form-control" type="text" value="janesemail@gmail.com">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Username:</label>
                            <div class="col-md-12">
                                <input class="form-control" type="text" value="janeuser">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Password:</label>
                            <div class="col-md-12">
                            <input class="form-control" type="password" value="11111122333">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Confirm password:</label>
                            <div class="col-md-12">
                            <input class="form-control" type="password" value="11111122333">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-12">
                                <input type="button" class="btn btn-primary" value="Save Changes">
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

.photo-upload{
    padding: 21px 63px;
    border: 1px solid #ced4da;
    margin: 34px 10px;
    border-radius: 33px;
}

.personal-info{
    margin: 20px 0px
}

</style>
