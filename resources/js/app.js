import { createApp } from 'vue';
import ArticlesTable from './components/ArticlesTable.vue';
import { createPinia } from 'pinia';

const app = createApp({});
const pinia = createPinia();
app.component('articles-table', ArticlesTable);
app.use(pinia);
app.mount('#app');