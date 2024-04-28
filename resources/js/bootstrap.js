import axios from 'axios';
window.axios = axios;


import "admin-lte/plugins/jquery/jquery"
import "admin-lte/plugins/bootstrap/js/bootstrap.bundle"
import "admin-lte/dist/js/adminlte"

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
import $ from "jquery";
window.$ = window.jQuery = $;

import Swal from 'sweetalert2';
window.Swal = Swal;
