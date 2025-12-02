import './bootstrap';
import '@fortawesome/fontawesome-free/js/all.min.js';
import EasyMDE from 'easymde';
import Tagify from '@yaireo/tagify';
import { marked } from 'marked';

window.EasyMDE = EasyMDE;
window.Tagify = Tagify;
window.marked = marked;