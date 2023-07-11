<template>
    <div class="card">
        <div class="card-header bg-dark-green text-center">Nuevo Equipo</div>

        <div class="card-body bg-dark-blue">
            <div class="row">
                <div class="col-12">
                    <form class="needs-validation">
                        <input-field label="Nombre" type="text" id="name" help="Ingresa el nombre del equipo.">
                        </input-field>
                        <div class="input-group mb-3 col-12 col-lg-6">
                            <label class="input-group-text" for="inputCountry">País</label>
                            <select class="form-select" id="inputCountry" required>
                                <option selected>Selecciona...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="input-group mb-3 col-12 col-lg-6">
                            <label class="input-group-text" for="inputLogo">Logo</label>
                            <input type="file" class="form-control" id="inputLogo" required>
                        </div>
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