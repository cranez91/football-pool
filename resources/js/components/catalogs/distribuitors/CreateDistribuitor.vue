<template>
    <div class="card">
        <div class="card-header bg-dark-green text-center">{{ editing ? 'Editar' : 'Nuevo' }} Distribuidor</div>

        <div class="card-body bg-dark-blue">
            <div class="row">
                <div class="col-12">
                    <form class="needs-validation" @submit.prevent="submitForm">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input 
                                        v-model="formData.name" 
                                        type="text" 
                                        class="form-control" 
                                        id="name" 
                                        :aria-describedby="'Nombre del negocio/distribuidor.'" 
                                        required>
                                    <div 
                                        id="NombreHelp" 
                                        class="form-text">
                                            Nombre del negocio/distribuidor.
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Se ve bien!
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Domicilio</label>
                                    <input 
                                        v-model="formData.address" 
                                        type="text" 
                                        class="form-control" 
                                        id="address" 
                                        :aria-describedby="'Domicilio: Calle y número, Colonia, C.P.'" 
                                        required>
                                    <div 
                                        id="addressHelp" 
                                        class="form-text">
                                            Domicilio: Calle y número, Colonia, C.P.
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Se ve bien!
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="city" class="form-label">Ciudad</label>
                                    <input 
                                        v-model="formData.city" 
                                        type="text" 
                                        class="form-control" 
                                        id="city" 
                                        :aria-describedby="'Ciudad o Municipio.'" 
                                        required>
                                    <div 
                                        id="cityHelp" 
                                        class="form-text">
                                            Ciudad o Municipio.
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Se ve bien!
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="state" class="form-label">Estado</label>
                                    <input 
                                        v-model="formData.state" 
                                        type="text" 
                                        class="form-control" 
                                        id="state" 
                                        :aria-describedby="'Estado'" 
                                        required>
                                    <div 
                                        id="stateHelp" 
                                        class="form-text">
                                            Estado
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Se ve bien!
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Correo Electrónico</label>
                                    <input 
                                        v-model="formData.email" 
                                        type="email" 
                                        class="form-control" 
                                        id="email" 
                                        :aria-describedby="'Correo Electrónico'" 
                                        required>
                                    <div 
                                        id="emailHelp" 
                                        class="form-text">
                                            Correo Electrónico
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Se ve bien!
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="whats" class="form-label">Whatsapp</label>
                                    <input 
                                        v-model="formData.whatsapp" 
                                        type="text" 
                                        class="form-control" 
                                        id="whats" 
                                        :aria-describedby="'Número de whatsapp a 10 dígitos'" 
                                        required>
                                    <div 
                                        id="whatsHelp" 
                                        class="form-text">
                                            Número de whatsapp a 10 dígitos
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Se ve bien!
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input 
                                        v-model="formData.password" 
                                        type="password" 
                                        class="form-control" 
                                        id="password" 
                                        :aria-describedby="'Contraseña'" 
                                        >
                                    <div 
                                        id="passwordHelp" 
                                        class="form-text">
                                        Contraseña
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Se ve bien!
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                    <input 
                                        v-model="formData.password_confirmation" 
                                        type="password" 
                                        class="form-control" 
                                        id="password_confirmation" 
                                        :aria-describedby="'Confirmar Contraseña'" 
                                        >
                                    <div 
                                        id="password_confirmationHelp" 
                                        class="form-text">
                                        Confirmar Contraseña
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Se ve bien!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" class="btn btn-success">{{ editing ? 'Actualizar' : 'Agregar' }} Distribuidor</button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</template>

<script>
    import InputField from '../../common/forms/InputField.vue';
    import Swal from 'sweetalert2';
    export default {
        components: {
            'input-field': InputField,
        },
        props: {
            editing: {
                type: Boolean,
                default: false,
            },
            initialData: {
                type: Object,
                default: () => ({}),
            },
        },
        mounted() {
        },
        data() {
            return {
                formData: {
                    name: this.initialData.name || '',
                    address: this.initialData.address || '',
                    city: this.initialData.city || '',
                    state: this.initialData.state || '',
                    email: this.initialData.email || '',
                    whatsapp: this.initialData.whatsapp || '',
                    password: '',
                    password_confirmation: '',
                },
            };
        },
        methods: {
            submitForm() {

                if (this.editing && (this.formData.password || this.formData.password_confirmation)) {
                    if (this.formData.password !== this.formData.password_confirmation) {
                        alert('Las contraseñas no coinciden');
                        return;
                    }
                    // Validar que formData.password y formData.password_confirmation contengan almenos 8 caracteres
                    if (this.formData.password.length < 8 || this.formData.password_confirmation.length < 8) {
                        alert('Las contraseñas deben contener almenos 8 caracteres');
                        return;
                    }
                }

                if (!this.editing) {
                    if (!this.formData.password || !this.formData.password_confirmation) {
                        alert('Las contraseñas son obligatorias');
                        return;
                    }
                    if (this.formData.password !== this.formData.password_confirmation) {
                        alert('Las contraseñas no coinciden');
                        return;
                    }
                    // Validar que formData.password y formData.password_confirmation contengan almenos 8 caracteres
                    if (this.formData.password.length < 8 || this.formData.password_confirmation.length < 8) {
                        alert('Las contraseñas deben contener almenos 8 caracteres');
                        return;
                    }
                }

                // Realizar la llamada POST a tu endpoint de Laravel utilizando Axios
                const url = this.editing ? `/distribuitors/${this.initialData.id}` : '/distribuitors';
                const method = this.editing ? 'put' : 'post';

                axios[method](url, this.formData)
                    .then(response => {
                    // Manejar la respuesta exitosa (si es necesario)
                        this.showAlert('success', 'Operación exitosa', '¡El distribuidor se ha guardado correctamente!');

                        // Redireccionar a otra ruta después de 3 segundos si no está editando
                        if (!this.editing) {
                            setTimeout(() => {
                                window.location.href = '/distribuitors';
                            }, 3000);
                        }
                    })
                    .catch(error => {
                    // Manejar el error en caso de que falle la petición
                        this.showAlert('success', 'Operación exitosa', '¡El distribuidor se ha guardado correctamente!');
                    });
            },
            showAlert(icon, title, text) {
                Swal.fire({
                    icon: icon,
                    title: title,
                    text: text,
                });
            },
        },
    }
</script>