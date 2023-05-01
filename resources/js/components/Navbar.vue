<template>
  <div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="/">Test</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
           

              <li class="nav-item" v-if="!logged">
                <a class="nav-link"   href="/login">Connexion</a>
              </li>
              <li class="nav-item" v-if="!logged">
                <a class="nav-link" href="/register">Register</a>
              </li>

              <li class="nav-item"  v-if="logged">
                <a class="nav-link active" aria-current="page" href="/projet">Projet</a>
              </li>

              <li class="nav-item" v-if="logged">
                <a class="nav-link" href="/login" @click="loggut()"  >Deconnecter</a>
              </li>
              
            </ul>
          </div>
        </div>
      </nav>

  </div>
    
</template>

<script>
    export default {
        data(){
            return{
              token : JSON.parse(localStorage.getItem('token') )|| '',
              logged : JSON.parse(localStorage.getItem('token') ? true : false) ,
              user : JSON.parse(localStorage.getItem('user')) || '',
              projets : [],

            }
        },
        mounted(){
                axios.get(`/api/getProjet/${this.user.id}` , {
                   headers: {
                    'Authorization': `bearer ${this.token}`
                  }
                }).then(res =>{
                  this.projet = res.data.data

                }).catch(err=> console.log(err));
        },
        methods: {
          loggut(){
            localStorage.removeItem('token')
            localStorage.removeItem('user')
          }
        },
    }
</script>
