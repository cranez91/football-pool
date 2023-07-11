<template>
    <div class="row">
        <div class="col-12">
            <div class="row bg-secondary text-black">
                <div :class=" gridColumns + ' text-center'"> {{ objGame.home.name }} </div>
                <div :class=" gridColumns + ' text-center'">
                    <img :src="objGame.home.broadcaster.full_logo_src" class="img-thumbnail ml-2" style="max-width: 3em;">
                    {{ date }} - {{ time }}
                </div>
                <div :class=" gridColumns + ' text-center'"> {{ objGame.away.name }} </div>
                <div v-if="type=='forecast'" class="col-12 col-md-3"> Pronóstico </div>
            </div>
            <div class="row bg-dark-blue text-white">
                <div :class=" gridColumns + ' mt-4 text-center'">
                    <img :src="objGame.home.logo" class="img-thumbnail" style="max-width: 5em;">
                    <p class="pt-2 fs-5 fw-bold"> {{ objGame.home_score }} </p>
                </div>
                <div :class=" gridColumns + ' mt-4 text-center'"> VS </div>
                <div :class=" gridColumns + ' mt-4 text-center'">
                    <img :src="objGame.away.logo" class="img-thumbnail" style="max-width: 5em;">
                    <p class="pt-2 fs-5 fw-bold"> {{ objGame.away_score }} </p>
                </div>
                <div v-if="type=='forecast'" class="col-12 col-md-3 mt-4 text-center pt-4"> 
                    <select class="form-select" :name="'predictions[' + objGame.id + ']'">
                        <option selected>Elige...</option>
                        <option value="L">Local</option>
                        <option value="E">Empate</option>
                        <option value="V">Visita</option>
                    </select>
                </div>
            </div>
            <div class="row bg-dark-blue text-white">
                <div class="col-12 mb-4 text-center"> 
                    <span>{{ objGame.home.stadium }}</span>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm ml-2" data-bs-toggle="modal" :data-bs-target="'#exampleModal' + objGame.home.id">
                        Ver
                    </button>

                    <!-- Modal -->
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
        }
    },
    data(){
        return {
            objGame: {},
        }
    },
    computed: {
        gridColumns () {
            if (this.$props.type=='forecast') {
                return 'col-12 col-md-3';
            }
            return 'col-12 col-md-4';
        }
    }
}
</script>