<template>
    <div class="mb-3">
        <label :for="id" class="form-label">{{ label }}</label>
        <input :type="type" class="form-control" :id="id" :aria-describedby="label + 'Help'" required>
        <div :id="label + 'Help'" class="form-text">{{ help }}</div>
        <div class="valid-feedback">
            ¡Se ve bien!
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
        },
        props: {
            type: {
                type: String
            },
            id: {
                type: String
            },
            label: {
                type: String
            },
            help: {
                type: String
            }
        },
        data () {
            return {

            }
        }
    }
    
</script>
