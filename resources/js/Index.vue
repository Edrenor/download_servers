<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Servers table</h1>

            <servers-table :servers="servers"></servers-table>
        </div>
    </div>
</template>

<script>

    import ServersTable from './components/ServersTable'
    import axios from 'axios'

    export default {
        name:       "Index",
        components: {
            ServersTable
        },
        data() {
            return {
                servers: []
            }
        },
        mounted() {
            this.loadServers();
            console.log(22);
        },
        methods:    {
            loadServers() {
                axios.get('/servers').then(res => {this.servers = res.data})
            },
        }
    }

</script>

<style scoped>

</style>
