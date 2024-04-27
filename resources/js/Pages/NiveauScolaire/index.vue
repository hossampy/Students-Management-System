<script setup>
import { defineProps, onMounted } from 'vue';
import Pagination from '@/Pagination.vue';
import {Link} from "@inertiajs/vue3";
import Layouts from "@/Layouts/MainLayout.vue";
const prop = defineProps({
    niveauscolaires: Object
});
onMounted(() => {
    console.log(prop.niveauscolaires);
});
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
                                <h3 class="card-title"></h3>
                                <div class="card-tools">
                                    <Pagination
                                        :links="niveauscolaires.links"
                                        :prev="niveauscolaires.prev_page_url"
                                        :next="niveauscolaires.next_page_url" />

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
        </div>

    </Layouts>
</template>

<style scoped>

</style>
