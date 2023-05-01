<template>

    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>
                    Hello tache
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                token : localStorage.getItem('token') || '',
                logged : JSON.parse(localStorage.getItem('token') ? true : false) ,
            }
        },
        mounted() {
            if(!this.logged)
                window.location.href = "http://127.0.0.1:8000/login";

        }
    }
</script>
