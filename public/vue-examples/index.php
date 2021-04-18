<?php require 'header.php' ?>
<div id="app">
    <section class="section">
        <div class="container has-text-centered" v-for="logo in logos">
            <a :href="logo.site">
                <img :src="logo.img">
            </a>
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
        }
    }).mount('#app');
</script>
<?php require 'footer.php' ?>