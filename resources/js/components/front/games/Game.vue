<template>
    <div class="col-12 col-md-4 pt-4">
        <div class="card bg-dark-blue border-light">
            <div class="card-header text-center">
                <img :src="objGame.home.broadcaster.full_logo_src"
                     class="img-thumbnail ml-2 mt-2"
                     style="max-width: 3em;">
                <span class="text-center"> {{ date }} </span>
                <span class="text-center"> {{ time }} </span>
            </div>
            <div class="row">
                <div class="col-3 offset-1 text-center">
                    <span class="fs-6 text-center"> {{ objGame.home.nickname }} </span>
                    <img :src="objGame.home.logo"
                         class="card-img-top" 
                         tyle="width:80%;margin-left: 10%;margin-top: 10%;"
                    >
                </div>
                <div class="col-4 text-center">
                    <h3>vs</h3>
                </div>
                <div class="col-3 text-center">
                    <span class="text-center"> {{ objGame.away.nickname }} </span>
                    <img :src="objGame.away.logo" 
                         class="card-img-top" 
                         tyle="width:80%;margin-left: 10%;margin-top: 10%;"
                    >
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2">
                    <div :class="'row text-white' + (current ? ' bg-success' : '')">
                        <div class="col-12 mb-4 text-center"> 
                            <span>{{ objGame.home.stadium }}</span>
                            <button type="button" class="btn btn-primary btn-sm ml-2" data-bs-toggle="modal" :data-bs-target="'#exampleModal' + objGame.home.id">
                                Ver
                            </button>

                            <div class="modal fade" :id="'exampleModal' + objGame.home.id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-dark-blue">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white" id="exampleModalLabel">{{ objGame.home.stadium }}</h5>
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-white">
                                            <img :src="objGame.home.stadium_image" class="img-thumbnail">
                                            <div>Ciudad: {{ objGame.home.city }}</div>
                                            <div>Domicilio: {{ objGame.home.stadium_address }}</div>
                                            <div>Capacidad: {{ objGame.home.stadium_capacity }}</div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body text-center">
                <div class="row">
                    <div v-if="type=='forecast'" class="col-6 offset-3 text-center">
                        <select class="form-select" :name="'predictions[' + objGame.id + ']'">
                            <option selected>Elige...</option>
                            <option value="L">Local</option>
                            <option value="E">Empate</option>
                            <option value="V">Visita</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    created() {
        this.objGame = JSON.parse(this.content);
    },
    props: {
        content: {
            type: String
        },
        date: {
            type: String
        },
        time: {
            type: String
        },
        type: {
            type: String
        },
        current: {
            type: Number
        }
    },
    data(){
        return {
            objGame: {},
        }
    },
    computed: {
        
    }
}
</script>