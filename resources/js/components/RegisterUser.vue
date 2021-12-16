<template>
    <div class="row auth_row">
        <div class="col-lg-6 color-white auth_title">
            <u>Register here:</u>
        </div>
        <div class="col-lg-6 white_card">
            <form @submit.prevent="submit">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" placeholder="First name" v-model="fields.first_name">
                    <div class="alert-text" v-if="errors && errors.first_name">{{ errors.first_name[0] }}</div>
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" placeholder="Last name" v-model="fields.last_name">
                    <div class="alert-text" v-if="errors && errors.last_name">{{ errors.last_name[0] }}</div>
                </div>
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
                <div class="form-group">
                    <label for="exampleInputPassword1">Confirm Password</label>
                    <input type="password" class="form-control" placeholder="Confirm password" v-model="fields.confirm_password">
                    <div class="alert-text" v-if="errors && errors.confirm_password">{{ errors.confirm_password[0] }}</div>
                </div>
                <button type="submit" class="btn btn-primary" >REGISTER</button>
                <a href="/login" class="text-small">Already have account? Login</a>
            </form>
        </div>
    </div>
    
</template>

<script>
    export default {
        data () {
            return{
                fields: {},
                errors: {}
            }
        },

        methods: {
            submit() {
                axios.post('/register/user', this.fields).then(response => {
                    this.fields = {};
                    window.location.href = 'login';
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