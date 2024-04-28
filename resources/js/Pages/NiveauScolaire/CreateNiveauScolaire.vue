<script setup>
import Layouts from "@/Layouts/MainLayout.vue";
import { Inertia } from "@inertiajs/inertia";
import {useSwallError,useSwallSuccess} from "@/Composables/alert.js";

import {onMounted, ref} from "vue";

let createModal = null;
let nomNiveauScolaire = ref("");





onMounted(() => {
    setTimeout(() => {
        createModal = $("#cerateNvmodel");
    }, 100); // Delay for 100 milliseconds
});
const closeModal = () => {
    nomNiveauScolaire.value = "";
    createModal.modal("hide");
};


const soumettre = () => {
    const nom = nomNiveauScolaire.value;
    const url = route('niveauScolaire.store');
    Inertia.post(url, {nom}, {
        onSuccess: () => {
            closeModal();
            useSwallSuccess("Niveau scolaire ajouté avec succès")

        },onError: (errors) => {
           console.log(errors)
            useSwallError(errors.nom)
        }

    })
};

</script>

<template>
   <button class="btn btn-primary" data-toggle="modal" data-target="#cerateNvmodel"  >
       <i class="fa fa-plus"></i>  create new level
   </button>
    <div >
        <div class="modal fade" id="cerateNvmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">create new level</h5>
                        <button type="button" class="close"  @click="closeModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="soumettre" id="createForm">
                            <div class="form-group">
                                <label for="">Nom</label>
                                <input
                                    type="text"
                                    required
                                    class="form-control"
                                    v-model="nomNiveauScolaire"
                                />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"   @click="closeModal">Close</button>
                        <button form="createForm" type="submit" class="btn btn-success " >add new</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<style scoped>

</style>
