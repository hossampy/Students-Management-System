<script setup>
import { defineProps, onMounted } from 'vue';
import Pagination from '@/Shared/Pagination.vue';
import {Link} from "@inertiajs/vue3";
import Layouts from "@/Layouts/MainLayout.vue";
import CreateNiveauScolaire from "@/Pages/NiveauScolaire/CreateNiveauScolaire.vue";
const prop = defineProps({
    niveauscolaires: Object
});
/*
onMounted(() => {
    console.log(prop.niveauscolaires);
});*/
</script>

<template>
    <Layouts>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Liste de tous les niveaux scolaires</h1>
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
                                <div>
                                    <CreateNiveauScolaire />
                                </div>

                            </div>

                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Nivau scolaire</th>
                                        <th style="width: 100px"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="niveauScolaire in niveauscolaires.data">
                                        <td>{{niveauScolaire.nom}}</td>
                                        <td>
                                            <div class="d-flex justify-items-center">
                                                <button class="btn btn-info mr-2"><i class="fas fa-pen"></i></button>
                                                <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
            <div class="card-tools m-3">
                <Pagination
                    :links="niveauscolaires.links"
                    :prev="niveauscolaires.prev_page_url"
                    :next="niveauscolaires.next_page_url" />

            </div>
        </div>

    </Layouts>
</template>

<style scoped>

</style>
