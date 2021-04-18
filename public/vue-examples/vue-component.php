<?php require 'header.php' ?>

<?php require 'vue-component-hello.php' ?>
<div id="app">
    <section class="section">
        <div class="container has-text-centered">
            <vue-component-hello></vue-component-hello>
        </div>
    </section>
</div>
<script>
    Vue.createApp({
        data() {
            return {
                logos: [
                    {site: 'https://bulma.io', img: 'https://bulma.io/images/made-with-bulma.png'},
                    {site: 'https://v3.vuejs.org', img: 'https://v3.vuejs.org/logo.png'}
                ]
            }
        },
        components: {
            'vue-component-hello': VueComponentHello
        }
    }).mount('#app');
</script>
<?php require 'footer.php' ?>