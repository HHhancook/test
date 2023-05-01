<template>

    <div class="container" v-if ="logged">
    
        <div class="row justify-content-center" v-if="projets.length == '0' " >
            <div class="col-md-8">
                <div class="w-100">
                    <h1 class="text-center">Bonjour <span class="text-uppercase">{{ user.name }}</span></h1><br>
                    <p class="text-center ">Voulez-vous cree un projet ? </p><br>
                
                    <div class="text-center">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary mx-auto">Cree un projet</button>
                    </div>

                </div>
            </div>
        </div>

        <div v-else>
            <label for="selectpicker">Choisir projet</label>
            <select v-model="idProjet" class="selectpicker" data-live-search="true" >
                <option  v-for=" projet of projets" :key="projet.id" :value="projet.id">{{ projet.name }}</option>
            </select>
            <br>
            <div class="text-center">
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2" class="btn btn-primary mx-auto">Cree un tache</button>
            </div>


            <div class="table-responsive">
                
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>A faire</th>
                        <th>En test</th>
                        <th>Termine</th>
             

                    </tr>
                    </thead>
                    <tbody>
                    <tr>  
                        <td>
                            <a @click="updatetache(tache.title,tache.description,tache.user.id,tache.id)" data-bs-toggle="modal" data-bs-target="#exampleModal2" v-for=" tache of a_faire_tache" :key="tache.id" style="cursor: pointer; margin-top: 10px;">
                                <div class="card" style="width: 18rem; ">
                                    <div class="card-body">
                                        <h5 class="card-title text-uppercase text-secondary">{{ tache.user.name }}</h5>

                                        <h5 class="card-title text-primary">{{ tache.title }}</h5>
                                        <p class="card-text text-justify">{{ tache.description }}</p>
                                        <a @click="navigation(tache.statut,'suivant',tache.id)"  style="float: right; margin-top: 50px; cursor: pointer;" > Suivant </a>
                                    </div>
                                </div>
                            </a>
                          
                        </td>   
                        <td>  
                            <a @click="updatetache(tache.title,tache.description,tache.user.id,tache.id)"  data-bs-toggle="modal" data-bs-target="#exampleModal2" v-for=" tache of test_tache" :key="tache.id" style="cursor: pointer; margin-top: 10px;">
                                <div class="card" style="width: 18rem; ">
                                    <div class="card-body">
                                        <h5 class="card-title text-uppercase text-secondary">{{ tache.user.name }}</h5>

                                        <h5 class="card-title text-primary">{{ tache.title }}</h5>
                                        <p class="card-text text-justify">{{ tache.description }}</p>
                                        <a @click="navigation(tache.statut,'suivant',tache.id)"  style="float: right; margin-top: 50px; cursor: pointer;" > Suivant </a>
                                        <a @click="navigation(tache.statut,'precedent',tache.id)" style="float: left; margin-top: 50px; cursor: pointer;"> Precedent </a>
                                    </div>
                                </div>
                            </a>
                            
                        </td>
                        <td>
                            <div  v-for=" tache of termin_tache" :key="tache.id" style="cursor: pointer; margin-top: 10px;">
                                <a @click="updatetache(tache.title,tache.description,tache.user.id,tache.id)" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                <div class="card" style="width: 18rem; ">
                                    <div class="card-body">
                                        <h5 class="card-title text-uppercase text-secondary">{{ tache.user.name }}</h5>
                                        <h7 class="card-title text-primary">{{ tache.title }}</h7>
                                        <p class="card-text text-justify">{{ tache.description }}</p>

                                        <a @click="navigation(tache.statut,'precedent',tache.id)" style="float: left; margin-top: 50px; cursor: pointer;"> Precedent </a>
                                    </div>
                                </div>
                            </a>

                            </div>
                          
                        </td>
                      
                    </tr>
                   
                    </tbody>
                </table>
                </div>

        </div>

        <div  class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Projet</h1>
                    <button type="button" @click="cleardata()"  class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div v-if="message != ''" class="alert alert-danger" role="alert">
                    {{ message }}
                </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Choisir le nom de projet</label>
                        <input v-model="projetAdd.name"  type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" @click="cleardata()" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" @click="addProjet()" class="btn btn-primary">Save changes</button>
                </div>
              
                </div>
            </div>
        </div>
        
        <div  class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel2">Tache</h1>
                    <button type="button" @click="clearDataTache()"  class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
              
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Titre tache</label>
                        <input v-model="tache.titre"  type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div class="form-floating">
                        <textarea v-model="tache.description"   class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">Description</label>
                    </div>

                    <label for="selectpicker">Utilisateur</label>
                        <select v-model="tache.user_id" class="selectpicker" data-live-search="true" >
                            <option  v-for=" user of userAll" :key="user.id" :value="user.id">{{ user.name }}</option>
                        </select>

                </div>

               

                <div class="modal-footer">
                    <button type="button" @click="clearDataTache()" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" @click="addTache()" class="btn btn-primary">Save changes</button>
                </div>
              
                </div>
            </div>
            
        
        </div>


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
                projetAdd:{
                    name : '',
                    user_id : ''
                },
                tache:{
                    id:'',
                    titre:'',
                    description:'',
                    user_id:'',
                    projet_id:''
                },
                userAll : [],
                tacheInProjet:[],
                idProjet: '',
                message : '',
                a_faire_tache:[],
                test_tache:[],
                termin_tache:[],

        
 
            }
        },
        mounted() {
            if(!this.logged)
                window.location.href = "http://127.0.0.1:8000/login";
            this.fetchProjet()
            this.getUser()
        },
        watch:{
            idProjet(){
                
                this.fetchProjetById()
            }
        },

        methods: {
            methodeShowModelProjet(){
                this.showModalProjet = true
            },
            getUser(){
                axios.get(`/api/getUser` , {
                   headers: {
                    'Authorization': `bearer ${this.token}`
                  }
                }).then(res =>{
                    console.log( res)
                    this.userAll = res.data

                }).catch(err=> console.log(err));

            },
            fetchProjet(){
                axios.get(`/api/getProjet/${this.user.id}` , {
                   headers: {
                    'Authorization': `bearer ${this.token}`
                  }
                }).then(res =>{
                    this.projets = res.data.data

                }).catch(err=> console.log(err));

            },
            fetchProjetById(){
                axios.get(`/api/getProjetById/${this.idProjet}` , {
                   headers: {
                    'Authorization': `bearer ${this.token}`
                  }
                }).then(res =>{
                    this.tacheInProjet = res.data.data
                    console.log(this.tacheInProjet)
                    this.filtre(this.tacheInProjet)

                }).catch(err=> console.log(err));

            },
            filtre(data){
               this.a_faire_tache = data.filter(item => item.statut == 'a_faire')
               this.test_tache = data.filter(item => item.statut == 'test')
               this.termin_tache = data.filter(item => item.statut == 'termin')

            },
            updatetache(title,description,user_id,id){

                this.tache = {
                    id: id,
                    titre: title,
                    description: description,
                    user_id: user_id,
                }

            },
            addProjet(){
                this.projetAdd.user_id = this.user.id
                if(this.projetAdd.name != ''){
                    axios.post('/api/addProject',this.projetAdd  , {
                   headers: {
                    'Authorization': `bearer ${this.token}`
                  }
                }).then(res =>{

                    if(res.data.success){
                        this.projets.push(res.data.data)
                        this.cleardata()

                    }

                }).catch(err=> console.log(err));

                }else{
                    this.message = 'Remplir name'
                }
              

            },

            navigation(statut,type,id){
                
                axios.post('/api/suivantPrecedent',{"statut": statut, "type": type, "id": id}, {
                   headers: {
                    'Authorization': `bearer ${this.token}`
                  }
                }).then(res =>{

                    this.fetchProjetById()
                }).catch(err=> console.log(err));

                
              

            },
            cleardata(){
                this.projetAdd.name = ''
                this.message = ''
         
            },
            clearDataTache(){
                this.tache.titre = ''
                this.tache.description = ''
                this.tache.user_id = ''
                this.tache.id = ''

            },
            addTache(){
                console.log(this.tache.id);
                this.tache.projet_id = this.idProjet

                if( this.tache.id != '' ){
                    axios.post('/api/updateTask',this.tache , {
                    headers: {
                    'Authorization': `bearer ${this.token}`
                    }
                 }).then(res =>{
                    if(res.data.success){
                        this.clearDataTache()
                        this.fetchProjetById()
                    }

                }).catch(err=> console.log(err));

                }

                axios.post('/api/addTask',this.tache , {
                    headers: {
                    'Authorization': `bearer ${this.token}`
                    }
                 }).then(res =>{
                    if(res.data.success){
                        this.clearDataTache()
                        this.fetchProjetById()
                    }

                }).catch(err=> console.log(err));

            }
        },


    }
</script>
