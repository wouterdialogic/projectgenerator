import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
// import cart from './modules/cart'
// import products from './modules/products'
// import createLogger from '../../../src/plugins/logger'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
    modules: {

    },
    state: {
        count: 1,
        questions: [],
        modal_level: 1,
    },

  // actions
    actions: {
        getQuestionsWith ({ commit }) {
            fetch('/api/questions').then(res => res.json()).then((questions) => {
                commit('setQuestions', questions)
            })
        },
        getAllQuestions ({ commit }) {
            fetch('/api/questions').then(res => res.json()).then((questions) => {
                commit('setQuestions', questions)
                //this.models = models;
                //this.original_models = JSON.parse(JSON.stringify(models)); 
                //this.fields = fields;
            })
           
           
            // fetch('/api/projects').then(res => res.json()).then(({ models, fields }) => {
            //     commit('setQuestions', models)
            //     //this.models = models;
            //     //this.original_models = JSON.parse(JSON.stringify(models)); 
            //     //this.fields = fields;
            // })


            // shop.getProducts(questions => {
            //     commit('setQuestions', questions)
        },
        toggle_question_tag ( commit, load ) {
            console.log(load.question_id);
            console.log(load.tag_id);
            var question_id = load.question_id;
            var tag_id = load.tag_id;
            // axios({
            //     method: 'post',
            //     url: '/user/12345',
            //     data: {
            //         firstName: 'Fred',
            //         lastName: 'Flintstone'
            //     }
            // });
            
            fetch('/api/questions/'+question_id+'/toggle_tag/'+tag_id).then(res => res.json()).then(() => {
                //commit('setQuestions', questions)
            })
        },
        
    },

    mutations: {
        increment (state) {
            state.count++
        },

        open_modal (state) {
            state.modal_level ++;
        },

        close_modal (state) {
            state.modal_level --;
        },

        setQuestions (state, questions) {
            state.questions = questions
        },
    },

    strict: debug,
  //plugins: debug ? [createLogger()] : []
})