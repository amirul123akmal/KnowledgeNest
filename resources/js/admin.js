import './bootstrap';
import '@fortawesome/fontawesome-free/js/all.min.js';
import Alpine from 'alpinejs';
import Swal from 'sweetalert2';
import Chart from 'chart.js/auto';
import EasyMDE from 'easymde';
import Tagify from '@yaireo/tagify';
import { marked } from 'marked';

window.Alpine = Alpine;
window.Swal = Swal;
window.Chart = Chart;
window.EasyMDE = EasyMDE;
window.Tagify = Tagify;
window.marked = marked;
Alpine.start();