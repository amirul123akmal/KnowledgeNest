import './bootstrap';
import '@fortawesome/fontawesome-free/js/all.min.js';
import EasyMDE from 'easymde';
import Tagify from '@yaireo/tagify';
import { marked } from 'marked';    
import Swal from 'sweetalert2';

window.EasyMDE = EasyMDE;
window.Tagify = Tagify;
window.marked = marked;
window.Swal = Swal;