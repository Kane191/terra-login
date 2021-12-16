<template>
    <div class="row auth_row">
        <div class="col-lg-6 color-white auth_title">
            <u>Login:</u>
        </div>
        <div class="col-lg-6 white_card">
            <form @submit.prevent="submit">
                <div class="alert-text" v-if="!response">Whoops! The provided credentials do not match our records.</div>
                <div class="form-group">
                    <label>Email address</label>
                    <input type="email" class="form-control" placeholder="Enter email" v-model="fields.email">
                    <div class="alert-text" v-if="errors && errors.email">{{ errors.email[0] }}</div>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" placeholder="Password" v-model="fields.password">
                    <div class="alert-text" v-if="errors && errors.password">{{ errors.password[0] }}</div>
                </div>
                <button type="submit" class="btn btn-primary" >Submit</button>
            </form>
        </div>
    </div>
</template>


<script>
    export default {
        data () {
            return{
                fields: {},
                errors: {},
                response:{},
            }
        },

        methods: {
            submit() {
                axios.post('/login/user', this.fields).then(response => {
                    this.response = response.data;
                    if (response.data == 'success'){
                        this.fields = {};
                        window.location.href = 'home';
                    }
                    console.log(response);
                }).catch(error => {
                    if(error.response.status == 422){
                        this.errors = error.response.data.errors;
                    }    
                    console.log(error);
                });
            }
        }
    }
</script>