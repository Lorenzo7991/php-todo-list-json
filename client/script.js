import Vue from 'vue';
import axios from 'axios';


const app = Vue.createApp({
    data() {
        return {
            todos: []
        };
    },
    mounted() {

        axios.get('http://localhost/boolean/php-todo-list-json/server/todo.php')
            .then(response => {

                this.todos = response.data;
            })
            .catch(error => {

                console.error('Errore durante la richiesta dei dati dei ToDo:', error);
            });
    }
});

// Monta l'app Vue sull'elemento con id "app"
app.mount('#app');
