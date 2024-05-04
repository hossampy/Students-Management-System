<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="index3.html" class="brand-link">
            <img
                src="~admin-lte/dist/img/AdminLTELogo.png"
                alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3"
                style="opacity: 0.8"
            />
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img
                        src="https://yt3.ggpht.com/ysLHmrLE5AZ6iypekgvwdSouurPDzR6ShhKpGyrJsewZDA-HjhJEqN7oURLQ5gOwyQwmkV4B=s88-c-k-c0x00ffffff-no-rj"
                        class="img-circle elevation-2"
                        alt="User Image"
                    />
                </div>
                <div class="info">
                    <a href="#" class="d-block">Hossam</a>
                </div>
            </div>



            <nav class="mt-2">
                <ul
                    class="nav nav-pills nav-sidebar flex-column"
                    data-widget="treeview"
                    role="menu"
                    data-accordion="false"
                >

                    <li class="nav-item">
                        <Link :href="route('niveauScolaire.index')" class="nav-link" :class="{'active': $page.component=='NiveauScolaire/index'}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Niveau scolaire
                            </p>
                        </Link>
                    </li>

                    <li class="nav-item" :class="{'menu-open': $page.component.startsWith('Etudiant/')}">
                        <a href="#" class="nav-link" :class="{'active': $page.component.startsWith('Etudiant/')}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Etudiants
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <Link :href="route('etudiant.index')" class="nav-link" :class="{'active': $page.component =='Etudiant/index'}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tous</p>
                                </Link>
                            </li>
                            <li class="nav-item">
                                <Link :href="route('etudiant.create')" class="nav-link" :class="{'active': $page.component == 'Etudiant/create'}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Nouveau</p>
                                </Link>
                            </li>
                        </ul>
                    </li>



                </ul>
            </nav>
        </div>
    </aside>
</template>
<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>
