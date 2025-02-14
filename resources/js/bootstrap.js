import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import jQuery from "jquery";
window.$ = window.jQuery = jQuery;

import DataTable from "datatables.net-se";
window.DataTable = DataTable;

import "datatables.net-buttons-se";
import "datatables.net-responsive-se";
