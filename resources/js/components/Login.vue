

<template>

    <div class="container">
        <div v-if="message != ''" class="alert alert-danger" role="alert">
            {{ message }}
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input v-model="user.email"  type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                        <input v-model="user.password" type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    
                    <button @click="login()"  type="button" class="btn btn-primary">Connectez-vous</button>

                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                user: {
                    email : null,
                    password : null,
                },
                token : localStorage.getItem('token') || '',
                logged : JSON.parse(localStorage.getItem('token') ? true : false) ,
                message : ''
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            login(){


                axios.post('/api/login',this.user).then(res =>{
                    if(res.data.token){
                          localStorage.setItem('user',JSON.stringify(res.data.user));
                        localStorage.setItem('token',JSON.stringify(res.data.token));
                        window.location.href = "http://127.0.0.1:8000/projet";

                    }else{
                        this.user = {email : null , password : null}
                        this.message = 'le mot de passe et email sont incorrect'
                    }

                }).catch(err=> console.log(err));
            }
            
        },
    }
</script>
