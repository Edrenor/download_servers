<template>
    <div class="v-table">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Provider</th>
                <th scope="col">Brand</th>
                <th scope="col">Location</th>
                <th scope="col">CPU</th>
                <th scope="col">Drive</th>
                <th scope="col">Price</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="server in servers">
                <td>{{server.provider}}</td>
                <td>{{server.brand}}</td>
                <td>{{server.location}}</td>
                <td>{{server.cpu}}</td>
                <td>{{server.drive}}</td>
                <td>{{server.price}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name:  "ServersTable",
        props: {
            servers: {
                type: Array,
            }
        },
    }
</script>

<style scoped>

</style>
