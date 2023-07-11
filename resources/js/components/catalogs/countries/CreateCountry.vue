<template>
    <div class="card">
        <div class="card-header bg-dark-green text-center">Nuevo Pais</div>

        <div class="card-body bg-dark-blue">
            <div class="row">
                <div class="col-12">
                    <form class="needs-validation">
                        <input-field label="Nombre" type="text" id="name" help="Ingresa el nombre del nuevo país.">
                        </input-field>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" class="btn btn-success">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import InputField from '../../common/forms/InputField.vue';

    export default {
        components: {
            'input-field': InputField,
        },
        mounted() {
        }
    }
</script>
