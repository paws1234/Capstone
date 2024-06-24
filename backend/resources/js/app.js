import './bootstrap';
import axios from 'axios';
axios.defaults.headers.common['X-CSRF-TOKEN'] = window.csrfToken;