

<template>

    <div class="container">
        <div v-if="message != ''" class="alert alert-danger" role="alert">
            {{ message }}
        </div>
        
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form>

                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Nom complet</label>
                        <input v-model="user.name"  type="text" class="form-control" id="exampleInputName">
                    </div>
                    
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input v-model="user.email"  type="text" class="form-control" id="exampleInputEmail1">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                        <input v-model="user.password" type="password" class="form-control" id="exampleInputPassword1">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword2" class="form-label">Nouveau mot de passe</label>
                        <input v-model="confirmPassword" type="password" class="form-control" id="exampleInputPassword2">
                    </div>
                    
                    <button @click="register()" type="button" class="btn btn-primary">Inscriptez-vous</button>
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
                    name : null,
                    email : null,
                    password : null,
                }, 
                confirmPassword : null,
                message : ''
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            register(){
                if( this.confirmPassword == this.user.password ){
                    axios.post('/api/register',this.user).then(res =>{
                        if(res.data.token){
                            this.message = ''
                            this.user = {email : null , password : null , name : null}
                            this.confirmPassword = null
                            localStorage.setItem('user',JSON.stringify(res.data.user));
                            localStorage.setItem('token',JSON.stringify(res.data.token));
                            window.location.href = "http://127.0.0.1:8000/projet";

                        }else{
                            this.user = {email : null , password : null , name : null}
                            this.message = 'les informations ne sont pas correcte'
                        }

                    }).catch(err=> console.log(err)); 

                }
                else{
                    this.message = 'Confirmation mot de passe ne sont pas correct'

                }

                               
            }
            
        },
    }
</script>
