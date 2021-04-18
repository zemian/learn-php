<template id="vue-component-hello">
    <div>
        <p class="title is-3">{{message}}</p>
    </div>
</template>
<script>
    const VueComponentHello = {
        template: '#vue-component-hello',
        data() {
            return {
                message: "Hello World"
            }
        }
    }
</script>