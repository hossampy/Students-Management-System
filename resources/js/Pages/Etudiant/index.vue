

<template>
    <Layouts>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Liste de tous les étudiants</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <button class="btn btn-primary">
                                        <i class="fa fa-plus"></i> Nouveau
                                    </button>

                                </div>

                                <div class="card-tools">
                                    <select @change="search" v-model="per_page"  class="form-control  ">
                                        <option  disabled selected>par page</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>

                                </div>
                            </div>

                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>
                                            <p>etudiant</p>
                                            <input @keyup="search" type="text" v-model="searchEtudiant" class="form-control">
                                        </th>
                                        <th>
                                            <p>Niveau scolaire</p>
                                            <select @change="search" class="form-control" v-model="filtreNiveauScolaire">
                                                <option value="0">Tous</option>
                                                <option :value="niveauScolaire.id"  v-for="niveauScolaire in niveauScolaires" :key="niveauScolaire.id">{{niveauScolaire.nom}}</option>

                                            </select>
                                        </th>
                                        <th style="width: 100px"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="etudiant in prop.etudiants.data">
                                        <td>{{ etudiant.nom }} {{ etudiant.prenom }}</td>
                                        <td>{{ etudiant.niveau_scolaire.nom }}</td>
                                        <td>
                                            <div class="d-flex justify-items-center">
                                                <button class="btn btn-info mr-2">
                                                    <i class="fas fa-pen"></i>
                                                </button>
                                                <button class="btn btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
            <Pagination
                :links="prop.etudiants.links"
                :prev="prop.etudiants.prev_page_url"
                :next="prop.etudiants.next_page_url"
            />
        </div>

    </Layouts>

</template>
<script setup>
import {onMounted, ref} from 'vue';
import Layouts from "@/Layouts/MainLayout.vue";
import Pagination from "@/Shared/Pagination.vue";
import {Inertia} from "@inertiajs/inertia";
const prop =defineProps({
    etudiants: Object,
    niveauScolaires: Array,
    filter: Object
});

console.log(prop.filter);

const searchEtudiant = ref(prop.filter.search ??"");
const filtreNiveauScolaire = ref(prop.filter.filter ??"0");
const per_page = ref(   prop.filter.per_page ?? "5");

const search = _.throttle(function(){
    console.log("searchEtudiant : ", searchEtudiant.value )
    console.log("filter : ", filtreNiveauScolaire.value)
    console.log("per_page : ", per_page.value)

    Inertia.get(route("etudiant.index", { search: searchEtudiant.value, filter: filtreNiveauScolaire.value, per_page: per_page.value }), {}, {
        replace: true,
        preserveState: true
    })
}, 500)









/*
onMounted(() => {
    console.log(prop.etudiants);
});
*/
</script>
<style scoped>

</style>
