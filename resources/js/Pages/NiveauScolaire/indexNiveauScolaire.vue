

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
                                            <div  class="d-flex justify-items-center">
                                                <button @click="openEditModal(niveauScolaire.id)" class="btn btn-info mr-2"><i class="fas fa-pen"></i></button>
                                                <button @click="deletelevel(niveauScolaire.id)"  class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
            <EditNiveauScolaire
                :niveauScolaireId="editingElementId"
                :show="showModal"
                @modalClosed="modalClosed"
            />
        </div>

    </Layouts>
</template>
<script setup>
import {defineProps, onMounted, ref} from 'vue';
import Pagination from '@/Shared/Pagination.vue';
import {Link} from "@inertiajs/vue3";
import Layouts from "@/Layouts/MainLayout.vue";
import CreateNiveauScolaire from "@/Pages/NiveauScolaire/CreateNiveauScolaire.vue";
import EditNiveauScolaire from "@/Pages/NiveauScolaire/EditNiveauScolaire.vue";
import {useSwallError,useSwallSuccess} from "@/Composables/alert.js";
import {Inertia} from "@inertiajs/inertia";

const prop = defineProps({
    niveauscolaires: Object
});



let showModal = ref('false');
let editingElementId = ref(null);
const   openEditModal = (id) => {
   showModal.value = true;
    editingElementId.value = id;
}
const modalClosed = ()=>{
    editingElementId.value = null;
    showModal.value = false
}
const deletelevel = async (id) => {
    const result = await Swal.fire({
        icon: 'warning',
        title: 'zone de confirmation',
        text: "Voulez-vous vraiment supprimer ce niveau scolaire?",
        showCancelButton: true,
        confirmButtonText: 'Oui',
        cancelButtonText: 'Non',
    });

    if (result.isConfirmed) {
        Inertia.delete(route("niveauScolaire.destroy", { niveauScolaire: id }), {
            onSuccess: (response) => {
                useSwallSuccess("Niveau scolaire supprimé avec succès!");
            },
            onError: (error) => {
                const errorMessage = error.error ?? "Une erreur a été rencontrée";
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: errorMessage
                });
            },
        });
    }
};






/*
const deletelevel = (id) => {
    if (confirm('Are you sure you want to delete this level?')) {
        axios.post(
            route("niveauScolaire.destroy",  id ),
        {
            _method: 'DELETE',
        }
        )
            .then((response) => {
                // Handle success response
                // Display a success message using useSwallSuccess
                useSwallSuccess("Niveau scolaire supprimé avec succès!");
                // Optionally, you can reload the page after successful deletion
                // window.location.reload();
                // Reload the page without preserving the component state
                Inertia.reload({preserveState: false});


            })
            .catch((error) => {
                // Handle error response
                // Display an error message using useSwallError
                useSwallError(error.response.data.message ?? "Une erreur a été rencontrée");
            });
    }
};*/

</script>

<style scoped>

</style>
