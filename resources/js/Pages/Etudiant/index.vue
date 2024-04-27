<script setup>
import { onMounted } from 'vue';
import Layouts from "@/Layouts/MainLayout.vue";
const prop =defineProps({
    etudiants: Array
});


onMounted(() => {
    console.log(prop.etudiants);
});
</script>

<template>
    <Layouts>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Page de Etudiant 123</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid" >
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">nom</th>
                        <th scope="col">prenom</th>
                        <th scope="col">niveau</th>

                    </tr>
                    </thead>
                    <thead class="thead-light" v-for="etudiant in etudiants" :key="etudiant.id" >
                    <tr >
                        <th scope="col">{{etudiant.id}}</th>
                        <th scope="col">{{etudiant.nom}}</th>
                        <th scope="col">{{etudiant.prenom}}</th>
                        <th scope="col">{{etudiant.niveau_scolaire.nom}}</th>

                    </tr>
                    </thead>
                    <tbody  >

                    </tbody>
                </table>
            </div>
        </div>

    </Layouts>
</template>

<style scoped>

</style>
