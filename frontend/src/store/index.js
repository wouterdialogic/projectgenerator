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
    },

  // actions
    actions: {
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
        
    },

    mutations: {
        increment (state) {
            state.count++
        },
        setQuestions (state, questions) {
            state.questions = questions
        },
    },

    strict: debug,
  //plugins: debug ? [createLogger()] : []
})