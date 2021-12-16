@extends('main')

@section('title') Register @endsection()

@section('content')
    <h1>Register page</h1>
    <div class="container" id="my_app">
        <form id="user_form" action="save_user" method="post">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" placeholder="First name" v-model="first_name">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control" placeholder="Last name" v-model="last_name">
            </div>
            <div class="form-group">
                <label>Email address</label>
                <input type="email" class="form-control" placeholder="Enter email" v-model="email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" placeholder="Password" v-model="password">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Confirm Password</label>
                <input type="password" class="form-control" placeholder="Confirm password" v-model="confirm_password">
            </div>
            <button type="submit" class="btn btn-primary" v-on:click="adduser();">Submit</button>
        </form>
    </div>

    <script>
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var app = new Vue({
            el: '#my_app',

            data: {
                first_name: '',
                last_name: '',
                email: '',
                password: '',
                confirm_password: '',
            },

            methods: {
                adduser: function() {
                    const config = {
                        headers: { 'content-type': 'text/html' }
                    }
                    let formData = new FormData();
                    formData.append('first_name', this.first_name);
                    formData.append('last_name', this.last_name);
                    formData.append('email', this.email);
                    formData.append('password', this.password);
                    formData.append('confirm_password', this.confirm_password);
                    axios.post('save_user', formData)
                    .then(function (response) {
                        if(response.status === 200){
                        window.location.href = "login";
                        } 
                    })
                    .catch(function (error) {
                        var er = error.response.data.errors;
                        if(er.first_name){
                        $(".error").text(er.first_name);
                        this.first_name.focus();
                        }else if(er.last_name){
                        $(".error").text(er.last_name);
                        this.last_name.focus();
                        }else if(er.email){
                        $(".error").text(er.email);
                        this.email.focus();
                        }else if(er.password){
                        $(".error").text(er.password);
                        this.password.focus();
                        }else if(er.confirm_password){
                        $(".error").text(er.confirm_password);
                        this.confirm_password.focus();
                    });
                }               
            }
        })
    </script>
@endsection()