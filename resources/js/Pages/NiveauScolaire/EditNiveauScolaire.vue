

<template>
    <!-- Modal -->
    <div class="modal fade" id="EditModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">edite education level "{{editNiveauScolaire.nom}}"</h5>
                    <button type="button" class="close" @click="closeModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" @submit.prevent="update">
                        <div class="form-group">
                            <label for="">Nom</label>
                            <input
                                type="text"
                                required
                                class="form-control"
                                :class="{'is-invalid': editNiveauScolaire.nomError != ''}"

                                v-model="editNiveauScolaire.nom"
                            />
                            <span v-if="editNiveauScolaire.nomError != '' " class="invalid-feedback error">{{ editNiveauScolaire.nomError }}</span>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="closeModal">close</button>
                    <button form="editForm" type="submit" class="btn btn-success" @click="update()">save</button>
                </div>
            </div>
        </div>
    </div>

</template>
<script setup>
import Layouts from "@/Layouts/MainLayout.vue";
import {reactive, watch} from "vue";
import {defineProps, defineEmits} from "vue";
import axios from "axios";
import {useSwallError,useSwallSuccess} from "@/Composables/alert.js";

const emit = defineEmits(["modalClosed"])
const props = defineProps({
    niveauScolaireId:{
        type: Number,
        required: true
    },
    show:{
        type: Boolean,
        required: true

    }
})
const editNiveauScolaire = reactive({
    id:"",
    nom: "",
    nomError:" ''"
});
const openModal = ()=>{
    getNiveauScolaireById()
    $("#EditModal").modal("show")
}

const closeModal = ()=>{
    $("#EditModal").modal("hide")
    emit("modalClosed")
}
const getNiveauScolaireById =()=>{
    axios.get(route('niveauScolaire.edit', props.niveauScolaireId))
        .then(response=>{
           console.log(response.data)
           editNiveauScolaire.id = response.data.NiveauScolaire.id
              editNiveauScolaire.nom = response.data.NiveauScolaire.nom
        }).catch(error=>{
            console.log(error)
        })
}
watch(
    () => props.show,
    (newVal, oldVal) =>{
        if(newVal){
            openModal()
        }else{
            closeModal()
        }
    }
)

const update = () => {
    // Send a POST request to the route for updating 'niveauScolaire' with the ID of 'editNiveauScolaire.id'

    axios.post(
        route('niveauScolaire.update', { niveauScolaire: editNiveauScolaire.id }),
        {// Request body containing the data to be updated
            _method: 'PUT',
            nom: editNiveauScolaire.nom // New value for the 'nom' field
        }
    )
        .then((response) => {
            // Handle success response
            // Display a success message using useSwallSuccess
            useSwallSuccess("Niveau scolaire mis à jour avec succès! , just wait a moment please");

            // Close the modal after successful update
            closeModal();
        })
        .catch((error) => {
            // Handle error response
            // Set the error message returned from the server to editNiveauScolaire.nomError
            editNiveauScolaire.nomError = error.response.data.message;
            // Display an error message using useSwallError
            useSwallError("Une erreur a été rencontrée");
        });
};


</script>
